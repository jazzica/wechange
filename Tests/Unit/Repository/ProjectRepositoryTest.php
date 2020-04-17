<?php
/**
 * Date: 04/2020
 *
 * @author Jessica Schlierenkamp <mail@schlierenkamp.de>
 */

declare(strict_types = 1);

namespace JS\Wechange\Tests\Unit\Repository;

use JS\Wechange\Domain\Model\Filter\ProjectFilter;
use JS\Wechange\Domain\Repository\ProjectRepository;
use JS\Wechange\Service\ApiService;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class ProjectRepositoryTest extends UnitTestCase
{
    private const API_BASE_URL = 'https://wechange.de/api/v2/';

    /**
     * @test
     *
     * @covers       \JS\Wechange\Domain\Repository\ProjectRepository::findForFilter
     *
     * @dataProvider findForFilterDataProvider
     *
     * @param int $expectedCount
     * @param ProjectFilter $projectFilter
     */
    public function findForFilter(int $expectedCount, ProjectFilter $projectFilter): void
    {
        $projectRepository = new ProjectRepository(
            self::API_BASE_URL,
            new ApiService()
        );

        self::assertCount(1, $projectRepository->findForFilter($projectFilter));
    }

    public function findForFilterDataProvider(): array
    {
        return [
            'find for parent' => [1, new ProjectFilter(6454)]
        ];
    }
}
