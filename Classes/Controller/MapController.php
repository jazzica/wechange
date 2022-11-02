<?php
/**
 * Date: 04/2020
 *
 * @author Jessica Schlierenkamp <mail@schlierenkamp.de>
 */

declare(strict_types=1);

namespace JS\Wechange\Controller;

use JS\Wechange\Domain\Model\Coordinate;
use JS\Wechange\Domain\Model\Filter\FilterFactory;
use JS\Wechange\Domain\Model\Filter\MapFilter;
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
