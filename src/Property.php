<?php

declare(strict_types=1);

namespace Crawler;

use ArrayObject;
use Crawler\Type\Instantiator;
use InvalidArgumentException;

class Property
{
    protected string $name;
    protected string $classType;
    protected array $context;
    protected array $properties;
    protected ?string $xpath = null;
    protected Document $document;

    public function __construct(array $config, Document $document = null)
    {
        $document = $document ?? $config['context']['document'];

        if (!$document instanceof Document) {
            throw new InvalidArgumentException('Document is not defined');
        }

        $this->document = $document;
        $this->classType = $this->document
            ->getConfiguration()
            ->getTypeClass($config['type'])
        ;

        $this->name = $config['name'];
        $this->xpath = $config['xpath'] ?? null;

        $config['context']['name'] = $config['name'];
        $this->context = $config['context'];
        $this->properties = $config['context']['properties'] ?? [];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue()
    {
        if ($this->xpath) {
            $documents = $this->document->query($this->xpath);
        } else {
            $documents = new ArrayObject([$this->document]);
        }

        if (0 === $documents->count()) {
            return null;
        }

        $type = (new Instantiator(new Element($documents), $this->classType, $this->context))->getType();

        return $type->getValue();
    }
}
