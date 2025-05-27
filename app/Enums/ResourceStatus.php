<?php

namespace App\Enums;

enum ResourceStatus: string
{
    case AVAILABLE = 'available';

    case IN_USE = 'in_use';

    case UNDER_MAINTENANCE = 'under_maintenance';

    case OUT_OF_ORDER = 'out_of_order';

    public static function getValues(): array
    {
        return array_column(ResourceStatus::cases(), 'value');
    }

    public static function toArray(): array {

        $reflection = new \ReflectionClass(ResourceStatus::class);

        $constants = $reflection->getConstants();

        return $constants;

    }
}