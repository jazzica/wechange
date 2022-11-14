<?php

declare(strict_types=1);

namespace JS\Wechange\Domain\Repository;

/**
 * @codeCoverageIgnore
 */
class EventRepository extends AbstractSortableRepository
{
    public function getApiSlug(): string
    {
        return 'events/';
    }
}
