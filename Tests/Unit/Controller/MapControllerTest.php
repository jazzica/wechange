<?php

declare(strict_types=1);

namespace JS\Wechange\Tests\Unit\Controller;

use JS\Wechange\Controller\MapController;
use JS\Wechange\Domain\Model\Coordinate;
use JS\Wechange\Domain\Model\Filter\FilterFactory;
use JS\Wechange\Domain\Model\Filter\MapFilter;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use TYPO3Fluid\Fluid\View\ViewInterface;

class MapControllerTest extends UnitTestCase
{
    public function testShowAction(): void
    {
        $mapController = $this->getAccessibleMock(MapController::class, null, [], '', false);
        $mapController->_set(
            'settings',
            [
                'map' => ['coordinates' => [], 'baseUrl' => ''],
                'filter' => []
            ]
        );

        $filterFactory = $this->getMockBuilder(FilterFactory::class)->getMock();
        $filterFactory->expects(self::once())->method('makeMapFilter')->willReturn(
            new MapFilter(
                new Coordinate(56.54737, 31.9043),
                new Coordinate(43.35714, -9.22852),
                true,
                false
            )
        );
        $mapController->_set('filterFactory', $filterFactory);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view
            ->expects(self::once())
            ->method('assign')
            ->with(
                'iframeSource',
                'map/embed/?people=true&events=false&projects=true&groups=true&ideas=true&search_result_limit=1000&' .
                'ne_lat=56.54737&ne_lon=31.9043&sw_lat=43.35714&sw_lon=-9.22852'
            );
        $mapController->_set('view', $view);

        $mapController->showAction();
    }
}
