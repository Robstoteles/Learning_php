<?php
session_start();
//Setando a hora para São Paulo/Brasil
date_default_timezone_set('America/Sao_Paulo');
//Criando um autoload
$autoload = function($class){
  if($class == 'Email'){
    require_once('classes/phpmailer/PHPMailerAutoLoad.php');
  }
  include('classes/'.$class.'.php');
};

spl_autoload_register($autoload);
  //Definindo url's base
  define('INCLUDE_PATH','http://localhost/aulas/projeto01/');
  define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');
  define('BASE_DIR_PAINEL',__DIR__.'/painel');
  //Definindo as constantes para conexão com o banco
  define('HOST', 'localhost');
  define('USER', 'root');
  define('PASSWORD', '');
  define('DATABASE', 'projeto_danki_01');
  define('NOME_EMPRESA', 'Sem Criatividade');
?>
