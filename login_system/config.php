<?php
    //trabalhando com PDO
    //Conectando ao banco
    $url        = "mysql:dbname=your_db_name;host=your_host";
    $dbUser     = 'your_username';
    $dbPassword = 'your_password';

    try {
      $pdo = new PDO($url, $dbUser, $dbPassword);
    } catch (PDOException $e) {
      echo '<h2>Erro ao conectar</h2>';
    }

?>
