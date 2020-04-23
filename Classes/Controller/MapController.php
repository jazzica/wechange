<?php
/**
 * Date: 04/2020
 *
 * @author Jessica Schlierenkamp <mail@schlierenkamp.de>
 */

declare(strict_types = 1);

namespace JS\Wechange\Controller;

use JS\Wechange\Domain\Model\Filter\MapFilter;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class MapController extends ActionController
{
    public function showAction(): void
    {
        $mapFilter = new MapFilter(
            (bool)$this->settings['filter']['showPeople'],
            (bool)$this->settings['filter']['showEvents'],
            (bool)$this->settings['filter']['showProjects'],
            (bool)$this->settings['filter']['showGroups'],
            (bool)$this->settings['filter']['showIdeas'],
            (int)$this->settings['filter']['limit']
        );
        $this->view->assign('iframeSource',
            $this->settings['map']['baseUrl'] . 'map/embed/?' . $mapFilter->buildQueryString());
    }
}
