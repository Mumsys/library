<?php

class MumsysTestHelper
{
    private static $_configs;

    private static $_params;


    public static function getConfigs()
    {
        if ( !isset(self::$_configs) ) {
            self::$_configs = require __DIR__ . '/config4tests.php';
        }

        return self::$_configs;
    }

    public static function getTestsBaseDir()
    {
        if (isset(self::$_params['testsBaseDir'])) {
            return self::$_params['testsBaseDir'];

        } else {
            self::$_params['testsBaseDir'] = realpath(dirname(__FILE__) .'/');
            return self::$_params['testsBaseDir'];
        }
    }

}