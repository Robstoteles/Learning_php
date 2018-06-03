<?php
    Painel::validatePermissionPage(2);
?>
<section class="contentBox">
  <h2><i class="fas fa-pencil-alt"></i>  Adicionar usuário</h2>
  <form class="edUser" method="post" enctype="multipart/form-data">
    <?php
        if(isset($_POST['acao'])) {
          //Se o formulário foi enviado

          $user         = new Usuario();
          $name         = strip_tags(addslashes($_POST['name_user']));
          $loginUser    = strip_tags(addslashes($_POST['login_user']));
          $password     = md5(strip_tags(addslashes($_POST['password_user'])));
          $userPhoto    = $_FILES['user_photo'];
          $cargoUser    = strip_tags(addslashes($_POST['job_position']));

          //Verificando se o usuário é admin
          if($_SESSION['cargo_user'] != 2) {
            //Se não for admin
            Painel::alert('error', 'Você Não Tem Permissão Para Cadastrar Usuário');
          }else if($name == '') {
            //Verificando se o campo está vazio
            Painel::alert('error', 'O Campo Nome Não Pode Ser Vazio');
          }else if($loginUser == '') {
            //Verificando se o campo está vazio
            Painel::alert('error', 'O Campo Login Não Pode Ser Vazio');
          }else if($password == '') {
            //Verificando se o campo está vazio
            Painel::alert('error', 'O Campo Senha Não Pode Ser Vazio');
          }else if($cargoUser == '') {
            //Verificando se o campo está vazio
            Painel::alert('error', 'Selecione um Cargo');
          }else{
            //Se todos os campos estiverem preenchidos e o usuário for admin, cai aqui.
            //E verifica se a imagem é válida
            if($userPhoto['name'] != '' && Painel::validateImage($userPhoto) == false) {
              //Se o arquivo for inválido
              Painel::alert('error',"O Arquivo Não Possui um Formato Válido");
            }else if(Usuario::userExists($loginUser)){
              Painel::alert('error','O Login: '.$loginUser.' Já Existe');
            }else{
              //Se estiver tudo certo, cai aqui para cadastrar no banco
              $userPhoto = Painel::uploadFiles($userPhoto);
              $user->insertUser($loginUser, $password, $userPhoto, $name, $cargoUser);
              Painel::alert('success','Login: '.$loginUser.' Cadastrado Com Sucesso');
            }
          }
      }

    ?>

    <div class="formGroup">
      <label>Nome:</label>
      <input type="text" name="name_user">
    </div> <!-- formGroup -->

    <div class="formGroup">
      <label>Login:</label>
      <input type="text" name="login_user">
    </div> <!-- formGroup -->

    <div class="formGroup">
      <label>Senha:</label>
      <input type="password" name="password_user">
    </div> <!-- formGroup -->

    <div class="formGroup">
      <label>Cargo:</label>
      <select name="job_position">
          <?php
            //Exibindo os cargos na pagina html
            foreach (Painel::$cargos as $key => $value):
              echo '<option value="'.$key.'">'.$value.'</option>';
            endforeach;
          ?>
      </select>
    </div> <!-- formGroup -->

    <div class="formGroup">
      <label>Imagem:</label>
      <input type="file" name="user_photo"/>
    </div> <!-- formGroup -->

    <div class="formGroup">
      <button class="btn2" type="submit" name="acao">Cadastrar</button>
    </div> <!-- formGroup -->

  </form> <!-- form -->
</section> <!-- contentBox -->
