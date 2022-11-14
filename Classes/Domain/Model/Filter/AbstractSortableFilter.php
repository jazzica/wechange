<?php

declare(strict_types=1);

namespace JS\Wechange\Domain\Model\Filter;

abstract class AbstractSortableFilter extends AbstractFilter implements SortableFilterInterface
{
    public const ORDER_ASC = 'ASC';
    public const ORDER_DESC = 'DESC';

    protected string $orderBy;
    protected string $orderDir;

    /**
     * @return string
     */
    public function getOrderBy(): string
    {
        return $this->orderBy ?? self::ORDER_ASC;
    }

    /**
     * @return string
     */
    public function getOrderDir(): string
    {
        return $this->orderDir;
    }
}
