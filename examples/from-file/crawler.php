<?php

declare(strict_types=1);

use Crawler\DocumentBuilder;
use Crawler\Parser\AssocArrayParser;
use Crawler\Properties;
use Crawler\Property;
use Crawler\Type\KeyType;
use Crawler\Type\StringType;

require_once __DIR__.'/../../vendor/autoload.php';

$property = [
    'name' => 'items',
    'type' => KeyType::getTypeName(),
    'xpath' => '//*[@id="container"]/div',
    'context' => [
        'properties' => [
            'name' => [
                'name' => 'title',
                'xpath' => '//div/div[1]',
                'type' => StringType::getTypeName(),
                'context' => [],
            ],
            'price' => [
                'name' => 'body',
                'xpath' => '//div/div[2]',
                'type' => StringType::getTypeName(),
                'context' => [],
            ],
        ],
    ],
];

$document = (new DocumentBuilder())->createFromHTML(file_get_contents(__DIR__.'/index.html'));

$properties = new Properties();
$properties->add(new Property($property, $document));

echo json_encode((new AssocArrayParser($properties))->parse(), JSON_THROW_ON_ERROR).PHP_EOL;
