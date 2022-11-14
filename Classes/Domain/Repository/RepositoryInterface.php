<?php

declare(strict_types=1);

namespace JS\Wechange\Domain\Repository;

use JS\Wechange\Domain\Model\Filter\FilterInterface;

interface RepositoryInterface
{
    public function getApiSlug(): string;

    public function findForFilter(FilterInterface $filter): array;
}
