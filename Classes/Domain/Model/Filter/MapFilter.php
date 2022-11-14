<?php

declare(strict_types = 1);

namespace JS\Wechange\Domain\Model\Filter;

use JS\Wechange\Domain\Model\Coordinate;

class MapFilter extends AbstractFilter
{
    private bool $showPeople;
    private bool $showEvents;
    private bool $showProjects;
    private bool $showGroups;
    private bool $showIdeas;
    private int $group;

    private Coordinate $neCoordinates;
    private Coordinate $swCoordinates;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(
        Coordinate $neCoordinates,
        Coordinate $swCoordinates,
        bool $showPeople = true,
        bool $showEvents = true,
        bool $showProjects = true,
        bool $showGroups = true,
        bool $showIdeas = true,
        int $limit = 1000,
        int $group = 0
    ) {
        $this->showPeople = $showPeople;
        $this->showEvents = $showEvents;
        $this->showProjects = $showProjects;
        $this->showGroups = $showGroups;
        $this->showIdeas = $showIdeas;
        $this->limit = $limit;
        $this->neCoordinates = $neCoordinates;
        $this->swCoordinates = $swCoordinates;
        $this->group = $group;
    }

    /**
     * @return bool
     */
    public function isShowPeople(): bool
    {
        return $this->showPeople;
    }

    /**
     * @return bool
     */
    public function isShowEvents(): bool
    {
        return $this->showEvents;
    }

    /**
     * @return bool
     */
    public function isShowProjects(): bool
    {
        return $this->showProjects;
    }

    /**
     * @return bool
     */
    public function isShowGroups(): bool
    {
        return $this->showGroups;
    }

    /**
     * @return bool
     */
    public function isShowIdeas(): bool
    {
        return $this->showIdeas;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return Coordinate
     */
    public function getNeCoordinates(): Coordinate
    {
        return $this->neCoordinates;
    }

    /**
     * @return Coordinate
     */
    public function getSwCoordinates(): Coordinate
    {
        return $this->swCoordinates;
    }

    /**
     * @return int
     */
    public function getGroup(): int
    {
        return $this->group;
    }

    public function buildQueryString(): string
    {
        $queryString[] = $this->isShowPeople() ? 'people=true' : 'people=false';
        $queryString[] = $this->isShowEvents() ? 'events=true' : 'events=false';
        $queryString[] = $this->isShowProjects() ? 'projects=true' : 'projects=false';
        $queryString[] = $this->isShowGroups() ? 'groups=true' : 'groups=false';
        $queryString[] = $this->isShowIdeas() ? 'ideas=true' : 'ideas=false';
        $queryString[] = 'search_result_limit=' . $this->getLimit();
        $queryString[] = 'ne_lat=' . $this->getNeCoordinates()->getLatitude();
        $queryString[] = 'ne_lon=' . $this->getNeCoordinates()->getLongitude();
        $queryString[] = 'sw_lat=' . $this->getSwCoordinates()->getLatitude();
        $queryString[] = 'sw_lon=' . $this->getSwCoordinates()->getLongitude();

        if ($group = $this->getGroup()) {
            $queryString[] = 'filter_group=' . $group;
        }

        return implode('&', $queryString);
    }
}
