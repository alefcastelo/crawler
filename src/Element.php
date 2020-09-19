<?php

declare(strict_types=1);

namespace Crawler;

use ArrayObject;

class Element
{
    protected ArrayObject $data;

    public function __construct(ArrayObject $data)
    {
        $this->data = $data;
    }

    public function getValue()
    {
        return $this->data;
    }
}
