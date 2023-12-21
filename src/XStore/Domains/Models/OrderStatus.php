<?php

namespace XStore\Domains\Models;

use ReflectionClass;

enum OrderStatus: string
{
    case  INCARD = "incard";
    case  PENDING = "pending";
    case  CANCELED = "cancelled";
    case  DELIVERING = "delivering";
    case  DELIVERED = "delivered";
    case  RETURNING = "returning";
    case  RETURNED = "returned";

    public static function getCase($value): ?OrderStatus
    {
        switch ($value) {
            case 'incard':
                return OrderStatus::INCARD;
            case 'pending':
                return OrderStatus::PENDING;
            case 'cancelled':
                return OrderStatus::CANCELED;
            case 'delivering':
                return OrderStatus::DELIVERING;
            case 'delivered':
                return OrderStatus::DELIVERED;
            case 'returning':
                return OrderStatus::RETURNING;
            case 'returned':
                return OrderStatus::RETURNED;
            default:
                return null;
        }
        return null;
    }
}
