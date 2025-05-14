<?php

namespace Jmf\CurlClient;

use Override;
use PHPUnit\Framework\TestCase;

class CurlClientTest extends TestCase
{
    private CurlClient $curlClient;

    #[Override]
    protected function setUp(): void
    {
        $this->curlClient = new CurlClient();
    }

    public function testSimpleExecution(): void
    {
        $result = $this->curlClient->execute(
            [
                CURLOPT_URL            => 'https://httpbin.org/get',
                CURLOPT_RETURNTRANSFER => true,
            ],
        );

        self::assertIsString($result->getResponseContent());
        self::assertSame(200, $result->getInfo('http_code'));
    }
}
