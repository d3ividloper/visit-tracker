<?php declare(strict_types=1);


namespace App\Customer\Domain\Repository;


use App\Customer\Domain\Entity\Customer;
use App\Customer\Domain\ValueObject\CustomerId;

interface CustomerRepositoryInterface
{
    public function find(CustomerId $id): ?Customer;
    
    public function save(Customer $customer): void;
}