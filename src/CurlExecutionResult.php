<?php

namespace Jmf\CurlClient;

use Jmf\CurlClient\Exception\CurlClientException;
use Jmf\CurlClient\Wrapper\CurlWrapperInterface;
use Webmozart\Assert\Assert;

readonly class CurlExecutionResult
{
    /**
     * @var array<string, mixed>
     */
    private array $infos;

    public function __construct(
        private ?string $responseContent,
        CurlWrapperInterface $curlWrapper,
    ) {
        $infos = $curlWrapper->getInfo();

        Assert::isMap($infos);

        $this->infos = $infos;
    }

    public function getResponseContent(): ?string
    {
        return $this->responseContent;
    }

    /**
     * Get information regarding a specific transfer.
     *
     * @param string $option The key of the option to get
     *
     * @throws CurlClientException
     */
    public function getInfo(string $option): mixed
    {
        if (array_key_exists($option, $this->infos)) {
            return $this->infos[$option];
        }

        throw new CurlClientException("Option {$option} not found.");
    }

    /**
     * Get all information regarding a specific transfer.
     *
     * @return array<string, mixed>
     */
    public function getInfos(): array
    {
        return $this->infos;
    }
}
