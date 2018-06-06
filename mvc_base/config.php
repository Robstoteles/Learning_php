<?php
  require('environment.php');

  $config = array();

  if(ENVIRONMENT == 'development') {
    //Configuração do localhost
    define("BASE_URL","http://localhost/mvc_base/");
    $config['dbname']       = 'estrutura_mvc';
    $config['host']         = 'localhost';
    $config['dbUser']       = 'root';
    $config['dbPassword']   = '';
  }else {
    //Sbstituir pela Configuração do servidor de hospedagem
    define('BASE_URL','http://localhost/mvc_base/');
    $config['dbname']       = 'estrutura_mvc';
    $config['host']         = 'localhost';
    $config['dbUser']       = 'root';
    $config['dbPassword']   = '';
  }
  global $pdo;
  try {
    $pdo = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbUser'], $config['dbPassword']);
  } catch (PDOException $e) {
      echo "Erro ".$e->getMessage();
  }

?>
