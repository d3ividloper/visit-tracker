<?php declare(strict_types=1);

namespace App\Customer\Domain\Exception;


class InvalidCustomerIdException extends \Exception
{
    public function __construct(string $id)
    {
        parent::__construct(sprintf('Invalid customer id "%s"', $id));
    }
}