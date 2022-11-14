<?php

declare(strict_types=1);

namespace JS\Wechange\Controller;

use JS\Wechange\Domain\Model\Filter\FilterFactory;
use JS\Wechange\Domain\Repository\ConferenceRepository;
use JS\Wechange\Service\CachingService;
use TYPO3\CMS\Core\Cache\Frontend\FrontendInterface;

class ConferenceController extends AbstractFilterController
{
    protected ConferenceRepository $conferenceRepository;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(
        FrontendInterface $cache,
        FilterFactory $filterFactory,
        ConferenceRepository $conferenceRepository,
        CachingService $cachingService
    ) {
        parent::__construct($cache, $filterFactory, $cachingService);

        $this->conferenceRepository = $conferenceRepository;
    }

    public function getCachePrefix(): string
    {
        return 'conferenceList_';
    }

    public function assignObjects(): void
    {
        $conferenceFilter = $this->filterFactory->makeConferenceFilter($this->settings['filter']);
        $this->view->assign('conferences', $this->conferenceRepository->findForFilter($conferenceFilter));
    }
}
