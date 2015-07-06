<?php
/**
 * Created by PhpStorm.
 * User: Jérémie
 * Date: 22/04/2015
 * Time: 23:32
 */
namespace Services;

class SingletonFactory
{

    private static $instances = array();

    private function __construct()
    {
    }

    /**
     * Méthode qui crée l'unique instance de la classe (fully qualified class name)
     * si elle n'existe pas encore puis la retourne.
     *
     * @param string $fqcn
     * @return Object
     */
    static function getInstance($fqcn)
    {
        if (!isset(self::$instances[$fqcn])) {
            self::$instances[$fqcn] = new $fqcn();
        }

        $v = self::$instances[$fqcn];
        return $v;
    }

    static function dumpInstance()
    {
        var_dump(self::$instances);
    }

}