<?php
require_once 'vendor/autoload.php';

global $twig;

//init admin
/** @var \Controller\DancersController $dancers_controller */
$dancers_controller = Services\SingletonFactory::getInstance('\Controller\DancersController');
$dancers_controller->init();
/** @var \Controller\Battle $dancers_controller */
$dancers_controller = Services\SingletonFactory::getInstance('\Controller\Battle');
$dancers_controller->init();

// init theme


// theme constants

// Load global Twig instance
if(!$twig){
    $loader = new Twig_Loader_Filesystem(__DIR__.'/ressources/views');
    $twig = new Twig_Environment($loader, array(
        'cache' => false
    ));
}