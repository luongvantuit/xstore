<?php

namespace XStore\Services;
require_once __DIR__ . "/../Bootstrap.php";
use function XStore\bootstrap;
class BaseService
{
    protected $uow;
    public function __construct()
    {
        $this->uow = bootstrap()->getUow();
    }
}