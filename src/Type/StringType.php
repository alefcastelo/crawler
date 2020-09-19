<?php

declare(strict_types=1);

namespace Crawler\Type;

use Crawler\Document;

class StringType implements Type
{
    public const TYPE_NAME = 'string';

    protected Document $document;

    protected array $context;

    public function __construct(Document $document, array $context = [])
    {
        $this->document = $document;
        $this->context = $context;
    }

    public static function getTypeName(): string
    {
        return self::TYPE_NAME;
    }

    public function getValue(): ?string
    {
        $value = $this->document->getData();

        if (null === $value) {
            return null;
        }

        return trim(strip_tags($value));
    }
}
