<?php
/**
 * Date: 04/2020
 *
 * @author Jessica Schlierenkamp <mail@schlierenkamp.de>
 */

declare(strict_types=1);

namespace JS\Wechange\Domain\Repository;

use JS\Wechange\Domain\Model\Filter\ProjectFilter;
use JS\Wechange\Service\ApiQueryService;

/**
 * @codeCoverageIgnore
 */
class ProjectRepository
{
    private const API_SLUG = 'projects/';
    private ApiQueryService $apiQueryService;

    public function __construct(ApiQueryService $apiQueryService)
    {
        $this->apiQueryService = $apiQueryService;
    }

    /**
     * @throws \JsonException
     */
    public function findForFilter(ProjectFilter $projectFilter): array
    {
        $projects = $this->apiQueryService->makeRequest(self::API_SLUG . '?' . $projectFilter->buildQueryString());
        $this->sort($projects, $projectFilter);

        return $projects;
    }

    protected function sort(array &$projects, ProjectFilter $projectFilter): void
    {
        if ($orderBy = $projectFilter->getOrderBy()) {
            usort($projects, static function ($item1, $item2) use ($orderBy) {
                return strcasecmp($item1->$orderBy, $item2->$orderBy);
            });

            if ($projectFilter->getOrderDir() === ProjectFilter::ORDER_DESC) {
                $projects = array_reverse($projects);
            }
        }
    }
}
