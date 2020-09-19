<?php

declare(strict_types=1);

namespace Crawler;

use ArrayObject;
use DOMDocument;
use DOMNode;
use DOMXPath;

class Document
{
    protected Configuration $configuration;

    protected DOMDocument $document;

    protected DOMXPath $xpath;

    public function __construct(DOMDocument $document)
    {
        $this->document = $document;
        $this->xpath = new DOMXPath($document);
    }

    public function getData(): ?string
    {
        return $this->document->textContent;
    }

    public function query(string $expression): ArrayObject
    {
        $list = $this->xpath->query($expression);
        $documents = new ArrayObject();

        if (null === $list || 0 === $list->count()) {
            return $documents;
        }

        for ($index = 0; $index < $list->length; ++$index) {
            $node = $list->item($index);

            if (!$node instanceof DOMNode) {
                continue;
            }

            $document = (new DocumentBuilder())->createFromNode($node, $this->getConfiguration());
            $documents->append($document);
        }

        return $documents;
    }

    public function setConfiguration(Configuration $configuration): void
    {
        $this->configuration = $configuration;
    }

    public function getConfiguration(): Configuration
    {
        return $this->configuration;
    }
}
