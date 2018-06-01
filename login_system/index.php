<?php
  require('config.php');
  session_start();

  if(isset($_SESSION['id']) && empty($_SESSION['id']) == false) {
      $nome = $_SESSION['nome'];
      echo "<h1>Bem Vindo $nome</h1>";
  }else {
    header('Location: login.php');
  }
?>
