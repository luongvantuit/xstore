<?php

namespace XStore\Domains\Models;


enum OrderStatus: string
{
    case  INCARD = "incard";
    case  PENDING = "pending";
    case  CANCELLED = "cancelled";
    case  DELIVERING = "delivering";
    case  DELIVERED = "delivered";
    case  RETURNING = "returning";
    case  RETURNED = "returned";
}
