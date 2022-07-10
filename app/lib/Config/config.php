<?php

namespace app\lib\Config;

abstract class Config
{
    private static $prefix        = 'AniPlus - ';
    private static $sufix         = 'Controller';
    private static $controller    = 'app\\Controller\\';
    private static $model         = 'app\\Model\\';
    private static $defaultAction = 'index';

    public static function getPrefix()
    {
        return self::$prefix;
    }

    public static function getSufix()
    {
        return self::$sufix;
    }

    public static function getController()
    {
        return self::$controller;
    }

    public static function getModel()
    {
        return self::$model;
    }

    public static function getDefaultAction()
    {
        return self::$defaultAction;
    }
}
