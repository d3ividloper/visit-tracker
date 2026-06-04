<?php declare(strict_types=1);

namespace App\Visit\Domain\Exception;


class InvalidVisitIdException extends \Exception
{
    public function __construct(string $id)
    {
        parent::__construct(sprintf('Invalid visit id "%s"', $id));
    }
}