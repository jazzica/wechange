<?php
/**
 * Date: 04/2020
 *
 * @author Jessica Schlierenkamp <mail@schlierenkamp.de>
 */

declare(strict_types = 1);

namespace JS\Wechange\Service;

use JS\Wechange\Exception\Api\RequestFailedException;
use JS\Wechange\Exception\Api\JsonDecodeException;

class ApiService
{
    /**
     * @param string $requestUrl
     *
     * @return array
     * @throws JsonDecodeException
     */
    public function makeRequest(string $requestUrl): array
    {
        $cURLHandle = curl_init();
        curl_setopt($cURLHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cURLHandle, CURLOPT_URL, $requestUrl);
        $cURLResult = curl_exec($cURLHandle);
        $cURLHTTPCode = curl_getinfo($cURLHandle, CURLINFO_HTTP_CODE);
        curl_close($cURLHandle);

        if ($cURLHTTPCode === 200) {
            try {
                $cURLResult = json_decode($cURLResult, false, 512, JSON_THROW_ON_ERROR);
            } catch (\JsonException $e) {
                throw new JsonDecodeException(sprintf(
                    'Decoding JSON failed for cURL request \'%s\' with the following message: %s',
                    $requestUrl,
                    $e->getMessage()
                ));
            }

            $elements = [];
            foreach ($cURLResult->results as $cURLResult) {
                $elements[] = $cURLResult;
            }

            return $elements;
        }

        throw new RequestFailedException(sprintf(
            'The cURL request to the following URL failed: \'%s\' with status: %s',
            $requestUrl,
            $cURLHTTPCode
        ));
    }
}
