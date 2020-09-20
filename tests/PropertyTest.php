<?php

declare(strict_types=1);

namespace Crawler;

use Crawler\Type\StringType;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class PropertyTest extends TestCase
{
    public function testCreatePropertySuccessfully(): void
    {
        $document = $this->createMock(Document::class);
        $document->expects(static::once())
            ->method('getConfiguration')
            ->willReturn(new Configuration())
        ;

        $document->expects(static::once())
            ->method('getData')
            ->willReturn('any')
        ;

        $property = new Property([
            'name' => 'any',
            'type' => StringType::getTypeName(),
        ], $document);

        static::assertSame('any', $property->getName());
        static::assertSame('any', $property->getValue());
    }

    public function testExpectedExceptionWheCreatePropertyWithoutDocument(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Property([
            'name' => 'any',
            'type' => StringType::getTypeName(),
        ]);
    }
}
