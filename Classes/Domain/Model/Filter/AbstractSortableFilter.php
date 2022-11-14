<?php

declare(strict_types=1);

namespace JS\Wechange\Domain\Model\Filter;

abstract class AbstractSortableFilter extends AbstractFilter implements SortableFilterInterface
{
    public const ORDER_ASC = 'ASC';
    public const ORDER_DESC = 'DESC';

    protected string $orderBy;
    protected string $orderDir;
    protected int $offset;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(
        int $limit = 10,
        int $offset = 0,
        string $orderBy = '',
        string $orderDir = self::ORDER_ASC
    ) {
        $this->limit = $limit;
        $this->offset = $offset;
        $this->orderBy = $orderBy;
        $this->orderDir = $orderDir;
    }

    public function getOrderBy(): string
    {
        return $this->orderBy ?? self::ORDER_ASC;
    }

    public function getOrderDir(): string
    {
        return $this->orderDir;
    }

    public function getOffset(): int
    {
        return $this->offset ?? 0;
    }

    public function buildQueryString(): string
    {
        if ($limit = $this->getLimit()) {
            $queryString[] = 'limit=' . $limit;
        }

        if ($offset = $this->getOffset()) {
            $queryString[] = 'offset=' . $offset;
        }

        return implode('&', $queryString ?? []);
    }
}
