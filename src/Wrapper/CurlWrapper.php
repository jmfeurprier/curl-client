<?php

namespace Jmf\CurlClient\Wrapper;

use CurlHandle;
use Jmf\CurlClient\Exception\CurlClientException;
use Override;
use Webmozart\Assert\Assert;

/**
 * Low-level object-oriented wrapper for PHP cURL functions.
 */
class CurlWrapper implements CurlWrapperInterface
{
    private CurlHandle $handle;

    #[Override]
    public function __construct(?string $url = null)
    {
        $this->handle = curl_init($url);
    }

    #[Override]
    public function __clone()
    {
        $handle = curl_copy_handle($this->handle);

        if (false === $handle) {
            throw new CurlClientException(
                'Failed cloning cURL handle.',
            );
        }

        $this->handle = $handle;
    }

    #[Override]
    public function __destruct()
    {
        curl_close($this->handle);
    }

    #[Override]
    public function setOption(
        int $option,
        mixed $value,
    ): bool {
        return curl_setopt($this->handle, $option, $value);
    }

    #[Override]
    public function setOptions(array $options): bool
    {
        return curl_setopt_array($this->handle, $options);
    }

    #[Override]
    public function execute(): bool | string
    {
        return curl_exec($this->handle);
    }

    #[Override]
    public function getInfo(int $option = 0): mixed
    {
        if (0 === $option) {
            return curl_getinfo($this->handle);
        }

        return curl_getinfo($this->handle, $option);
    }

    #[Override]
    public function getError(): string
    {
        return curl_error($this->handle);
    }

    #[Override]
    public function getErrorNumber(): int
    {
        return curl_errno($this->handle);
    }

    #[Override]
    public function getVersion(): array
    {
        $version = curl_version();

        Assert::isMap($version);

        return $version;
    }
}
