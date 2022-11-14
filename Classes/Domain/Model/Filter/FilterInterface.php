<?php

declare(strict_types = 1);

namespace JS\Wechange\Domain\Model\Filter;

interface FilterInterface
{
    public function getLimit(): int;
    public function buildQueryString(): string;
}
