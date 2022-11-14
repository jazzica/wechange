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
        int $offset = 0,
        string $orderBy = '',
        string $orderDir = self::ORDER_ASC,
        bool $onlyUpcoming = false
    ) {
        parent::__construct($limit, $offset, $orderBy, $orderDir);

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

        if ($offset = $this->getOffset()) {
            $queryString[] = 'offset=' . $offset;
        }

        return implode('&', $queryString ?? []);
    }
}
