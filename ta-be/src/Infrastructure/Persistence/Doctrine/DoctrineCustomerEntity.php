<?php declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name: 'customers')]
class DoctrineCustomerEntity
{
    #[ORM\Id]
    #[ORM\Column]
    public string $id;

    #[ORM\Column]
    public int $visitCount;

    #[ORM\Column]
    public int $treesPlanted;

    #[ORM\Column(nullable: true)]
    public ?\DateTimeImmutable $lastConnectionAt;
}