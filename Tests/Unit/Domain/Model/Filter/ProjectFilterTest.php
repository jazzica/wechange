<?php
/**
 * Date: 04/2020
 *
 * @author Jessica Schlierenkamp <mail@schlierenkamp.de>
 */

declare(strict_types=1);

namespace JS\Wechange\Tests\Unit\Domain\Model\Filter;

use JS\Wechange\Domain\Model\Filter\ProjectFilter;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class ProjectFilterTest extends UnitTestCase
{
    /**
     * @dataProvider buildQueryStringDataProvider
     *
     * @param ProjectFilter $projectFilter
     * @param string $expected
     */
    public function testBuildQueryString(ProjectFilter $projectFilter, string $expected): void
    {
        self::assertEquals($expected, $projectFilter->buildQueryString());
    }

    public function buildQueryStringDataProvider(): array
    {
        return [
            'ProjectFilter with no constructor arguments' => [
                new ProjectFilter(),
                'limit=10'
            ],
            'ProjectFilter with parent' => [
                new ProjectFilter(1012),
                'parent=1012&limit=10'
            ],
            'ProjectFilter with tag' => [
                new ProjectFilter(0, 'test-tag'),
                'tags=test-tag&limit=10'
            ],
            'ProjectFilter with limit' => [
                new ProjectFilter(0, '', 5),
                'limit=5'
            ],
            'ProjectFilter with different options set' => [
                new ProjectFilter(1012, 'test-tag', 5, 'name'),
                'parent=1012&tags=test-tag&limit=5'
            ]
        ];
    }
}
