<?php

namespace Jmf\CurlClient\Wrapper;

/**
 * Low-level object-oriented wrapper for PHP cURL functions.
 */
interface CurlWrapperInterface
{
    /**
     * Wrapper for PHP function curl_init().
     */
    public function __construct(?string $url = null);

    /**
     * Wrapper for PHP function curl_copy_handle().
     */
    public function __clone();

    /**
     * Wrapper for PHP function curl_close().
     */
    public function __destruct();

    /**
     * Wrapper for PHP function curl_setopt().
     */
    public function setOption(int $option, mixed $value): bool;

    /**
     * Wrapper for PHP function curl_setopt_array().
     *
     * @param array<int, mixed> $options Array of options
     */
    public function setOptions(array $options): bool;

    /**
     * Wrapper for PHP function curl_exec().
     */
    public function execute(): bool|string;

    /**
     * Wrapper for PHP function curl_getinfo()
     */
    public function getInfo(int $option = 0): mixed;

    /**
     * Wrapper for PHP function curl_error().
     */
    public function getError(): string;

    /**
     * Wrapper for PHP function curl_errno().
     */
    public function getErrorNumber(): int;

    /**
     * Wrapper for PHP function curl_version().
     *
     * @return array<string, mixed>
     */
    public function getVersion(): array;
}
