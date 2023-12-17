<?php

namespace XStore\X;

class Path
{

    private function __construct()
    {
    }

    public static function compare(string $pathOrigin, string $path): bool
    {
        $pathOriginExplore = explode("/", $pathOrigin);
        $path_explode = explode("/", $path);
        for ($counter = 0; $counter < count($pathOriginExplore); $counter++) {
            if (strlen($pathOriginExplore[$counter]) > 0 && $pathOriginExplore[$counter][1] == ":") {
                continue;
            }
            if ($pathOriginExplore[$counter] != $path_explode[$counter]) {
                return false;
            }
        }
        return true;
    }

    public static function has(array $pathMapping, string $path): bool
    {
        foreach (array_keys($pathMapping) as $pathOrigin) {
            if (Path::compare($pathOrigin, $path)) {
                return true;
            }
        }
        return false;
    }

    public static function target(array $pathMapping, string $path): ?string
    {
        foreach ($pathMapping as $pathOrigin => $target) {
            if (Path::compare($pathOrigin, $path)) {
                return $target;
            }
        }
        return null;
    }

    public static function origin(array $pathMapping, string $path): string
    {
        foreach (array_keys($pathMapping) as $pathOrigin) {
            if (Path::compare($pathOrigin, $path)) {
                return $pathOrigin;
            }
        }
        return false;
    }
}
