<?php
/**
 * Date: 04/2020
 *
 * @author Jessica Schlierenkamp <mail@schlierenkamp.de>
 */

declare(strict_types=1);

namespace JS\Wechange\Service;

use JS\Wechange\Exception\Api\RequestFailedException;
use JS\Wechange\Request\CurlRequest;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ApiQueryService
{
    protected string $baseUrl;
    private CurlRequest $curlRequest;

    public function __construct(CurlRequest $curlRequest)
    {
        try {
            $this->baseUrl = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('wechange')['baseUrl'];
        } catch (\Throwable $exception) {
            $this->baseUrl = '';
        }

        $this->curlRequest = $curlRequest;
    }

    /**
     * @throws \JsonException
     */
    public function makeRequest(string $requestSlug, string $resultKey = 'results'): array
    {
        $requestUrl = $this->baseUrl . $requestSlug;

        $cURLResult = $this->curlRequest->execute($requestUrl);
        $cURLHTTPCode = $this->curlRequest->getInfo(CURLINFO_HTTP_CODE);
        $this->curlRequest->close();

        if ($cURLHTTPCode !== 200) {
            throw new RequestFailedException(
                sprintf(
                    'The cURL request to the following URL failed: \'%s\' with status: %s',
                    $requestUrl,
                    $cURLHTTPCode
                )
            );
        }

        if ($resultKey) {
            return json_decode($cURLResult, false, 512, JSON_THROW_ON_ERROR)->$resultKey ?? [];
        }

        return json_decode(
            json_encode(json_decode($cURLResult, false, 512, JSON_THROW_ON_ERROR), JSON_THROW_ON_ERROR),
            true,
            512,
            JSON_THROW_ON_ERROR
        ) ?? [];
    }
}
