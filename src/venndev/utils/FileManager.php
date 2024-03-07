<?php

declare(strict_types=1);

namespace venndev\restapi\utils;

final class FileManager
{

    /**
     * @param string $directory
     * @param callable $callable
     *
     * This function will read all files in the directory deeply and call the callable function
     *
     * Example:
     *  FileManager::callDirectory('controllers', function($file) {
     *     require_once $file;
     *  });
     */
    public static function callAllPhpFiles(string $directory, callable $callable) : void
    {
        foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($directory)) as $file) {
            if ($file->isDir()) continue;
            if ($file->getExtension() === 'php') $callable($file->getPathName());
        }
    }

}
