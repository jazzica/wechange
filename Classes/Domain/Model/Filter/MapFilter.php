<?php
/**
 * Date: 04/2020
 *
 * @author Jessica Schlierenkamp <mail@schlierenkamp.de>
 */

declare(strict_types = 1);

namespace JS\Wechange\Domain\Model\Filter;

use function GuzzleHttp\Psr7\str;

class MapFilter implements FilterInterface
{
    public bool $showPeople;
    public bool $showEvents;
    public bool $showProjects;
    public bool $showGroups;
    public bool $showIdeas;
    public int $limit;

    public function __construct(
        bool $showPeople = true,
        bool $showEvents = true,
        bool $showProjects = true,
        bool $showGroups = true,
        bool $showIdeas = true,
        int $limit = 1000
    ) {
        $this->showPeople = $showPeople;
        $this->showEvents = $showEvents;
        $this->showProjects = $showProjects;
        $this->showGroups = $showGroups;
        $this->showIdeas = $showIdeas;
        $this->limit = $limit;
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

    public function buildQueryString(): string
    {
        $queryString[] = $this->isShowPeople() ? 'people=true' : 'people=false';
        $queryString[] = $this->isShowEvents() ? 'events=true' : 'events=false';
        $queryString[] = $this->isShowProjects() ? 'projects=true' : 'projects=false';
        $queryString[] = $this->isShowGroups() ? 'groups=true' : 'groups=false';
        $queryString[] = $this->isShowIdeas() ? 'ideas=true' : 'ideas=false';
        $queryString[] = 'search_result_limit=' . $this->getLimit();

        return implode('&', $queryString);
    }
}
