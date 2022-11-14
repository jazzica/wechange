<?php

declare(strict_types=1);

namespace JS\Wechange\Domain\Repository;

/**
 * @codeCoverageIgnore
 */
class ProjectRepository extends AbstractSortableRepository
{
    public function getApiSlug(): string
    {
        return 'projects/';
    }
}
