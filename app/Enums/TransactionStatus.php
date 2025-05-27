<?php

namespace App\Enums;

enum TransactionStatus: string
{
    case INIT = 'initiated';
    case COMPLETED = 'completed';
    case FAILED = 'failed';

    public static function getValues(): array
    {
        return array_column(TransactionStatus::cases(), 'value');
    }

    public static function toArray(): array {

        $reflection = new \ReflectionClass(TransactionStatus::class);

        $constants = $reflection->getConstants();

        return $constants;

    }
}