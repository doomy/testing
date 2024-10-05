<?php

declare(strict_types=1);

namespace Doomy\Testing;

use Dibi\Connection;
use Nette\Bootstrap\Configurator;
use Nette\DI\Container;
use PHPUnit\Framework\TestCase;

abstract class AbstractDbAwareTestCase extends TestCase
{
    protected Connection $connection;

    public function __construct(string $name)
    {
        $container = $this->createContainer();
        $this->connection = $container->getByType(Connection::class);
        parent::__construct($name);
    }

    protected function createContainer(): Container
    {
        $configurator = new Configurator();
        $configurator->setTempDirectory(__DIR__ . '/../../../../temp');
        $configurator->addConfig(__DIR__ . '/../../../../config/config.neon');
        $configurator->addConfig(__DIR__ . '/../../../../config/tests.neon');
        return $configurator->createContainer();
    }
}
