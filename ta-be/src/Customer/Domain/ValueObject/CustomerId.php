<?php declare(strict_types=1);


namespace App\Customer\Domain\ValueObject;

use App\Customer\Domain\Exception\InvalidCustomerIdException;
use Symfony\Component\Uid\Uuid;



final readonly class CustomerId
{
    public function __construct(
        private string $value,
    ) {
        if (!Uuid::isValid($value)) {
            throw new InvalidCustomerIdException($value);
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public static function generate(): self
    {
        return new self(Uuid::v7()->toRfc4122());
    }
}