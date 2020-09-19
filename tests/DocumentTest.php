<?php

declare(strict_types=1);

namespace Crawler;

use DOMDocument;
use DOMText;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class DocumentTest extends TestCase
{
    public function testCreateDocumentSuccessfully(): void
    {
        $dom = new DOMDocument();
        @$dom->loadHTML('<html><body></body></html>');
        $document = new Document($dom);

        static::assertInstanceOf(Document::class, $document);
    }

    public function testSetCustomConfigurationOnDocument(): void
    {
        $dom = new DOMDocument();
        @$dom->importNode(new DOMText('text'));
        $document = new Document($dom);
        $document->setConfiguration(new Configuration());

        static::assertInstanceOf(Configuration::class, $document->getConfiguration());
    }
}
