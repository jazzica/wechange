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
        $mapFilter = new MapFilter();
        $this->view->assign('iframeSource',
            $this->settings['map']['baseUrl'] . 'map/embed/?' . $mapFilter->buildQueryString());
    }
}
