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
    private int $parent;

    private string $tag;

    public function __construct(int $parent = 0, string $tag = '')
    {
        $this->parent = $parent;
        $this->tag = $tag;
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
}
