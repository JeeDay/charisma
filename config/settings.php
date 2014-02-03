<?php

define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASSWORD","mysql");
define("DB_DATABASE","charisma");

function connexion()
{
  $idcom = new PDO('mysql:host=localhost;dbname='.DB_DATABASE,DB_USER,DB_PASSWORD,
    array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    )
  );
 
  if (!$idcom)
  {
    echo "<script type=text/javascript>";
    echo "alert('Connexion Impossible à la base')</script>";
    exit();
  }
  return $idcom;
}
