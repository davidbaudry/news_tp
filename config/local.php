<?php
/*
 * Ce fichier contient les variables d'environnement
 * et les accès à la BDD
 * --
 * A ne pas commiter
 */

setlocale(LC_TIME, 'fr_FR.utf8', 'fra');

/* ligne LOCALE */
define ('SITEROOT', $_SERVER['DOCUMENT_ROOT'].'/TP_news/');
define('LINK_BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/TP_news/');
define ('CSS_PATH', LINK_BASE_URL . 'static/');
/* fin ligne LOCALE */

// bd access
define ('DB_HOST', 'localhost');
define ('DB_USER', 'root');
define ('DB_PASS', '');
define ('DB_NAME', 'tp_news');