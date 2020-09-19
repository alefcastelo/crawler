<?php

declare(strict_types=1);

namespace Crawler\Parser;

use Crawler\Document;
use Crawler\Parser;
use Crawler\Properties;

class AssocArrayParser implements Parser
{
    protected Document $document;

    protected Properties $properties;

    public function __construct(
        Properties $properties
    ) {
        $this->properties = $properties;
    }

    public function parse(): array
    {
        $data = [];

        foreach ($this->properties as $property) {
            $data[$property->getName()] = $property->getValue();
        }

        return $data;
    }
}
