<?php

function conectamy($host,$user,$senha,$dbname){

  GLOBAL $dbm;
  $dbm = mysqli_connect("$host", "$user", "$senha", "$dbname") or die ("Problemas para Conectar no Banco de Dados MariaDB.<br>");
  
  mysqli_query($dbm,"SET NAMES 'utf8'");
  mysqli_query($dbm,'SET character_set_connection=utf8');
  mysqli_query($dbm,'SET character_set_client=utf8');
  mysqli_query($dbm,'SET character_set_results=utf8');
}

conectamy("localhost","root","","estacionamento");
?>