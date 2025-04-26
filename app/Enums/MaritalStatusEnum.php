<?php

namespace App\Enums;

enum MaritalStatusEnum: string
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
            self::Separated->value
        ];
    }
}
