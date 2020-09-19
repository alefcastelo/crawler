<?php

declare(strict_types=1);

namespace Crawler\Type;

use Crawler\Element;

class Instantiator
{
    protected Element $element;

    protected string $class;

    protected array $context = [];

    public function __construct(Element $element, string $class, array $context = [])
    {
        $this->class = $class;
        $this->context = $context;
        $this->element = $element;
    }

    public function getType()
    {
        $value = $this->element->getValue();

        if (is_subclass_of($this->class, CollectionType::class, true)) {
            return new $this->class($value, $this->context);
        }

        return new $this->class($value->offsetGet(0), $this->context);
    }
}
