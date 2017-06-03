<html>
<?php
/* l'index ne fait qu'une chose : router sur la page content/home qui est la vraie entrée du site */
header('Location: http://'.$_SERVER['HTTP_HOST'].'/TP_news/content/home.php/');
exit;
?>