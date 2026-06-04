<?php declare(strict_types=1);

namespace Tests\Unit\Customer\Domain;

use App\Customer\Domain\Entity\Customer;
use App\Customer\Domain\ValueObject\CustomerId;
use App\Customer\Domain\ValueObject\TreePlantingPolicy;
use PHPUnit\Framework\TestCase;

final class CustomerTest extends TestCase
{
    public function test_visit_increments_visit_count(): void
    {
        $customer = new Customer(
            new CustomerId('d8f5237e-e28e-4a45-839a-128c04fbed3c')
        );

        $customer->registerVisit(new TreePlantingPolicy(5), new \DateTimeImmutable());

        self::assertSame(1,$customer->visitCount()
        );
    }

    public function test_tree_is_planted_on_fifth_visit(): void
    {
        $customer = new Customer(
            new CustomerId('d8f5237e-e28e-4a45-839a-128c04fbed3c'),
            4
        );

        $policy = new TreePlantingPolicy(5);
        $customer->registerVisit($policy, new \DateTimeImmutable());

        self::assertSame(1, $customer->treesPlanted());
    }

    public function test_two_trees_after_ten_visits(): void
    {
       $customer = new Customer(
            new CustomerId('d8f5237e-e28e-4a45-839a-128c04fbed3c')
        );

        $policy = new TreePlantingPolicy(5);

        for ($i = 0; $i < 10; $i++) {
            $customer->registerVisit($policy, new \DateTimeImmutable());
        }

        self::assertSame(2,$customer->treesPlanted()
        );
    }
}