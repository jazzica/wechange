<?php

declare(strict_types=1);

namespace JS\Wechange\Domain\Model\Filter;

use JS\Wechange\Domain\Model\Coordinate;

/**
 * @codeCoverageIgnore
 */
class FilterFactory
{
    public function makeMapFilter(array $coordinates, array $filterSettings): MapFilter
    {
        return new MapFilter(
            new Coordinate((float)$coordinates['neLat'], (float)$coordinates['neLon']),
            new Coordinate((float)$coordinates['swLat'], (float)$coordinates['swLon']),
            (bool)$filterSettings['showPeople'],
            (bool)$filterSettings['showEvents'],
            (bool)$filterSettings['showProjects'],
            (bool)$filterSettings['showGroups'],
            (bool)$filterSettings['showIdeas'],
            (int)$filterSettings['limit'],
            (int)$filterSettings['group']
        );
    }

    public function makeProjectFilter(array $filterSettings): ProjectFilter
    {
        return new ProjectFilter(
            (int)$filterSettings['parent'],
            $filterSettings['tag'],
            (int)$filterSettings['limit'],
            $filterSettings['orderBy'],
            $filterSettings['orderDir']
        );
    }
}
