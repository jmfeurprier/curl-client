<?php

namespace Jmf\CurlClient\Wrapper;

class CurlWrapperFactory implements CurlWrapperFactoryInterface
{
    public function create(): CurlWrapperInterface
    {
        return new CurlWrapper();
    }
}
