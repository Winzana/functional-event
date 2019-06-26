<?php

namespace Winzana\Core\Event\Utils;


class AnnotationParser
{

    public static function getClassName(string $filename): string
    {
        $directoriesAndFilename = explode('/', $filename);
        $filename = array_pop($directoriesAndFilename);
        $nameAndExtension = explode('.', $filename);

        return array_shift($nameAndExtension);
    }

    public static function getFullNamespace(string $filename): string
    {
        $lines = file($filename);
        $namespace = preg_grep('/^namespace /', $lines);
        $namespaceLine = array_shift($namespace);
        $match = array();
        preg_match('/^namespace (.*);$/', $namespaceLine, $match);

        return array_pop($match);
    }

    public static function getAllFcqn(string $filename): string
    {
        return static::getFullNamespace($filename) . '\\' . static::getClassName($filename);
    }

    public static function slug(string $className): string
    {
        return strtolower(str_replace('\\', '_', $className));
    }
}
