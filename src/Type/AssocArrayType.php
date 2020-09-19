<?php

declare(strict_types=1);

namespace Crawler\Type;

use ArrayObject;
use Crawler\Parser\AssocArrayParser;
use Crawler\Properties;
use Crawler\Property;

class AssocArrayType implements CollectionType
{
    public const TYPE_NAME = 'assoc_array';

    protected ArrayObject $documents;

    protected array $context;

    public function __construct(ArrayObject $documents, array $context = [])
    {
        $this->documents = $documents;
        $this->context = $context;
    }

    public static function getTypeName(): string
    {
        return self::TYPE_NAME;
    }

    public function getValue(): array
    {
        $data = [];
        foreach ($this->documents as $key => $document) {
            $properties = new Properties();
            foreach ($this->context['properties'] as $propertyConfig) {
                $property = new Property($propertyConfig, $document);
                $properties->append($property);
            }

            $data[] = (new AssocArrayParser($properties))->parse();
        }

        return $data;
    }
}
