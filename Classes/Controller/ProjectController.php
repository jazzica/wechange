<?php
/**
 * Date: 04/2020
 *
 * @author Jessica Schlierenkamp <mail@schlierenkamp.de>
 */

declare(strict_types = 1);

namespace JS\Wechange\Controller;

use JS\Wechange\Domain\Model\Filter\ProjectFilter;
use JS\Wechange\Domain\Repository\ProjectRepository;
use JS\Wechange\Service\ApiService;
use TYPO3\CMS\Core\Cache\Frontend\FrontendInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class ProjectController extends ActionController
{

    private FrontendInterface $cache;

    public function __construct(FrontendInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @var ProjectRepository
     */
    private ProjectRepository $projectRepository;

    public function initializeAction(): void
    {
        $this->projectRepository = new ProjectRepository($this->settings['api']['baseUrl'], new ApiService());
    }

    public function listAction(): string
    {
        $cacheIdentifier = $this->calculateCacheIdentifier();

        if ($cacheIdentifier === null || ($content = $this->cache->get($cacheIdentifier)) === false) {
            $projectFilter = new ProjectFilter(
                (int)$this->settings['filter']['parent'],
                $this->settings['filter']['tag'],
                (int)$this->settings['filter']['limit'],
                $this->settings['filter']['orderBy'],
                $this->settings['filter']['orderDir']
            );

            try {
                $this->view->assign('projects', $this->projectRepository->findForFilter($projectFilter));
            } catch (\JsonException $e) {
                $this->view->assign('projects', []);
            }

            $content = $this->view->render();
            $this->cache->set($cacheIdentifier, $content, [], $this->settings['cache']['lifetime']);
        }

        return $content;
    }

    private function calculateCacheIdentifier(): ?string
    {
        $contentObj = $this->configurationManager->getContentObject();

        if (!$contentObj) {
            return null;
        }

        return 'projectList_' . $contentObj->data['uid'];
    }
}
