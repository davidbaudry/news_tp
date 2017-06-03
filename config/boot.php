<?php

// lecture des variables d'environnement
include_once '../config/local.php';

spl_autoload_register('autoload');



function autoload($classe)
{
    require 'classes/' . $classe . '.php'; // On inclut la classe correspondante au paramètre passé.
}

