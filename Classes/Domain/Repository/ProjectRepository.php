<?php
/**
 * Date: 04/2020
 *
 * @author Jessica Schlierenkamp <mail@schlierenkamp.de>
 */

declare(strict_types = 1);

namespace JS\Wechange\Domain\Repository;

use JS\Wechange\Service\ApiService;

class ProjectRepository
{

    /**
     * @var ApiService
     */
    private ApiService $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function findForFilter(int $parent): array
    {
        return $this->apiService->makeRequest('https://wechange.de/api/v2/projects/?parent=' . $parent);
    }
}
