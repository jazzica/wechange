<?php
/**
 * Date: 04/2020
 *
 * @author Jessica Schlierenkamp <mail@schlierenkamp.de>
 */

declare(strict_types=1);

namespace JS\Wechange\Controller;

use JS\Wechange\Domain\Model\Filter\FilterFactory;
use JS\Wechange\Domain\Repository\ProjectRepository;
use JS\Wechange\Service\CachingService;
use TYPO3\CMS\Core\Cache\Frontend\FrontendInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class ProjectController extends ActionController
{
    protected FrontendInterface $cache;
    protected FilterFactory $filterFactory;
    protected ProjectRepository $projectRepository;
    protected CachingService $cachingService;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(
        FrontendInterface $cache,
        FilterFactory $filterFactory,
        ProjectRepository $projectRepository,
        CachingService $cachingService
    ) {
        $this->cache = $cache;
        $this->filterFactory = $filterFactory;
        $this->projectRepository = $projectRepository;
        $this->cachingService = $cachingService;
    }

    public function listAction(): string
    {
        $cacheIsInactive = (int)$this->settings['cache']['inactive'];
        $cacheIdentifier = $this->cachingService->calculateCacheIdentifier(
            $this->configurationManager->getContentObject(),
            'projectList_'
        );

        if ($cacheIsInactive || $cacheIdentifier === '' || ($content = $this->cache->get($cacheIdentifier)) === false) {
            try {
                $projectFilter = $this->filterFactory->makeProjectFilter($this->settings['filter']);
                $this->view->assign('projects', $this->projectRepository->findForFilter($projectFilter));
            } catch (\Throwable $exception) {
                $this->view->assign('projects', []);
            }

            $content = $this->view->render();

            if (!$cacheIsInactive) {
                $this->cache->set($cacheIdentifier, $content, [], $this->settings['cache']['lifetime']);
            }
        }

        return $content ?: '';
    }
}
