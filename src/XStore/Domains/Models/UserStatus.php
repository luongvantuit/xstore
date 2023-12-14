<?php

namespace XStore\Domains\Models;


enum UserStatus: string
{
    case  ACTIVE = "active";
    case  DEACTIVATED = "deactivated";
    case  DELETED = "deleted";
}
