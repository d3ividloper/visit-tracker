<?php declare(strict_types=1);

namespace Tests\Repository;

use App\Customer\Domain\Entity\Customer;
use App\Customer\Domain\Repository\CustomerRepositoryInterface;
use App\Customer\Domain\ValueObject\CustomerId;

class InMemoryCustomerRepository implements CustomerRepositoryInterface
{
    private array $customers = [];

    public function find(CustomerId $id): ?Customer
    {
        return $this->customers[$id->value()] ?? null;
    }

    public function save(Customer $customer): void
    {
        $this->customers[$customer->id()->value()] = $customer;
    }
}