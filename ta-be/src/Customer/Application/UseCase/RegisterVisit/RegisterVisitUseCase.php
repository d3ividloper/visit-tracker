<?php declare(strict_types=1);

namespace App\Customer\Application\UseCase\RegisterVisit;

use App\Customer\Domain\Entity\Customer;
use App\Customer\Domain\Repository\CustomerRepositoryInterface;
use App\Customer\Domain\ValueObject\CustomerId;
use App\Customer\Domain\ValueObject\TreePlantingPolicy;
use App\Visit\Domain\Entity\Visit;
use App\Visit\Domain\Repository\VisitRepositoryInterface;
use App\Visit\Domain\ValueObject\VisitId;

final readonly class RegisterVisitUseCase
{
    public function __construct(
        private CustomerRepositoryInterface $customerRepository,
        private VisitRepositoryInterface $visitRepository,
        private TreePlantingPolicy $policy
    ) {}

    public function execute(RegisterVisitCommand $command): void
    {
        $customerId = new CustomerId($command->customerId);
        $customer = $this->customerRepository->find($customerId);

        if (!$customer) {
            $customer = new Customer($customerId);
        }

        $now = new \DateTimeImmutable();

        $customer->registerVisit($this->policy, $now);

        $visit = new Visit(
            new VisitId(uuid_create()),
            $customerId,
            $now
        );

        $this->customerRepository->save($customer);
        $this->visitRepository->save($visit);

    }
}