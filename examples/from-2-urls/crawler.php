<?php

declare(strict_types=1);

use Crawler\DocumentBuilder;
use Crawler\Parser\AssocArrayParser;
use Crawler\Properties;
use Crawler\Property;
use Crawler\Type\KeyType;
use Crawler\Type\StringType;

require_once __DIR__.'/../../vendor/autoload.php';

$linioURL = 'https://www.linio.com.mx/p/fimi-4k-hd-palm-handheld-gimbal-camera-pocket-estabilizador-negro-yoxjnj';
$amazonURL = 'https://www.amazon.com.mx/Estabilizador-inteligente-Bluetooth-micr%C3%B3fono-integrado/dp/B085G7VYY2';

$linioDocument = (new DocumentBuilder())->createFromURL($linioURL);
$amazonDocument = (new DocumentBuilder())->createFromURL($amazonURL);

$properties = new Properties();

$properties->add(new Property([
    'name' => 'linio',
    'type' => KeyType::getTypeName(),
    'context' => [
        'properties' => [
            [
                'name' => 'title',
                'type' => StringType::getTypeName(),
                'xpath' => '//*[@id="display-zoom"]/div[1]/h1/span',
                'context' => [],
            ],
            [
                'name' => 'price',
                'type' => StringType::getTypeName(),
                'xpath' => '//*[@id="display-zoom"]/div[2]/div[1]/div[2]/div/div/span',
                'context' => [],
            ],
        ],
    ],
], $linioDocument));

$properties->add(new Property([
    'name' => 'amazom',
    'type' => KeyType::getTypeName(),
    'context' => [
        'properties' => [
            [
                'name' => 'title',
                'type' => StringType::getTypeName(),
                'xpath' => '//*[@id="productTitle"]',
                'context' => [],
            ],
            [
                'name' => 'price',
                'type' => StringType::getTypeName(),
                'xpath' => '//*[@id="price_inside_buybox"]',
                'context' => [],
            ],
        ],
    ],
], $amazonDocument));

echo json_encode((new AssocArrayParser($properties))->parse(), JSON_THROW_ON_ERROR).PHP_EOL;
