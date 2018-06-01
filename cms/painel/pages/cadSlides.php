<?php
    Painel::validatePermissionPage(2);
?>
<section class="contentBox">
  <h2><i class="fas fa-pencil-alt"></i>  Adicionar Imagem</h2>
  <form class="edUser" method="post" enctype="multipart/form-data">
    <?php
        if(isset($_POST['acao'])) {
          //Se o formulário foi enviado

          $user         = new Usuario();
          $name         = strip_tags(addslashes($_POST['name']));
          $userPhoto    = $_FILES['photo'];

          //Verificando se o usuário é admin
          if($_SESSION['cargo_user'] != 2) {
            //Se não for admin
            Painel::alert('error', 'Você Não Tem Permissão Para Cadastrar Usuário');
          }else if($name == '') {
            //Verificando se o campo está vazio
            Painel::alert('error', 'O Campo Nome Não Pode Ser Vazio');
          }else{
            //Se todos os campos estiverem preenchidos e o usuário for admin, cai aqui.
            //E verifica se a imagem é válida
            if($userPhoto['name'] != '' && Painel::validateImage($userPhoto) == false) {
              //Se o arquivo for inválido
              Painel::alert('error',"O Arquivo Não Possui um Formato Válido");
            }else{
              //Se estiver tudo certo, cai aqui para cadastrar no banco
              $userPhoto = Painel::uploadFiles($userPhoto);
              $arr = ['slide'=>$name,'img'=>$userPhoto, 'order_id'=>'0','table_name'=>'your_table.name'];
              Painel::insertData($arr);
              Painel::alert('success','Imagem Cadastrada Com Sucesso');
            }
          }
      }

    ?>

    <div class="formGroup">
      <label>Nome Da Imagem:</label>
      <input type="text" name="name">
    </div> <!-- formGroup -->

    <div class="formGroup">
      <label>Imagem:</label>
      <input type="file" name="photo"/>
    </div> <!-- formGroup -->

    <div class="formGroup">
      <button class="btn2" type="submit" name="acao">Cadastrar</button>
    </div> <!-- formGroup -->

  </form> <!-- form -->
</section> <!-- contentBox -->
