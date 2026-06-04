<?php declare(strict_types=1);

namespace App\Analytics\Domain\Repository;

interface HourlyVisitReadRepositoryInterface
{
    public function getHourlyVisits(): array;
}