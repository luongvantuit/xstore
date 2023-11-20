<?php

namespace Libraries\PathCompare;


class Path
{

    private function __construct()
    {
    }

    public static function compare(string $origin_path, string $path): bool
    {
        $origin_path_explode = explode("/", $origin_path);
        $path_explode = explode("/", $path);
        for ($counter = 0; $counter < count($origin_path_explode); $counter++) {
            if (strlen($origin_path_explode[$counter]) > 0 && $origin_path_explode[$counter][1] == ":") {
                continue;
            }
            if ($origin_path_explode[$counter] != $path_explode[$counter]) {
                return false;
            }
        }
        return true;
    }

    public static function has(array $pathMapping, string $path): bool
    {
        foreach ($pathMapping as $origin_path => $target) {
            if (Path::compare($origin_path, $path)) {
                return true;
            }
        }
        return false;
    }
    public static function target(array $pathMapping, string $path): string
    {
        foreach ($pathMapping as $origin_path => $target) {
            if (Path::compare($origin_path, $path)) {
                return $target;
            }
        }
        return "";
    }
}



?>