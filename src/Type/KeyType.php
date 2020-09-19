<?php

declare(strict_types=1);

namespace Crawler\Type;

use Crawler\Document;
use Crawler\Parser\AssocArrayParser;
use Crawler\Properties;
use Crawler\Property;

class KeyType implements Type
{
    public const TYPE_NAME = 'key';

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

    public function getValue(): array
    {
        $properties = new Properties();
        foreach ($this->context['properties'] as $propertyConfig) {
            $property = new Property($propertyConfig, $this->document);
            $properties->append($property);
        }

        return (new AssocArrayParser($properties))->parse();
    }
}
