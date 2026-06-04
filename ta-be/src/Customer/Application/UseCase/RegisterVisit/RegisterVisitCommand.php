<?php declare(strict_types=1);

namespace App\Customer\Application\UseCase\RegisterVisit;

final readonly class RegisterVisitCommand
{
    public function __construct(
        public string $customerId,
    ) {}
}