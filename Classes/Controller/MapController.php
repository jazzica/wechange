<?php

declare(strict_types=1);

namespace JS\Wechange\Controller;

use JS\Wechange\Domain\Model\Filter\FilterFactory;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class MapController extends ActionController
{
    protected FilterFactory $filterFactory;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(FilterFactory $filterFactory)
    {
        $this->filterFactory = $filterFactory;
    }

    public function showAction(): void
    {
        $mapFilter = $this->filterFactory->makeMapFilter(
            $this->settings['map']['coordinates'],
            $this->settings['filter']
        );

        $this->view->assign(
            'iframeSource',
            $this->settings['map']['baseUrl'] . 'map/embed/?' . $mapFilter->buildQueryString()
        );
    }
}
