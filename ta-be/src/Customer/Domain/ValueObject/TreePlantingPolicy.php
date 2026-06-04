<?php declare(strict_types=1);


namespace App\Customer\Domain\ValueObject; 


final readonly class TreePlantingPolicy
{
    public function __construct(
        private int $visitsPerTree
    ) {}

    public function shouldPlantTree(int $visitCount, int $treesPlanted): bool
    {
        return $visitCount % $this->visitsPerTree === 0 && $visitCount >= $treesPlanted;
    }
}