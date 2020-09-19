<?php

declare(strict_types=1);

namespace Crawler\Type;

use ArrayObject;
use Crawler\Parser\ArrayParser;
use Crawler\Properties;
use Crawler\Property;

class ArrayType implements CollectionType
{
    public const TYPE_NAME = 'array';

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
        foreach ($this->documents as $document) {
            $properties = new Properties();
            foreach ($this->context['properties'] as $propertyConfig) {
                $property = new Property($propertyConfig, $document);
                $properties->append($property);
            }

            $data[] = (new ArrayParser($properties))->parse();
        }

        return $data;
    }
}
