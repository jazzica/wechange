<?php

declare(strict_types=1);

namespace JS\Wechange\Domain\Model\Filter;

abstract class AbstractFilter implements FilterInterface
{
    protected int $limit;

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function buildQueryString(): string
    {
        if ($limit = $this->getLimit()) {
            $queryString[] = 'limit=' . $limit;
        }

        return implode('&', $queryString ?? []);
    }
}
