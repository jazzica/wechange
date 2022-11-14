<?php

declare(strict_types=1);

namespace JS\Wechange\Controller;

use JS\Wechange\Domain\Model\Filter\FilterFactory;
use JS\Wechange\Domain\Repository\EventRepository;
use JS\Wechange\Service\CachingService;
use TYPO3\CMS\Core\Cache\Frontend\FrontendInterface;

class EventController extends AbstractFilterController
{
    protected EventRepository $eventRepository;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(
        FrontendInterface $cache,
        FilterFactory $filterFactory,
        EventRepository $eventRepository,
        CachingService $cachingService
    ) {
        parent::__construct($cache, $filterFactory, $cachingService);

        $this->eventRepository = $eventRepository;
    }

    public function getCachePrefix(): string
    {
        return 'eventList_';
    }

    public function assignObjects(): void
    {
        $eventFilter = $this->filterFactory->makeEventFilter($this->settings['filter']);
        $this->view->assign('events', $this->eventRepository->findForFilter($eventFilter));
    }
}
