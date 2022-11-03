<?php

declare(strict_types=1);

namespace JS\Wechange\Tests\Unit\Controller;

use JS\Wechange\Controller\ProjectController;
use JS\Wechange\Domain\Model\Filter\FilterFactory;
use JS\Wechange\Domain\Model\Filter\ProjectFilter;
use JS\Wechange\Domain\Repository\ProjectRepository;
use JS\Wechange\Service\CachingService;
use TYPO3\CMS\Core\Cache\Frontend\FrontendInterface;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use TYPO3Fluid\Fluid\View\ViewInterface;

class ProjectControllerTest extends UnitTestCase
{
    public function testListAction(): void
    {
        $projects = array_fill(0, 2, 'Project');

        $projectController = $this->getAccessibleMock(ProjectController::class, null, [], '', false);

        $projectController->_set(
            'settings',
            [
                'filter' => [],
                'cache' => ['lifetime' => '']
            ]
        );

        $cachingService = $this->getMockBuilder(CachingService::class)->disableOriginalConstructor()->getMock();
        $cachingService->expects(self::once())->method('calculateCacheIdentifier')->willReturn('does_not_matter');
        $projectController->_set('cachingService', $cachingService);

        $configurationManager = $this->getMockBuilder(ConfigurationManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        $configurationManager->expects(self::once())->method('getContentObject');
        $projectController->_set('configurationManager', $configurationManager);

        $filterFactory = $this->getMockBuilder(FilterFactory::class)->disableOriginalConstructor()->getMock();
        $filterFactory->expects(self::once())->method('makeProjectFilter')->willReturn(new ProjectFilter());
        $projectController->_set('filterFactory', $filterFactory);

        $projectRepository = $this->getMockBuilder(ProjectRepository::class)->disableOriginalConstructor()->getMock();
        $projectRepository->expects(self::once())->method('findForFilter')->willReturn($projects);
        $projectController->_set('projectRepository', $projectRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('projects', $projects);
        $view->expects(self::once())->method('render')->willReturn(json_encode($projects, JSON_THROW_ON_ERROR));
        $projectController->_set('view', $view);

        $cache = $this->getMockBuilder(FrontendInterface::class)->disableOriginalConstructor()->getMock();
        $cache->expects(self::once())->method('get')->willReturn(false);
        $cache->expects(self::once())->method('set');
        $projectController->_set('cache', $cache);

        $projectController->listAction();
    }
}
