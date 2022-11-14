<?php

declare(strict_types=1);

namespace JS\Wechange\Controller;

use JS\Wechange\Domain\Model\Filter\FilterFactory;
use JS\Wechange\Domain\Repository\ProjectRepository;
use JS\Wechange\Service\CachingService;
use TYPO3\CMS\Core\Cache\Frontend\FrontendInterface;

class ProjectController extends AbstractFilterController
{
    protected ProjectRepository $projectRepository;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(
        FrontendInterface $cache,
        FilterFactory $filterFactory,
        ProjectRepository $projectRepository,
        CachingService $cachingService
    ) {
        parent::__construct($cache, $filterFactory, $cachingService);

        $this->projectRepository = $projectRepository;
    }

    public function getCachePrefix(): string
    {
        return 'projectList_';
    }

    public function assignObjects(): void
    {
        $projectFilter = $this->filterFactory->makeProjectFilter($this->settings['filter']);
        $this->view->assign('projects', $this->projectRepository->findForFilter($projectFilter));
    }
}
