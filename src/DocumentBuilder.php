<?php

declare(strict_types=1);

namespace Crawler;

use DOMDocument;
use DOMNode;
use Spatie\Browsershot\Browsershot;

class DocumentBuilder
{
    /**
     * @var Configuration
     */
    protected ?Configuration $configuration;

    public function __construct(Configuration $configuration = null)
    {
        $this->configuration = $configuration;
    }

    public function getConfiguration(): Configuration
    {
        return $this->configuration ?? new Configuration();
    }

    public function createFromHTML(string $html, Configuration $configuration = null): Document
    {
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $document = new Document($dom);
        $document->setConfiguration($configuration ?? $this->getConfiguration());

        return $document;
    }

    public function createFromURL(string $url, Configuration $configuration = null): Document
    {
        $browsershot = new Browsershot($url);
        $browsershot->ignoreHttpsErrors();

        return $this->createFromHTML($browsershot->bodyHtml(), $configuration);
    }

    public function createFromNode(DOMNode $node, Configuration $configuration = null): Document
    {
        $doc = new DOMDocument();
        $doc->appendChild($doc->importNode($node, true));

        return $this->createFromHTML($doc->saveHTML(), $configuration);
    }
}
