<?php
/**
 * Date: 04/2020
 *
 * @author Jessica Schlierenkamp <mail@schlierenkamp.de>
 */

declare(strict_types=1);

namespace JS\Wechange\Tests\Unit\Service;

use JS\Wechange\Exception\Api\RequestFailedException;
use JS\Wechange\Request\CurlRequest;
use JS\Wechange\Service\ApiQueryService;
use phpDocumentor\Reflection\Types\Self_;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class ApiServiceTest extends UnitTestCase
{
    public function testMakeRequestThrowsException(): void
    {
        $curlRequest = $this->getMockBuilder(CurlRequest::class)->disableOriginalConstructor()->getMock();
        $apiService = new ApiQueryService($curlRequest);

        $this->expectException(RequestFailedException::class);

        $apiService->makeRequest('does_not_matter');
    }

    public function testMakeRequest(): void
    {
        $curlResult = new \stdClass();
        $curlResult->results = array_fill(0, 10, 'does_not_matter');
        $curlRequest = $this->getMockBuilder(CurlRequest::class)->disableOriginalConstructor()->getMock();
        $curlRequest->expects(self::once())->method('execute')->willReturn(
            json_encode($curlResult, JSON_THROW_ON_ERROR)
        );
        $curlRequest->expects(self::once())->method('getInfo')->willReturn(200);
        $apiService = new ApiQueryService($curlRequest);

        self::assertCount(10, $apiService->makeRequest('does_not_matter'));
    }
}
