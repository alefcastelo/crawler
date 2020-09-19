<?php

declare(strict_types=1);

namespace Crawler\Type;

use Crawler\Document;

interface Type
{
    public function __construct(Document $document, array $context = []);

    public static function getTypeName(): string;

    public function getValue();
}
