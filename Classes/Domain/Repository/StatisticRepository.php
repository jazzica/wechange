<?php

declare(strict_types=1);

namespace JS\Wechange\Domain\Repository;

use JS\Wechange\Domain\Model\Filter\FilterInterface;

/**
 * @codeCoverageIgnore
 */
class StatisticRepository extends AbstractRepository
{
    public function getApiSlug(): string
    {
        return 'statistics/';
    }

    /**
     * @throws \JsonException
     */
    public function findForFilter(FilterInterface $filter): array
    {
        return $this->apiQueryService->makeRequest($this->getApiSlug() . '?' . $filter->buildQueryString(), '');
    }
}
