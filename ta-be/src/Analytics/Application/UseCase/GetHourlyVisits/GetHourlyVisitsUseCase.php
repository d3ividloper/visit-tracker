<?php declare(strict_types=1);

namespace App\Analytics\Application\UseCase\GetHourlyVisits;

use App\Analytics\Domain\Repository\HourlyVisitReadRepositoryInterface;

class GetHourlyVisitsUseCase
{
    public function __construct(
        private HourlyVisitReadRepositoryInterface $repository
    ) {}

    public function execute(): GetHourlyVisitsResponse
    {
        return new GetHourlyVisitsResponse($this->repository->getHourlyVisits());
    }
}