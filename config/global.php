<?php

declare(strict_types=1);

return [
    'types' => [
        \Crawler\Type\KeyType::TYPE_NAME => \Crawler\Type\KeyType::class,
        \Crawler\Type\ArrayType::TYPE_NAME => \Crawler\Type\ArrayType::class,
        \Crawler\Type\AssocArrayType::TYPE_NAME => \Crawler\Type\AssocArrayType::class,
        \Crawler\Type\StringType::TYPE_NAME => \Crawler\Type\StringType::class,
        \Crawler\Type\IntegerType::TYPE_NAME => \Crawler\Type\IntegerType::class,
        \Crawler\Type\CurrencyType::TYPE_NAME => \Crawler\Type\CurrencyType::class,
    ],
];
