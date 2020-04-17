<?php
/**
 * Date: 04/2020
 *
 * @author Jessica Schlierenkamp <mail@schlierenkamp.de>
 */

declare(strict_types = 1);

namespace JS\Wechange\Domain\Repository;

use JS\Wechange\Domain\Model\Filter\ProjectFilter;
use JS\Wechange\Service\ApiService;

class ProjectRepository
{
    private const API_SLUG = 'projects/';

    /**
     * @var ApiService
     */
    private ApiService $apiService;

    private string $apiBaseUrl;

    /**
     * @param string $apiBaseUrl
     * @param ApiService $apiService
     */
    public function __construct(string $apiBaseUrl, ApiService $apiService)
    {
        $this->apiBaseUrl = $apiBaseUrl;
        $this->apiService = $apiService;
    }

    /**
     * @param ProjectFilter $projectFilter
     *
     * @return array
     * @throws \JsonException
     */
    public function findForFilter(ProjectFilter $projectFilter): array
    {
        $projects = $this->apiService->makeRequest($this->buildQueryStringForFilter($projectFilter));
        $this->sort($projects, $projectFilter);

        return $projects;
    }

    /**
     * @param ProjectFilter $projectFilter
     *
     * @return string
     */
    private function buildQueryStringForFilter(ProjectFilter $projectFilter): string
    {
        $queryString = [];

        if ($parent = $projectFilter->getParent()) {
            $queryString[] = 'parent=' . $parent;
        }

        if ($tag = $projectFilter->getTag()) {
            $queryString[] = 'tags=' . $tag;
        }

        if ($limit = $projectFilter->getLimit()) {
            $queryString[] = 'limit=' . $limit;
        }

        return $this->apiBaseUrl . self::API_SLUG . '?' . implode('&', $queryString);
    }

    /**
     * @param array $projects
     * @param ProjectFilter $projectFilter
     *
     * @return void
     */
    private function sort(array &$projects, ProjectFilter $projectFilter): void
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
