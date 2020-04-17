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

    public function __construct(string $apiBaseUrl, ApiService $apiService)
    {
        $this->apiBaseUrl = $apiBaseUrl;
        $this->apiService = $apiService;
    }

    public function findForFilter(ProjectFilter $projectFilter): array
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

        return $this->apiService->makeRequest($this->apiBaseUrl . self::API_SLUG . '?' . implode('&', $queryString));
    }
}
