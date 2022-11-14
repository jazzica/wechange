<?php

declare(strict_types=1);

namespace JS\Wechange\Domain\Model\Filter;

class ProjectFilter extends AbstractSortableFilter
{
    private int $parent;
    private string $tag;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(
        int $parent = 0,
        string $tag = '',
        int $limit = 10,
        int $offset = 0,
        string $orderBy = '',
        string $orderDir = self::ORDER_ASC
    ) {
        $this->parent = $parent;
        $this->tag = $tag;
        $this->limit = $limit;
        $this->offset = $offset;
        $this->orderBy = $orderBy;
        $this->orderDir = $orderDir;
    }

    public function getParent(): int
    {
        return $this->parent;
    }

    public function getTag(): string
    {
        return $this->tag;
    }

    public function buildQueryString(): string
    {
        if ($parent = $this->getParent()) {
            $queryString[] = 'parent=' . $parent;
        }

        if ($tag = $this->getTag()) {
            $queryString[] = 'tags=' . $tag;
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
