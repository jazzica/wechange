<?php

declare(strict_types=1);

namespace JS\Wechange\Domain\Repository;

use JS\Wechange\Domain\Model\Filter\AbstractSortableFilter;
use JS\Wechange\Domain\Model\Filter\SortableFilterInterface;
use JS\Wechange\Service\ApiQueryService;

abstract class AbstractSortableRepository implements SortableRepositoryInterface
{
    protected ApiQueryService $apiQueryService;

    public function __construct(ApiQueryService $apiQueryService)
    {
        $this->apiQueryService = $apiQueryService;
    }

    /**
     * @throws \JsonException
     */
    public function findForFilter(SortableFilterInterface $filter): array
    {
        $objects = $this->apiQueryService->makeRequest($this->getApiSlug() . '?' . $filter->buildQueryString());
        $this->sort($objects, $filter);

        return $objects;
    }

    protected function sort(array &$objects, SortableFilterInterface $filter): void
    {
        if ($orderBy = $filter->getOrderBy()) {
            usort($objects, static function ($object1, $object2) use ($orderBy) {
                return strcasecmp($object1->$orderBy, $object2->$orderBy);
            });

            if ($filter->getOrderDir() === AbstractSortableFilter::ORDER_DESC) {
                $objects = array_reverse($objects);
            }
        }
    }
}
