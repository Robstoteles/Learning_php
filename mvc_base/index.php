<?php
  session_start();
  require('config.php');

  //Criando um autoload
  spl_autoload_register(function($class){
      //Verificando se o arquivo existe
      if(file_exists('controllers/'.$class.'.php')) {
          require('controllers/'.$class.'.php');
      }
      else if(file_exists('models/'.$class.'.php')) {
          require('models/'.$class.'.php');
      }
      else if(file_exists('core/'.$class.'.php')) {
          require('core/'.$class.'.php');
      }
  });
  $core = new Core();
  $core->run();
?>
