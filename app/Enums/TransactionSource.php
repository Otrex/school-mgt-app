<?php

namespace App\Enums;

enum TransactionSource: string
{
    case DONATION = 'donation';
    case MAINTENANCE = 'maintenance';
    case SCHOLARSHIP = 'scholarship';
    case COURSE_PAYMENT = "course_payment";
    case CONTRIBUTION = 'contribution';

    public static function getValues(): array
    {
        return array_column(TransactionSource::cases(), 'value');
    }

    public static function toArray(): array {

        $reflection = new \ReflectionClass(TransactionSource::class);

        $constants = $reflection->getConstants();

        return $constants;

    }
}