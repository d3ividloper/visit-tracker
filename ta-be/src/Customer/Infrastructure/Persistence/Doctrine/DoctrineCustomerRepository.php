<?php declare(strict_types=1);

namespace App\Customer\Infrastructure\Persistence\Doctrine;

use App\Customer\Domain\Entity\Customer;
use App\Customer\Domain\Repository\CustomerRepositoryInterface;
use App\Customer\Domain\ValueObject\CustomerId;
use App\Infrastructure\Persistence\Doctrine\DoctrineCustomerEntity;
use Doctrine\ORM\EntityManagerInterface;


final readonly class DoctrineCustomerRepository implements CustomerRepositoryInterface
{
     public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function find(CustomerId $id): ?Customer
    {
        $entity = $this->entityManager->find(DoctrineCustomerEntity::class, $id->value());

        if ($entity === null) {
            return null;
        }

        return new Customer(
            id: new CustomerId($entity->id),
            visitCount: $entity->visitCount,
            treesPlanted: $entity->treesPlanted,
            lastConnectionAt: $entity->lastConnectionAt,
        );
    }

    public function save(Customer $customer): void
    {
        $entity = $this->entityManager->find(DoctrineCustomerEntity::class,$customer->id()->value());

        if ($entity === null) {
            $entity = new DoctrineCustomerEntity();
            $entity->id = $customer->id()->value();
        }

        $entity->visitCount = $customer->visitCount();
        $entity->treesPlanted = $customer->treesPlanted();
        $entity->lastConnectionAt = $customer->lastConnectionAt();

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }
}