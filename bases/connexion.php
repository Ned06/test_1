<?php

/*$connexion = mysqli_connect("localhost", 'root', '', 'intervention_bd');


if (!$connexion) {
  die("Impossible de se connecter à la base de donnée");
}

*/
$pdo = new PDO("mysql:host=localhost;dbname=personnel_bd", 'root', '',array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8",PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));
$pdo->setAttribute(19,5);
$pdo->setAttribute(3,1);


