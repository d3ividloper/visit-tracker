<?php declare(strict_types=1);

namespace App\Customer\Domain\Entity;

use App\Customer\Domain\ValueObject\CustomerId;
use App\Customer\Domain\ValueObject\TreePlantingPolicy;
use DateTimeImmutable;


final class Customer
{
     public function __construct(
        private CustomerId $id,
        private int $visitCount = 0,
        private int $treesPlanted = 0,
        private ?DateTimeImmutable $lastConnectionAt = null
    ) {
    }

    public function registerVisit(
        TreePlantingPolicy $policy,
        DateTimeImmutable $visitedAt
    ): void {
        $this->visitCount++;

        $this->lastConnectionAt = $visitedAt;

        if ($policy->shouldPlantTree($this->visitCount, $this->treesPlanted)) 
        {
            $this->treesPlanted++;
        }
    }

    public function id(): CustomerId
    {
        return $this->id;
    }

    public function visitCount(): int
    {
        return $this->visitCount;
    }

    public function treesPlanted(): int
    {
        return $this->treesPlanted;
    }

    public function lastConnectionAt(): ?DateTimeImmutable
    {
        return $this->lastConnectionAt;
    }
}