<?php

declare(strict_types=1);

use Crawler\DocumentBuilder;
use Crawler\Parser\AssocArrayParser;
use Crawler\Properties;
use Crawler\Property;

require_once __DIR__.'/../../vendor/autoload.php';

$url = 'https://www.linio.com.mx/p/fimi-4k-hd-palm-handheld-gimbal-camera-pocket-estabilizador-negro-yoxjnj';

$document = (new DocumentBuilder())->createFromURL($url);

$properties = new Properties();

$properties->add(new Property([
    'name' => 'title',
    'type' => 'string',
    'xpath' => '//*[@id="display-zoom"]/div[1]/h1/span',
    'context' => [],
], $document));

$properties->add(new Property([
    'name' => 'price',
    'type' => 'string',
    'xpath' => '//*[@id="display-zoom"]/div[2]/div[1]/div[2]/div/div/span',
    'context' => [],
], $document));

echo json_encode((new AssocArrayParser($properties))->parse(), JSON_THROW_ON_ERROR).PHP_EOL;
