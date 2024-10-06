<?php

declare(strict_types=1);

namespace Doomy\Testing;

use Dibi\Connection;
use Doomy\Ormtopus\DataEntityManager;
use Nette\Bootstrap\Configurator;
use Nette\DI\Container;
use PHPUnit\Framework\TestCase;

abstract class AbstractDbAwareTestCase extends TestCase
{
    use DIContainterTestTrait;

    protected Connection $connection;

    protected DataEntityManager $data;

    public function __construct(string $name)
    {
        $this->connection = $this->getContainer()->getByType(Connection::class);
        $this->data = $this->getContainer()->getByType(DataEntityManager::class);
        parent::__construct($name);
    }
}
