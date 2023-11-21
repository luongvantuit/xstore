<?php

abstract class Abstract_Unit_Of_Work
{

    private Abstract_Repository $repo;

    public function collect_new_events()
    {
        foreach ($this->repo->get_cached() as $cached) {
            while (!empty($cached->events)) {
                yield array_shift($cached->events);
            }
        }
    }
}

class Php_Unit_Of_Work extends Abstract_Unit_Of_Work
{
    public function __construct()
    {
    }
}