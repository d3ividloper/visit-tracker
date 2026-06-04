<?php declare(strict_types=1);


namespace App\Visit\Domain\Repository;

use App\Visit\Domain\Entity\Visit;



interface VisitRepositoryInterface
{
    public function save(Visit $visit): void;
}