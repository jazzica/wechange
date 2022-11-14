<?php

declare(strict_types=1);

namespace JS\Wechange\Request;

/**
 * @codeCoverageIgnore
 */
class CurlRequest
{
    private $handle;

    /**
     * @return bool|string
     */
    public function execute(string $url)
    {
        $this->handle = curl_init();
        curl_setopt($this->handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->handle, CURLOPT_URL, $url);
        return curl_exec($this->handle);
    }

    /**
     * @return mixed
     */
    public function getInfo($name)
    {
        return curl_getinfo($this->handle, $name);
    }

    public function close(): void
    {
        curl_close($this->handle);
    }
}
