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
    private const API_BASE_URL = 'https://staging.wechange.de/api/v2/';

    /**
     * @test
     *
     * @covers       \JS\Wechange\Domain\Repository\ProjectRepository::findForFilter
     *
     * @dataProvider findForFilterDataProvider
     *
     * @param int $expectedCount
     * @param ProjectFilter $projectFilter
     * @throws \JsonException
     */
    public function findForFilter(int $expectedCount, ProjectFilter $projectFilter): void
    {
        $projectRepository = new ProjectRepository(
            self::API_BASE_URL,
            new ApiService()
        );

        self::assertCount($expectedCount, $projectRepository->findForFilter($projectFilter));
    }

    /**
     * @test
     *
     * @covers       \JS\Wechange\Domain\Repository\ProjectRepository::findForFilter
     *
     * @throws \JsonException
     */
    public function findForFilterOrdered(): void
    {
        $projectRepository = new ProjectRepository(
            self::API_BASE_URL,
            new ApiService()
        );

        $baseProjects = $projectRepository->findForFilter(new ProjectFilter(
            0,
            '',
            2,
            'name',
            ProjectFilter::ORDER_ASC
        ));

        $orderedProjects = $projectRepository->findForFilter(new ProjectFilter(
            0,
            '',
            2,
            'name',
            ProjectFilter::ORDER_DESC
        ));

        self::assertEquals($baseProjects[0], $orderedProjects[1]);
        self::assertEquals($baseProjects[1], $orderedProjects[0]);
    }

    public function findForFilterDataProvider(): array
    {
        return [
            'find with empty filter' => [10, new ProjectFilter()],
            'find with empty filter, but limit is set' => [5, new ProjectFilter(0, '', 5)],
            'find for parent' => [1, new ProjectFilter(27)],
            //'find for tag' => [1, new ProjectFilter(0, 'cop26')],
            //'find for parent and tag' => [1, new ProjectFilter(6428, 'Inspirationen')]
        ];
    }
}
