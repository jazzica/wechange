<?php

declare(strict_types=1);

namespace JS\Wechange\Domain\Repository;

use JS\Wechange\Domain\Model\Filter\SortableFilterInterface;

interface SortableRepositoryInterface
{
    public function getApiSlug(): string;

    public function findForFilter(SortableFilterInterface $filter): array;
}
