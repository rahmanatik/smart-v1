<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

class OrderStatusType extends Enum
{
    const PENDING = 'PENDING';
    const DELIVERED = 'DELIVERED';
}
