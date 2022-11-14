<?php

declare(strict_types=1);

namespace JS\Wechange\Controller;

interface FilterControllerInterface
{
    public function listAction(): string;

    public function getCachePrefix(): string;

    public function assignObjects(): void;
}
