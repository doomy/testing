<?php

namespace Doomy\Testing\Assert;

use PHPUnit\Framework\Assert;

final class JsonResponseAssert
{
    /**
     * @param array<mixed> $data
     */
    final static public function assertJsonOkResponseWithData(array $data, string $responseBody): void
    {
        $expected = json_encode([
            'status' => 'ok',
            'data' => $data,
        ]);
        Assert::assertEquals($expected, $responseBody);
    }

}