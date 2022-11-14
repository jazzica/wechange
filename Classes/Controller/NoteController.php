<?php

declare(strict_types=1);

namespace JS\Wechange\Controller;

use JS\Wechange\Domain\Model\Filter\FilterFactory;
use JS\Wechange\Domain\Repository\NoteRepository;
use JS\Wechange\Service\CachingService;
use TYPO3\CMS\Core\Cache\Frontend\FrontendInterface;

class NoteController extends AbstractFilterController
{
    protected NoteRepository $noteRepository;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(
        FrontendInterface $cache,
        FilterFactory $filterFactory,
        NoteRepository $noteRepository,
        CachingService $cachingService
    ) {
        parent::__construct($cache, $filterFactory, $cachingService);

        $this->noteRepository = $noteRepository;
    }

    public function getCachePrefix(): string
    {
        return 'noteList_';
    }

    public function assignObjects(): void
    {
        $noteFilter = $this->filterFactory->makeNoteFilter($this->settings['filter']);
        $this->view->assign('notes', $this->noteRepository->findForFilter($noteFilter));
    }
}
