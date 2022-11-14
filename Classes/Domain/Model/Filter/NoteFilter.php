<?php

declare(strict_types=1);

namespace JS\Wechange\Domain\Model\Filter;

class NoteFilter extends AbstractSortableFilter
{
    private int $group;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(
        int $group = 0,
        int $limit = 10,
        int $offset = 0,
        string $orderBy = '',
        string $orderDir = self::ORDER_ASC
    ) {
        parent::__construct($limit, $offset, $orderBy, $orderDir);

        $this->group = $group;
    }

    public function getGroup(): int
    {
        return $this->group;
    }

    public function buildQueryString(): string
    {
        if ($group = $this->getGroup()) {
            $queryString[] = 'group=' . $group;
        }

        if ($limit = $this->getLimit()) {
            $queryString[] = 'limit=' . $limit;
        }

        if ($offset = $this->getOffset()) {
            $queryString[] = 'offset=' . $offset;
        }

        return implode('&', $queryString ?? []);
    }
}
