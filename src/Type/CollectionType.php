<?php

declare(strict_types=1);

namespace Crawler\Type;

use ArrayObject;

interface CollectionType
{
    public function __construct(ArrayObject $documents, array $context = []);

    public static function getTypeName(): string;

    public function getValue();
}
