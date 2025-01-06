<?php

namespace Doomy\Testing\Assert;

use Doomy\Testing\Exception\KeyNotFoundException;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Constraint\Constraint;

final class JsonResponseAssert
{
    /**
     * @param array<mixed> $data
     */
    final static public function assertJsonOkResponseWithData(array $data, string $responseBody): void
    {
        $decoded = json_decode($responseBody, true);

        try {
            foreach ($data as $key => $value) {
                self::assertValueInJson($key, $value, $decoded['data'] ?? null);
            }
        } catch (KeyNotFoundException $e) {
            $keyMessage = $e->getMessage();

            $message = $keyMessage . "\n\n" . "structures: \nexpected: \n" . json_encode($data, JSON_PRETTY_PRINT) . "\n\nactual:\n" . json_encode($decoded, JSON_PRETTY_PRINT);
            Assert::fail($message);
        }
    }

    static private function assertValueInJson(string $name, mixed $value, ?array $data): void
    {
        Assert::assertNotNull($data);
        if (!array_key_exists($name, $data)) {
            throw new KeyNotFoundException("Key '{$name}' not found in data.");
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