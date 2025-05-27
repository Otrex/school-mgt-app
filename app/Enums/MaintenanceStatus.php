<?php

namespace App\Enums;

enum MaintenanceStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';

    public static function getValues(): array
    {
        return array_column(MaintenanceStatus::cases(), 'value');
    }

    public static function toArray(): array {

        $reflection = new \ReflectionClass(MaintenanceStatus::class);

        $constants = $reflection->getConstants();

        return $constants;

    }
}