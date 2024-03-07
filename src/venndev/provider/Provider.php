<?php

declare(strict_types=1);

namespace venndev\restapi\provider;

use Symfony\Component\Yaml\Yaml;
use venndev\restapi\provider\mysql\MySQL;

final class Provider
{

    private static MySQL $mysql;

    private static string $configPath = '';

    public function setMySQL(MySQL $mysql) : void
    {
        self::$mysql = $mysql;
    }

    public function setConfigPath(string $configPath) : void
    {
        self::$configPath = $configPath;
    }

    public static function getMySQL() : MySQL
    {
        return self::$mysql;
    }

    public static function getConfig() : array
    {
        return Yaml::parseFile(self::$configPath);
    }

}