<?php

declare(strict_types=1);

namespace JS\Wechange\Domain\Repository;

use JS\Wechange\Domain\Model\Filter\FilterInterface;
use JS\Wechange\Service\ApiQueryService;

abstract class AbstractRepository implements RepositoryInterface
{
    protected ApiQueryService $apiQueryService;

    public function __construct(ApiQueryService $apiQueryService)
    {
        $this->apiQueryService = $apiQueryService;
    }

    /**
     * @throws \JsonException
     */
    public function findForFilter(FilterInterface $filter): array
    {
        return $this->apiQueryService->makeRequest($this->getApiSlug() . '?' . $filter->buildQueryString());
    }
}
