<?php

declare(strict_types=1);

namespace Crawler;

class Configuration
{
    protected array $types;

    public function __construct(array $config = [])
    {
        $globalConfig = require __DIR__.'/../config/global.php';

        $mergedConfig = array_merge_recursive($globalConfig, $config);

        $this->types = $mergedConfig['types'];
    }

    public function getTypeClass(string $type): string
    {
        if (!isset($this->types[$type])) {
            throw new \InvalidArgumentException(sprintf('The %s type was not found.', $type));
        }

        $class = $this->types[$type];
        if (!class_exists($class)) {
            throw new \InvalidArgumentException(sprintf('The %s class was not found.', $class));
        }

        return $class;
    }
}
