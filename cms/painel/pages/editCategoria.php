<?php
    Painel::validatePermissionPage(2);
    //Verificando se há uma ação(editar)
    if(isset($_GET['editar'])) {
      //Se tiver a ação
      $id = (int)$_GET['editar'];
      $selectItens = Painel::selectItem('your_table.name','id = ?',array($id));
    }else {
       Painel::alert('error', 'Ocorreu um Erro ao Tentar Abrir Esta Página');
       die();
    }
?>
<section class="contentBox">
  <h2><i class="fas fa-pencil-alt"></i>  Editar Categoria</h2>
  <form class="edUser" method="post" enctype="multipart/form-data">
    <?php
        if(isset($_POST['acao'])) {
          //Se o formulário foi enviado
          if($_SESSION['cargo_user'] != 2) {
             //Se não for admin
             Painel::alert('error', 'Você Não Tem Permissão Para Editar Categorias');
          }else {
              //Atualizando a categoria
             $slug = Painel::generateSlug($_POST['nome']);
             $arr  = array_merge($_POST,array('slug'=>$slug));
             $verify = MySql::dataBaseConnector()->prepare("SELECT * FROM `your_table.name` WHERE nome = ? AND id != ?");
             $verify->execute(array($_POST['nome'],$id));
             if($verify->rowCount() == 1) {
               Painel::alert('error','Já Existe Uma Categoria Com Este Nome');
             }else if(Painel::updateData($arr)) {
               Painel::alert('success', 'Categoria Editada Com Sucesso');
               $selectItens = Painel::selectItem('your_table.name','id = ?',array($id));
             }else{
               Painel::alert('error', 'Campos Vazios Não São Permitidos');
             }
          }
        }


    ?>

    <div class="formGroup">
      <label>Nome da Categoria:</label>
      <input type="text" name="nome" value="<?php echo $selectItens['nome'];//Mostrando o nome da categoria ?>">
    </div> <!-- formGroup -->

    <div class="formGroup">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="hidden" name="table_name" value="your_table.name">
      <button class="btn2" type="submit" name="acao">Atualizar</button>
    </div> <!-- formGroup -->

  </form> <!-- form -->
</section> <!-- contentBox -->
