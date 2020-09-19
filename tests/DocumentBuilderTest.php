<?php

declare(strict_types=1);

namespace Crawler;

use DOMText;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class DocumentBuilderTest extends TestCase
{
    public function testCreateDocumentFromHTMLSuccessfully(): void
    {
        $builder = new DocumentBuilder();
        $document = $builder->createFromHTML('http://localhost:8080');

        static::assertInstanceOf(Document::class, $document);
    }

    public function testCreateDocumentFromNodeSuccessfully(): void
    {
        $node = new DOMText('This is a test');

        $builder = new DocumentBuilder();
        $document = $builder->createFromNode($node);

        static::assertInstanceOf(Document::class, $document);
    }
}
