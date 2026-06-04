<?php declare(strict_types=1);

namespace App\Customer\Infrastructure\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class CustomerController
{
    #[Route(
        '/api/customers/{id}',
        methods: ['GET']
    )]
    public function show(
        string $id
    ): JsonResponse {

        // query repository

        return new JsonResponse();
    }
}