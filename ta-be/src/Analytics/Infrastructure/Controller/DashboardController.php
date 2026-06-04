<?php declare(strict_types=1); 

namespace App\Analytics\Infrastructure\Controller;

use App\Analytics\Application\UseCase\GetHourlyVisits\GetHourlyVisitsUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final readonly class DashboardController
{
    public function __construct(
        private GetHourlyVisitsUseCase $useCase
    ) {
    }

    #[Route('/api/dashboard/hourly-visits',methods: ['GET'])]
    public function hourly(): JsonResponse
    {
        $response = $this->useCase->execute();
        
        return new JsonResponse(
            $response->hourlyVisits
        );
    }
}