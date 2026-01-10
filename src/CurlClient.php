<?php

namespace Jmf\CurlClient;

use CURLFile;
use CURLStringFile;
use Jmf\CurlClient\Exception\CurlClientException;
use Jmf\CurlClient\Exception\CurlExecutionException;
use Jmf\CurlClient\Wrapper\CurlWrapperFactory;
use Jmf\CurlClient\Wrapper\CurlWrapperFactoryInterface;
use Override;

readonly class CurlClient implements CurlClientInterface
{
    public function __construct(
        private CurlWrapperFactoryInterface $curlWrapperFactory = new CurlWrapperFactory(),
    ) {
    }

    #[Override]
    public function createFile(
        string $filename,
        ?string $mimeType = null,
        ?string $postedFilename = null,
    ): CURLFile {
        return new CURLFile($filename, $mimeType, $postedFilename);
    }

    #[Override]
    public function createStringFile(
        string $data,
        string $postname,
        string $mime = 'application/octet-stream',
    ): CURLStringFile {
        return new CURLStringFile($data, $postname, $mime);
    }

    #[Override]
    public function execute(array $options): CurlExecutionResult
    {
        $curlWrapper = $this->curlWrapperFactory->create();

        if (!$curlWrapper->setOptions($options)) {
            throw new CurlClientException('Failed setting options.');
        }

        $responseContent = $curlWrapper->execute();

        if (false === $responseContent) {
            throw new CurlExecutionException($curlWrapper);
        }

        if (true === $responseContent) {
            $responseContent = null;
        }

        return new CurlExecutionResult($responseContent, $curlWrapper);
    }
}
