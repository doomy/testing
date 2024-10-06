<?php

namespace Doomy\Testing;

use Nette\Bootstrap\Configurator;
use Nette\DI\Container;

trait DIContainterTestTrait
{
    private Container $container;

    private function getContainer(): Container
    {
        if (!isset($this->container)) {
            $this->container = $this->createContainer();
        }
        return $this->container;
    }

    private function createContainer(): Container
    {
        $configurator = new Configurator();
        $configurator->setTempDirectory(__DIR__ . '/../../../../temp');
        $configurator->addConfig(__DIR__ . '/../../../../config/config.neon');
        $configurator->addConfig(__DIR__ . '/../../../../config/tests.neon');
        return $configurator->createContainer();
    }
}