<?php
/**
 * Date: 04/2020
 *
 * @author Jessica Schlierenkamp <mail@schlierenkamp.de>
 */
declare(strict_types = 1);

namespace JS\Wechange\Tests\Unit\Service;

use JS\Wechange\Exception\Api\RequestFailedException;
use JS\Wechange\Service\ApiService;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class ApiServiceTest extends UnitTestCase
{
    /**
     * @test
     *
     * @covers \JS\Wechange\Service\ApiService::makeRequest
     */
    public function makeRequestThrowsException(): void
    {
        $this->expectException(RequestFailedException::class);

        $apiService = new ApiService();
        $apiService->makeRequest('does_not_matter');
    }

    /**
     * @test
     *
     * @covers \JS\Wechange\Service\ApiService::makeRequest
     */
    public function makeRequest(): void
    {
        $apiService = new ApiService();

        self::assertCount(10, $apiService->makeRequest('https://wechange.de/api/v2/projects/'));
    }
}
