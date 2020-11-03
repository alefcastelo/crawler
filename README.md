# Crawler

This package provides an easy way to  extract data from static HTML pages based on a schema definition.

## Installation

Use the composer to install this package.

```bash
composer require alefcastelo/crawler
```

## Usage

```php
<?php

declare(strict_types=1);

use Crawler\DocumentBuilder;
use Crawler\Parser\AssocArrayParser;
use Crawler\Properties;
use Crawler\Property;

require_once 'vendor/autoload.php';

$url = $argv[1];

$document = (new DocumentBuilder())->createFromURL($url);

$properties = new Properties();

$properties->add(new Property([
    'name' => 'title',
    'type' => 'string',
    'xpath' => '<XPATH>',
    'context' => [],
], $document));

$properties->add(new Property([
    'name' => 'body',
    'type' => 'string',
    'xpath' => '<XPATH>',
    'context' => [],
], $document));

echo json_encode((new AssocArrayParser($properties))->parse(), JSON_THROW_ON_ERROR).PHP_EOL;
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
