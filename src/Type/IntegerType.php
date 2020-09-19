<?php

declare(strict_types=1);

namespace Crawler\Type;

use Crawler\Document;

class IntegerType implements Type
{
    public const TYPE_NAME = 'integer';

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

    public function getValue(): ?int
    {
        $value = $this->document->getData();

        if (null === $value) {
            return null;
        }

        if (\is_string($value)) {
            $value = trim($this->value);
        }

        $value = preg_replace('/[^0-9,.]/', '', $value);

        if (is_numeric($value)) {
            return $value;
        }

        return (int) $value;
    }
}
