<?php

declare(strict_types=1);

namespace Doomy\Testing;

use Dibi\Connection;
use PHPUnit\Framework\TestCase;

abstract class AbstractDbAwareTestCase extends TestCase
{
    protected Connection $connection;

    public function __construct(string $name, ?array $config = null)
    {
        if ($config === null) {
            $rawConfig = file_get_contents(__DIR__ . '/../testingDbCredentials.json');
            if ($rawConfig === false) {
                throw new \Exception('Could not read config');
            }
            $config = json_decode($rawConfig, true);
        }

        if (! is_array($config)) {
            throw new \Exception('Invalid config');
        }
        $this->connection = new Connection($config);
        parent::__construct($name);
    }
}
