<?php
$cargo = $_SESSION['cargo_user'];
Painel::validatePermissionPage($cargo);

?>
<section class="contentBox">
  <h2><i class="fas fa-pencil-alt"></i>  Cadastrar Categoria</h2>
  <form class="edUser" method="post" enctype="multipart/form-data">
    <?php
        if(isset($_POST['acao'])) {
          //Se o formulário foi enviado

          $user         = new Usuario();
          $name         = strip_tags(addslashes($_POST['nome']));

          //Verificando se o usuário é admin
          if($_SESSION['cargo_user'] < 2 ) {
            //Se não for admin
            Painel::alert('error', 'Você Não Tem Permissão Para Cadastrar Categoria');
          }else if($name == '') {
            //Verificando se o campo está vazio
            Painel::alert('error', 'O Campo Nome Não Pode Ser Vazio');
          }else{
            //Se todos os campos estiverem preenchidos e o usuário for admin, cai aqui.
            $slug = Painel::generateSlug($name);
            $arr  = ['nome'=>$name,'slug'=>$slug,'order_id'=>'0','table_name'=>'your_table.name'];
            //Verificando se o nome da categoria já existe
            $verify = MySql::dataBaseConnector()->prepare("SELECT * FROM `your_table.name` WHERE nome = ?");
            $verify->execute(array($_POST['nome']));
            if($verify->rowCount()) {
              Painel::alert('error','Já Existe Uma Categoria Com Este Nome');
            }else if(Painel::insertData($arr)) {
                Painel::alert('success','Registro Cadastrado Com Sucesso');
            }else {
              Painel::alert('error','Ocorreu um Erro ao Tentar Salvar o Registro');
            }
          }
      }

      echo $cargo;

    ?>

    <div class="formGroup">
      <label>Nome Da Categoria:</label>
      <input type="text" name="nome">
    </div> <!-- formGroup -->

    <div class="formGroup">
      <button class="btn2" type="submit" name="acao">Cadastrar</button>
    </div> <!-- formGroup -->

  </form> <!-- form -->
</section> <!-- contentBox -->
