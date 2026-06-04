<?php declare(strict_types=1);

namespace App\Visit\Domain\Entity;

use App\Customer\Domain\ValueObject\CustomerId;
use App\Visit\Domain\ValueObject\VisitId;
use DateTimeImmutable;

final readonly class Visit
{
    public function __construct(
        private VisitId $id,
        private CustomerId $customerId,
        private DateTimeImmutable $occurredAt
    ) {
    }

    public function id(): VisitId
    {
        return $this->id;
    }

    public function customerId(): CustomerId
    {
        return $this->customerId;
    }

    public function occurredAt(): DateTimeImmutable
    {
        return $this->occurredAt;
    }
}