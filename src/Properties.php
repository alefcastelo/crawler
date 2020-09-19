<?php

declare(strict_types=1);

namespace Crawler;

use ArrayObject;

class Properties extends ArrayObject
{
    public function add(Property $property): void
    {
        $this->append($property);
    }
}
