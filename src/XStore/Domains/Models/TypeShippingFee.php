<?php

namespace XStore\Domains\Models;


enum TypeShippingFee: int
{
    case  LOCAL_SHIPPING = 1;
    case  OTHER_SHIPPING = 2;
}
