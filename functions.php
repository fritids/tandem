<?php
require_once 'vendor/autoload.php';
global $twig;

// init theme


// theme constants


if(!$twig){
    $loader = new Twig_Loader_Filesystem(__DIR__.'/ressources/views'); // Dossier contenant les templates
    $twig = new Twig_Environment($loader, array(
        'cache' => false
    ));
}