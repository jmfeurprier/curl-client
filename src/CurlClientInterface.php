<?php

namespace Jmf\CurlClient;

use CURLFile;
use CURLStringFile;
use Jmf\CurlClient\Exception\CurlExecutionException;

interface CurlClientInterface
{
    public function createFile(
        string $filename,
        ?string $mimeType = null,
        ?string $postedFilename = null,
    ): CURLFile;

    public function createStringFile(
        string $data,
        string $postname,
        string $mime = 'application/octet-stream',
    ): CURLStringFile;

    /**
     * @param array<int, mixed> $options
     *
     * @throws CurlExecutionException
     */
    public function execute(array $options): CurlExecutionResult;
}
