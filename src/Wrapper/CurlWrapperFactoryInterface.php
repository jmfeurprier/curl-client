<?php

namespace Jmf\CurlClient\Wrapper;

interface CurlWrapperFactoryInterface
{
    public function create(): CurlWrapperInterface;
}
