<?php
/**
 * Date: 04/2020
 *
 * @author Jessica Schlierenkamp <mail@schlierenkamp.de>
 */

declare(strict_types = 1);

namespace JS\Wechange\Tests\Unit\Repository;

use JS\Wechange\Domain\Repository\ProjectRepository;
use JS\Wechange\Service\ApiService;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class ProjectRepositoryTest extends UnitTestCase
{

    /**
     * @test
     *
     * @covers \JS\Wechange\Domain\Repository\ProjectRepository::findForFilter
     */
    public function findForFilter(): void
    {
        $projectRepository = new ProjectRepository(new ApiService());
        self::assertCount(1, $projectRepository->findForFilter(6454));
    }

}
