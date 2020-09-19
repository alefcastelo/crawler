<?php

declare(strict_types=1);

namespace Crawler\Type;

use Crawler\Document;
use League\ISO3166\ISO3166;
use NumberFormatter;

class CurrencyType implements Type
{
    const DECIMAL_SEPARATOR_DOT = '.';
    const DECIMAL_SEPARATOR_COMMA = ',';

    public const TYPE_NAME = 'currency';

    protected Document $document;

    protected array $context;

    public function __construct(Document $document, array $context = [])
    {
        $this->document = $document;
        $this->context = $context;
    }

    public static function getTypeName(): string
    {
        return self::TYPE_NAME;
    }

    public function getValue(): ?string
    {
        $value = $this->document->getData();

        if (null === $value) {
            return null;
        }

        if (\is_string($value)) {
            $value = trim($value);
        }

        $decimalSeparatorPattern = $this->getDecimalSeparatorByValue($value);

        $value = preg_replace(sprintf('/[^0-9%s]/', $decimalSeparatorPattern), '', $value);

        $iso = new ISO3166();

        $countryConfig = $iso->alpha3($this->context['countryFrom']);
        $locale = \Locale::getPrimaryLanguage($countryConfig['alpha2']);
        $formatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);

        return (string) $formatter->formatCurrency($value, $this->context['countryTo']);
    }

    private function getDecimalSeparatorByValue(string $value): string
    {
        if (strpos($value, self::DECIMAL_SEPARATOR_COMMA) > strpos($value, self::DECIMAL_SEPARATOR_DOT)) {
            return self::DECIMAL_SEPARATOR_COMMA;
        }

        return self::DECIMAL_SEPARATOR_DOT;
    }
}
