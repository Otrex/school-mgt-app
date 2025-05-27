<?php

namespace App\Enums;

enum TransactionType: string
{
    case DEBIT = 'debit';
    case CREDIT = 'credit';

    public static function getValues(): array
    {
        return array_column(TransactionType::cases(), 'value');
    }

    public static function toArray(): array {

        $reflection = new \ReflectionClass(TransactionType::class);

        $constants = $reflection->getConstants();

        return $constants;

    }
}