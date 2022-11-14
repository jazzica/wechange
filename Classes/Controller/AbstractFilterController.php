<?php

declare(strict_types=1);

namespace JS\Wechange\Controller;

use JS\Wechange\Domain\Model\Filter\FilterFactory;
use JS\Wechange\Service\CachingService;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use TYPO3\CMS\Core\Cache\Frontend\FrontendInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

abstract class AbstractFilterController extends ActionController implements
    FilterControllerInterface,
    LoggerAwareInterface
{
    use LoggerAwareTrait;

    protected FrontendInterface $cache;
    protected FilterFactory $filterFactory;
    protected CachingService $cachingService;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(
        FrontendInterface $cache,
        FilterFactory $filterFactory,
        CachingService $cachingService
    ) {
        $this->cache = $cache;
        $this->filterFactory = $filterFactory;
        $this->cachingService = $cachingService;
    }

    public function listAction(): string
    {
        $cacheIsInactive = (int)$this->settings['cache']['inactive'];
        $cacheIdentifier = $this->cachingService->calculateCacheIdentifier(
            $this->configurationManager->getContentObject(),
            $this->getCachePrefix()
        );

        if ($cacheIsInactive || $cacheIdentifier === '' || ($content = $this->cache->get($cacheIdentifier)) === false) {
            try {
                $this->assignObjects();
            } catch (\Throwable $exception) {
                $this->logger->error($exception->getMessage());
            }

            $content = $this->view->render();

            if (!$cacheIsInactive) {
                $this->cache->set($cacheIdentifier, $content, [], $this->settings['cache']['lifetime']);
            }
        }

        return $content ?: '';
    }
}
