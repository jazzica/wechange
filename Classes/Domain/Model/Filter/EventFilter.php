<?php

declare(strict_types=1);

namespace JS\Wechange\Domain\Model\Filter;

class EventFilter extends AbstractSortableFilter
{
    private bool $onlyUpcoming;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(
        int $limit = 10,
        string $orderBy = '',
        string $orderDir = self::ORDER_ASC,
        bool $onlyUpcoming = false
    ) {
        $this->limit = $limit;
        $this->orderBy = $orderBy;
        $this->orderDir = $orderDir;
        $this->onlyUpcoming = $onlyUpcoming;
    }

    public function isOnlyUpcoming(): bool
    {
        return $this->onlyUpcoming;
    }

    public function buildQueryString(): string
    {
        if ($limit = $this->getLimit()) {
            $queryString[] = 'limit=' . $limit;
        }

        if ($this->isOnlyUpcoming()) {
            $queryString[] = 'upcoming=true';
        }

        return implode('&', $queryString ?? []);
    }
}
