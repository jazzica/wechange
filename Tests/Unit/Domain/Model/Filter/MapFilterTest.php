<?php
/**
 * Date: 04/2020
 *
 * @author Jessica Schlierenkamp <mail@schlierenkamp.de>
 */

declare(strict_types = 1);

namespace JS\Wechange\Tests\Unit\Domain\Model\Filter;

use JS\Wechange\Domain\Model\Coordinate;
use JS\Wechange\Domain\Model\Filter\MapFilter;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class MapFilterTest extends UnitTestCase
{
    /**
     * @test
     *
     * @dataProvider buildQueryStringDataProvider
     * @covers       \JS\Wechange\Domain\Model\Filter\ProjectFilter::buildQueryString
     *
     * @param MapFilter $mapFilter
     * @param string $expected
     */
    public function buildQueryString(MapFilter $mapFilter, string $expected): void
    {
        self::assertEquals($expected, $mapFilter->buildQueryString());
    }

    public function buildQueryStringDataProvider(): array
    {
        return [
            'MapFilter with no constructor arguments' => [
                new MapFilter(),
                'people=true&events=true&projects=true&groups=true&ideas=true&search_result_limit=1000'
                . '&ne_lat=56.54737&ne_lon=31.9043&sw_lat=43.35714&sw_lon=-9.22852'
            ],
            'MapFilter with showPeople set to false' => [
                new MapFilter(false),
                'people=false&events=true&projects=true&groups=true&ideas=true&search_result_limit=1000'
                . '&ne_lat=56.54737&ne_lon=31.9043&sw_lat=43.35714&sw_lon=-9.22852'
            ],
            'MapFilter with showEvents set to false' => [
                new MapFilter(true, false),
                'people=true&events=false&projects=true&groups=true&ideas=true&search_result_limit=1000'
                . '&ne_lat=56.54737&ne_lon=31.9043&sw_lat=43.35714&sw_lon=-9.22852'
            ],
            'MapFilter with showProjects set to false' => [
                new MapFilter(true, true, false),
                'people=true&events=true&projects=false&groups=true&ideas=true&search_result_limit=1000'
                . '&ne_lat=56.54737&ne_lon=31.9043&sw_lat=43.35714&sw_lon=-9.22852'
            ],
            'MapFilter with showGroups set to false' => [
                new MapFilter(true, true, true, false),
                'people=true&events=true&projects=true&groups=false&ideas=true&search_result_limit=1000'
                . '&ne_lat=56.54737&ne_lon=31.9043&sw_lat=43.35714&sw_lon=-9.22852'
            ],
            'MapFilter with showIdeas set to false' => [
                new MapFilter(true, true, true, true, false),
                'people=true&events=true&projects=true&groups=true&ideas=false&search_result_limit=1000'
                . '&ne_lat=56.54737&ne_lon=31.9043&sw_lat=43.35714&sw_lon=-9.22852'
            ],
            'MapFilter with limit set to 100' => [
                new MapFilter(true, true, true, true, true, 100),
                'people=true&events=true&projects=true&groups=true&ideas=true&search_result_limit=100'
                . '&ne_lat=56.54737&ne_lon=31.9043&sw_lat=43.35714&sw_lon=-9.22852'
            ],
            'MapFilter with coordinates' => [
                new MapFilter(
                    true,
                    true,
                    true,
                    true,
                    true,
                    100,
                    new Coordinate(12, 34),
                    new Coordinate(56, 78)
                ),
                'people=true&events=true&projects=true&groups=true&ideas=true&search_result_limit=100'
                . '&ne_lat=12&ne_lon=34&sw_lat=56&sw_lon=78'
            ],
            'MapFilter with filter group' => [
                new MapFilter(true, true, true, true, true, 1000, null, null, 1012),
                'people=true&events=true&projects=true&groups=true&ideas=true&search_result_limit=1000'
                . '&ne_lat=56.54737&ne_lon=31.9043&sw_lat=43.35714&sw_lon=-9.22852&filter_group=1012'
            ],
            'MapFilter with different options set' => [
                new MapFilter(
                    true,
                    false,
                    true,
                    false,
                    true,
                    55,
                    null,
                    new Coordinate(12, 34)
                ),
                'people=true&events=false&projects=true&groups=false&ideas=true&search_result_limit=55'
                . '&ne_lat=56.54737&ne_lon=31.9043&sw_lat=12&sw_lon=34'
            ],
        ];
    }
}
