<?php

declare(strict_types=1);

namespace JS\Wechange\Domain\Model\Filter;

interface SortableFilterInterface
{
    public function getOffset(): int;
    public function getOrderBy(): string;
    public function getOrderDir(): string;
}
