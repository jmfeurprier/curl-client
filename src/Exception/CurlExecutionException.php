<?php

namespace Jmf\CurlClient\Exception;

use DomainException;
use Jmf\CurlClient\Wrapper\CurlWrapperInterface;
use Webmozart\Assert\Assert;

class CurlExecutionException extends CurlClientException
{
    /**
     * @var array<string, mixed>
     */
    private array $infos;

    public function __construct(CurlWrapperInterface $curlWrapper)
    {
        parent::__construct($curlWrapper->getError(), $curlWrapper->getErrorNumber());

        $infos = $curlWrapper->getInfo();

        Assert::isMap($infos);

        $this->infos = $infos;
    }

    /**
     * Get information regarding a specific transfer.
     *
     * @param string $option The key of the option to get
     *
     * @return mixed
     *
     * @throws DomainException
     */
    public function getInfo(string $option)
    {
        if (array_key_exists($option, $this->infos)) {
            return $this->infos[$option];
        }

        throw new DomainException("Option {$option} not found.");
    }

    /**
     * @return array<string, mixed>
     */
    public function getInfos(): array
    {
        return $this->infos;
    }
}
