<?php declare(strict_types=1);

namespace App\Visit\Infrastructure\Persistence\Doctrine;

use App\Infrastructure\Persistence\Doctrine\DoctrineVisitEntity;
use App\Visit\Domain\Entity\Visit;
use App\Visit\Domain\Repository\VisitRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

final readonly class DoctrineVisitRepository implements VisitRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function save(Visit $visit): void
    {
        $entity = new DoctrineVisitEntity();

        $entity->id = $visit->id()->value();
        $entity->customerId = $visit->customerId()->value();
        $entity->occurredAt = $visit->occurredAt();

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }
}