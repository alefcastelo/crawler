<?php

declare(strict_types=1);

namespace Crawler;

use ArrayObject;
use Crawler\Type\StringType;
use PhpCsFixer\Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class ConfigurationTest extends TestCase
{
    public function testCreateConfigurationSuccessfully(): void
    {
        $configuration = new Configuration();
        $classType = $configuration->getTypeClass(StringType::getTypeName());
        static::assertSame(StringType::class, $classType);
    }

    public function testCreateCustomConfiguration(): void
    {
        $customConfiguration = new Configuration([
            'types' => [
                'array_object' => ArrayObject::class,
            ],
        ]);
        $classType = $customConfiguration->getTypeClass('array_object');
        static::assertSame(ArrayObject::class, $classType);
    }
}
