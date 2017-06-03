<?php

// lecture des variables d'environnement
include_once '../config/local.php';
include_once '../traits/tools.php';

spl_autoload_register('autoload');

$db_factory = new DBFactory;
$db = $db_factory->getPDOConnection();
$news_manager = new NewsManagerPDO($db);

function autoload($classe)
{
    require '../classes/' . $classe . '.php'; // On inclut la classe correspondante au paramètre passé.
}

