<?php

namespace Doomy\Testing\Assert;

use PHPUnit\Framework\Assert;
use Psr\Http\Message\ResponseInterface;

final class HttpResponseAssert
{
    public static function assertResponseCode(ResponseInterface $response, int $responseCode): void
    {
        if ($response->getStatusCode() !== $responseCode) {
            var_dump("response body dump: \n" . $response->getBody()->getContents());
        }

        Assert::assertSame($responseCode, $response->getStatusCode());
    }
}