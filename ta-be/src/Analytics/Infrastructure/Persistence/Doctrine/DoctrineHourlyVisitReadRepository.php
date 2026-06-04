<?php declare(strict_types=1);

namespace App\Analytics\Infrastructure\Persistence\Doctrine;


use App\Analytics\Domain\Repository\HourlyVisitReadRepositoryInterface;
use Doctrine\DBAL\Connection;

final readonly class DoctrineHourlyVisitReadRepository implements HourlyVisitReadRepositoryInterface
{
    public function __construct(
        private Connection $connection,
        private string $defaultTimezone
    ) {}

    public function getHourlyVisits(): array
    {
        $hourlyVisits = $this->connection->fetchAllAssociative(
            <<<SQL
            SELECT
                strftime(
                    '%Y-%m-%d %H:00',
                    occurred_at
                ) AS hour,
                COUNT(*) AS visits
            FROM visits
            GROUP BY hour
            ORDER BY hour
            SQL
        );

        array_walk($hourlyVisits, function(&$element) {
            $date = new \DateTime($element['hour'], new \DateTimeZone('UTC'));
            $date->setTimeZone(new \DateTimeZone($this->defaultTimezone));
            $startHour = $date->format('d-m-Y H:00');
            $endHour = $date->modify('+1 hour')->format('H:00');
            $element['hour'] = $startHour . ' to '. $endHour;
        });

        return $hourlyVisits;
    }
}