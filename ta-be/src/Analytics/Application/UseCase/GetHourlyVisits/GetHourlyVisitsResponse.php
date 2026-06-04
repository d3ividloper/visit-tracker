<?php declare(strict_types=1);

namespace App\Analytics\Application\UseCase\GetHourlyVisits;

final readonly class GetHourlyVisitsResponse
{
    public function __construct(
        public array $hourlyVisits
    ) {}
}