<?php declare(strict_types=1);

namespace App\Visit\Domain\ValueObject;

use App\Visit\Domain\Exception\InvalidVisitIdException;
use Symfony\Component\Uid\Uuid;

final readonly class VisitId
{
    public function __construct(
        private string $value
    ) {
        if (!Uuid::isValid($value)) {
            throw new InvalidVisitIdException($value);
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}