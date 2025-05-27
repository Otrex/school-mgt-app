<?php

namespace App\Enums;

enum PaymentFrequency: string
{
    case ONE_TIME = 'one_time';
    case MONTHLY = 'monthly';
    case QUARTERLY = 'quarterly';

    public static function getValues(): array
    {
        return array_column(PaymentFrequency::cases(), 'value');
    }

    public static function toArray(): array {

        $reflection = new \ReflectionClass(PaymentFrequency::class);

        $constants = $reflection->getConstants();

        return $constants;

    }
}