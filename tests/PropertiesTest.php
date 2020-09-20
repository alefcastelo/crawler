<?php

declare(strict_types=1);

namespace Crawler;

use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class PropertiesTest extends TestCase
{
    public function testCreatePropertiesSuccessfully(): void
    {
        $property = $this->createMock(Property::class);

        $properties = new Properties();
        $properties->add($property);

        static::assertSame([$property], $properties->getArrayCopy());
    }
}
