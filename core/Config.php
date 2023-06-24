<?php 

namespace Scandiweb;

class Config
{

    private static array $config = [];


    public function __construct()
    {
        $configs = scandir(CONFIG_PATH);

        foreach ($configs as $config) {

            if (is_dir($config)) {
                continue;
            }

            static::$config[str_replace('.php', '', $config)] = require CONFIG_PATH . $config;
        }
    }


    public static function get(string $key, $default = null)
    {
        if (!static::$config) {
            new static;
        }

        $config = static::$config;
        foreach (explode('.', $key) as $bit) {
            if (!isset($config[$bit])) {
                return $default;
            }

            $config = $config[$bit];
        }
        return $config;
    }
}