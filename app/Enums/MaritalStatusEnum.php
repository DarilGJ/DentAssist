<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum MaritalStatusEnum: string implements HasLabel
{
    case Married = 'married';
    case Single = 'single';
    case Divorced = 'divorced';
    case Widowed = 'widowed';
    case Separated = 'separated';

    public static function getValuesToArray(): array
    {
        return [
            self::Married->value,
            self::Single->value,
            self::Divorced->value,
            self::Widowed->value,
            self::Separated->value,
        ];
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Married => __('Casad@'),
            self::Single => __('Solter@'),
            self::Divorced => __('Divorciad@'),
            self::Widowed => __('Viud@'),
            self::Separated => __('Separad@'),
        };
    }
}
