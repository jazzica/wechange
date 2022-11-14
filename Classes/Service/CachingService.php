<?php

declare(strict_types=1);

namespace JS\Wechange\Service;

use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * @codeCoverageIgnore
 */
class CachingService
{
    public function calculateCacheIdentifier(?ContentObjectRenderer $contentObj, string $prefix): string
    {
        if (!$contentObj) {
            return '';
        }

        return $prefix . $contentObj->data['uid'];
    }
}
