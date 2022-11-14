<?php

declare(strict_types=1);

namespace JS\Wechange\Domain\Repository;

/**
 * @codeCoverageIgnore
 */
class NoteRepository extends AbstractSortableRepository
{
    public function getApiSlug(): string
    {
        return 'notes/';
    }
}
