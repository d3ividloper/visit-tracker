<?php declare(strict_types=1);

namespace Tests\Unit\Customer\Application;

use App\Customer\Application\UseCase\RegisterVisit\RegisterVisitCommand;
use App\Customer\Application\UseCase\RegisterVisit\RegisterVisitUseCase;
use App\Customer\Domain\Exception\InvalidCustomerIdException;
use App\Customer\Domain\ValueObject\CustomerId;
use App\Customer\Domain\ValueObject\TreePlantingPolicy;
use PHPUnit\Framework\TestCase;
use Tests\Repository\InMemoryCustomerRepository;
use Tests\Repository\InMemoryVisitRepository;

final class RegisterVisitUseCaseTest extends TestCase
{
    public function test_creates_customer_when_not_found(): void
    {
        $customerRepository = new InMemoryCustomerRepository();
        $visitRepository = new InMemoryVisitRepository();

        $useCase = new RegisterVisitUseCase(
            $customerRepository,
            $visitRepository,
            new TreePlantingPolicy(5)
        );

        $customerId = 'd8f5237e-e28e-4a45-839a-128c04fbed3c';

        $useCase->execute(new RegisterVisitCommand($customerId));

        $customer = $customerRepository->find(new CustomerId($customerId));

        self::assertNotNull($customer);
        self::assertSame(1, $customer->visitCount());
        self::assertSame(0, $customer->treesPlanted());
        self::assertCount(1, $visitRepository->all());
    }

    public function test_customer_id_is_not_valid(): void
    {
        $customerRepository = new InMemoryCustomerRepository();
        $visitRepository = new InMemoryVisitRepository();

        $useCase = new RegisterVisitUseCase(
            $customerRepository,
            $visitRepository,
            new TreePlantingPolicy(5)
        );

        $customerId = '';

        self::expectException(InvalidCustomerIdException::class);

        $useCase->execute(new RegisterVisitCommand($customerId));
    }

    public function test_plants_tree_after_five_visits(): void
    {
        $customerRepository = new InMemoryCustomerRepository();
        $visitRepository = new InMemoryVisitRepository();

        $useCase = new RegisterVisitUseCase(
            $customerRepository,
            $visitRepository,
            new TreePlantingPolicy(5)
        );

        $customerId = 'd8f5237e-e28e-4a45-839a-128c04fbed3c';

        for ($i = 0; $i < 5; $i++) {
            $useCase->execute(new RegisterVisitCommand($customerId));
        }

        $customer = $customerRepository->find(new CustomerId($customerId));

        self::assertSame(5, $customer->visitCount());
        self::assertSame(1, $customer->treesPlanted());
    }
}