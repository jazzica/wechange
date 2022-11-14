<?php

declare(strict_types=1);

namespace JS\Wechange\Controller;

use JS\Wechange\Domain\Model\Filter\FilterFactory;
use JS\Wechange\Domain\Repository\StatisticRepository;
use JS\Wechange\Service\CachingService;
use TYPO3\CMS\Core\Cache\Frontend\FrontendInterface;

class StatisticController extends AbstractFilterController
{
    protected StatisticRepository $statisticRepository;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(
        FrontendInterface $cache,
        FilterFactory $filterFactory,
        StatisticRepository $statisticRepository,
        CachingService $cachingService
    ) {
        parent::__construct($cache, $filterFactory, $cachingService);

        $this->statisticRepository = $statisticRepository;
    }

    public function getCachePrefix(): string
    {
        return 'statisticList_';
    }

    public function assignObjects(): void
    {
        $statisticFilter = $this->filterFactory->makeStatisticFilter();
        $this->view->assign('statistics', $this->statisticRepository->findForFilter($statisticFilter));
    }
}
