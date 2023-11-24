<?php

namespace XStore\X;

class MappersSingleton
{

    static private ?MappersSingleton $instance = null;

    private bool $created;

    private function __construct()
    {
        $this->created = false;
    }


    public function created(): bool
    {
        return $this->created;
    }

    public function create(): void
    {
        $this->created = true;
    }

    static public function get_instance(): MappersSingleton
    {
        if (MappersSingleton::$instance === null) {
            MappersSingleton::$instance = new MappersSingleton();
        }
        return MappersSingleton::$instance;
    }
}
