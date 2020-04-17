<?php
/**
 * Date: 04/2020
 *
 * @author Jessica Schlierenkamp <mail@schlierenkamp.de>
 */

declare(strict_types = 1);

namespace JS\Wechange\Domain\Model\Filter;

class ProjectFilter
{
    public const ORDER_ASC = 'ASC';
    public const ORDER_DESC = 'DESC';

    private int $parent;
    private string $tag;
    private int $limit;
    private string $orderBy;
    private string $orderDir;

    public function __construct(
        int $parent = 0,
        string $tag = '',
        int $limit = 10,
        string $orderBy = '',
        string $orderDir = self::ORDER_ASC
    ) {
        $this->parent = $parent;
        $this->tag = $tag;
        $this->limit = $limit;
        $this->orderBy = $orderBy;
        $this->orderDir = $orderDir;
    }

    /**
     * @return int
     */
    public function getParent(): int
    {
        return $this->parent;
    }

    /**
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return string
     */
    public function getOrderBy(): string
    {
        return $this->orderBy;
    }

    /**
     * @return string
     */
    public function getOrderDir(): string
    {
        return $this->orderDir;
    }
}
