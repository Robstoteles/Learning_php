<?php
    require('config.php');
    session_start();

    if(isset($_POST['action']) && empty($_POST['email']) == false && empty($_POST['password']) == false) {
      $email    = strip_tags(addslashes($_POST['email']));
      $password = md5(strip_tags(addslashes($_POST['password'])));
      $sql = "SELECT * FROM your_table_name WHERE email = '$email' AND senha = '$password'";
      $sql = $pdo->query($sql);
      if($sql->rowCount() > 0) {
        $data = $sql->fetch();
        $_SESSION['id'] = $data['id'];
        $_SESSION['nome'] = $data['nome'];

        header('Location: index.php');
      }else {
        echo "<h1>Login ou Senha Inválido</h1>";
      }
    }else {
      echo "<h2>Campos Vazios Não São Permitidos</h2>";
    }

?>
<form class="" method="post">
  Email<br>
  <input type="email" name="email" value=""><br>
  Password<br>
  <input type="password" name="password" value=""><br><br>

  <button type="submit" name="action">Login</button>
</form>
