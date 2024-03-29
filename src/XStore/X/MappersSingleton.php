<?php

namespace XStore\X;

class MappersSingleton
{

    static private ?MappersSingleton $instance = null;

    public bool $created;

    private function __construct()
    {
        $this->created = false;
    }

    static public function getInstance(): MappersSingleton
    {
        if (MappersSingleton::$instance == null) {
            MappersSingleton::$instance = new MappersSingleton();
        }
        return MappersSingleton::$instance;
    }
}
