<?php declare(strict_types=1);

namespace Tests\Repository;

use App\Visit\Domain\Entity\Visit;
use App\Visit\Domain\Repository\VisitRepositoryInterface;

final class InMemoryVisitRepository implements VisitRepositoryInterface
{
    private array $visits = [];

    public function save(Visit $visit): void
    {
        $this->visits[$visit->id()->value()] = $visit;
    }

    public function all(): array
    {
        return $this->visits;
    }
}