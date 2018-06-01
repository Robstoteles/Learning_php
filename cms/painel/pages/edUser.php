<section class="contentBox">
  <h2><i class="fas fa-pencil-alt"></i>  Editar usuário</h2>
  <form class="edUser" method="post" enctype="multipart/form-data">
    <?php
        if(isset($_POST['acao'])) {
          //Se o formulário foi enviado
          //Painel::alert('success',"Cadastro Atualizado Com Sucesso");
          $user         = new Usuario();
          $name         = strip_tags($_POST['name_user']);
          $password     = strip_tags($_POST['password_user']);
          $userPhoto    = $_FILES['user_photo'];
          $currentImage = $_POST['current_image'];

          //Verificando se alguma imagem foi selecionada
          if($userPhoto['name'] != '') {
              //Se existir, verifica se a imagem é válida
              if(Painel::validateImage($userPhoto)) {
                Painel::deleteFile($currentImage);
                //Se a imagem for válida, faz o upload da imagem e atualiza os dados do usuário.
                $userPhoto = Painel::uploadFiles($userPhoto);
                if($user->updateUser($name, $password, $userPhoto)) {
                    $_SESSION['user_img'] = $userPhoto;
                    $_SESSION['nome_user'] = $name;
                    Painel::alert('success',"Registro Atualizado Com Sucesso");
                }else {
                    Painel::alert('error',"Ocorreu um Erro ao Tentar Atualizar o Registro");
                }
              }else {
                  Painel::alert('error',"O Arquivo Não Possui um Formato Válido");
              }
          }else {
            $userPhoto = $currentImage;
            if($user->updateUser($name, $password, $userPhoto)) {
                Painel::alert('success',"Registro Atualizado Com Sucesso");
            }else {
                Painel::alert('error',"Ocorreu um Erro ao Tentar Atualizar o Registro");
            }
          }
        }
    ?>
    <div class="formGroup">
      <label>Nome:</label>
      <input type="text" name="name_user" value="<?php echo $_SESSION['nome_user'] ?>" required>
    </div> <!-- formGroup -->

    <div class="formGroup">
      <label>Senha:</label>
      <input type="password" name="password_user" value="<?php echo @$_SESSION['password_user'] ?>" required>
    </div> <!-- formGroup -->

    <div class="formGroup">
      <label>Imagem:</label>
      <input type="file" name="user_photo"/>
      <input type="hidden" name="current_image" value="<?php echo $_SESSION['user_img'] ?>">
    </div> <!-- formGroup -->

    <div class="formGroup">
      <button class="btn2" type="submit" name="acao">Atualizar</button>
    </div> <!-- formGroup -->

  </form> <!-- form -->
</section> <!-- contentBox -->
