<?php

namespace Core;

/**
 * View
 *
 * PHP version 7.0
 */
class View
{
    /**
     * Метод удаления директории с кэшем
     *
     */
    public function clearCache()
    {
        self::rmDir(PROJECT_CACHE_PATH);
        mkdir(PROJECT_CACHE_PATH);
    }

    public static function rmDir($dir)
    {
        $dir = rtrim($dir, '/');
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != '.' && $object != '..') {
                    if (is_dir($dir . '/' . $object)) {
                        self::rmDir($dir . '/' . $object);
                    } else {
                        unlink($dir . '/' . $object);
                    }
                }
            }
            rmdir($dir);
        }
    }

    public static function makeactivelink($a)
    {
        $data = explode(' ', $a);
        return $data;
    }
}
