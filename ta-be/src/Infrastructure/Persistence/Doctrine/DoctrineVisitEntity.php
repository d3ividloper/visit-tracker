<?php declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'visits')]
class DoctrineVisitEntity
{
    #[ORM\Id]
    #[ORM\Column]
    public string $id;

    #[ORM\Column]
    public string $customerId;

    #[ORM\Column]
    public \DateTimeImmutable $occurredAt;
}