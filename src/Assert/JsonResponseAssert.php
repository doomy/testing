<?php

namespace Doomy\Testing\Assert;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Constraint\Constraint;

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

        $decoded = json_decode($responseBody, true);
        foreach ($data as $key => $value) {
            self::assertValueInJson($key, $value, $decoded['data'] ?? null);
        }


    }

    static private function assertValueInJson(string $name, mixed $value, ?array $data): void
    {
        Assert::assertNotNull($data);
        if (!array_key_exists($name, $data)) {
            Assert::fail("Key '{$name}' not found in data");
        }
        if (is_array($value)) {
            foreach ($value as $key => $subValue) {
                self::assertValueInJson($key, $subValue, $data[$name]);
            }
            return;
        } elseif ($value instanceof Constraint) {
            $value->evaluate($data[$name]);
            return;
        }
        Assert::assertEquals($value, $data[$name]);
    }

}