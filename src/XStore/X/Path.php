<?php

namespace XStore\X;

class Path
{

    private function __construct()
    {
    }

    public static function compare(string $path_origin, string $path): bool
    {
        $path_origin_explore = explode("/", $path_origin);
        $path_explode = explode("/", $path);
        for ($counter = 0; $counter < count($path_origin_explore); $counter++) {
            if (strlen($path_origin_explore[$counter]) > 0 && $path_origin_explore[$counter][1] == ":") {
                continue;
            }
            if ($path_origin_explore[$counter] != $path_explode[$counter]) {
                return false;
            }
        }
        return true;
    }

    public static function has(array $path_mapping, string $path): bool
    {
        foreach (array_keys($path_mapping) as $path_origin) {
            if (Path::compare($path_origin, $path)) {
                return true;
            }
        }
        return false;
    }

    public static function target(array $path_mapping, string $path): ?string
    {
        foreach ($path_mapping as $path_origin => $target) {
            if (Path::compare($path_origin, $path)) {
                return $target;
            }
        }
        return null;
    }
}
