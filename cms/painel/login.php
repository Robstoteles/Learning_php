<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/style.css">
    <title>Painel de Controle</title>
  </head>
  <body>
    <div class="boxLogin">
        <?php
          /*
            Logando no sistema
            O código abaixo faz uma verificação se houve uma ação
            Caso haja a ação, logo o botão "LOGAR" foi clicado.
            Após o botão ser clicado, é capturado o que foi digitado nos inputs
            Um select é feito para verificar usuário e senha.
            Caso os dois estejam corretos, o login prossegue.

            Verifying if there was an action(in this case, it's written "acao")
            If "LOGAR" BUTTON was clicked, then get the data from the input
            and store it in the variable.
            Running a query in order to verify login and password
            If both are correct, then the user can login
          */
          if(isset($_POST['acao'])) {
            $userLogin = strip_tags(addslashes($_POST['userLogin']));
            $userPassword = md5(strip_tags(addslashes($_POST['userPassword'])));
            echo $userPassword;
            //Fazendo um select no banco
            $sql = MySql::dataBaseConnector()->prepare("SELECT * FROM `your_table.name` WHERE login=? AND password=?");
            //Executando a query
            $sql->execute(array($userLogin,$userPassword));
            //Verificando se o login e a senha foram encontrados
            if($sql->rowCount() == 1) {
              //Pegando os dados no banco
              $info = $sql->fetch();
              //Se encontrou usuario e senha, logamos e armazenamos os dados do usuário na sessão
              $_SESSION['login']        = true;
              $_SESSION['userLogin']    = $userLogin;
              $_SESSION['userPassword'] = $userPassword;
              $_SESSION['name']    = $info['name'];
              $_SESSION['job_position']   = $info['job_position'];
              $_SESSION['user_img']     = $info['user_img'];


              //Redirecionando para a pagina principal do painel
              header('Location:'.INCLUDE_PATH_PAINEL);
              die();
            }else {
              //Usuário e senha não foram encontrados
              echo '<div class="erro">Login ou Senha Inválido</div>';
            }
          }
        ?>
        <h2>Fazer Login</h2>
        <form action="index.html" method="post">
            <input type="text" name="userLogin" placeholder="Login:" required>
            <input type="password" name="userPassword" placeholder="Senha:" required>
            <button type="submit" name="acao">Logar</button>
        </form>
    </div> <!-- boxLogin -->
  </body>
</html>
