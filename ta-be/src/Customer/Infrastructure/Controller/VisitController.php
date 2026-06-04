<?php declare(strict_types=1);

namespace App\Customer\Infrastructure\Controller;

use App\Customer\Application\Exception\EmptyCustomerIdException;
use App\Customer\Application\UseCase\RegisterVisit\RegisterVisitCommand;
use App\Customer\Application\UseCase\RegisterVisit\RegisterVisitUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final readonly class VisitController
{
    public function __construct(
        private RegisterVisitUseCase $useCase
    ) {}

    #[Route('/api/visits', methods: ['POST'])]
    public function create(Request $request): JsonResponse {

        $payload = json_decode(
            $request->getContent(),
            true
        );

        if(!$payload['customerId']) {
            throw new EmptyCustomerIdException();
        }

        $this->useCase->execute( new RegisterVisitCommand(
                $payload['customerId']
            ));

        return new JsonResponse([
            'status' => 'ok'
        ]);
    }
}