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
  <h2><i class="fas fa-pencil-alt"></i>  Editar Serviço</h2>
  <form class="edUser" method="post" enctype="multipart/form-data">
    <?php
        if(isset($_POST['acao'])) {
          //Se o formulário foi enviado
          if($_SESSION['cargo_user'] != 2) {
             //Se não for admin
             Painel::alert('error', 'Você Não Tem Permissão Para Alerar Serviços');
          }else {
             if(Painel::updateData($_POST)) {
               Painel::alert('success', 'Serviço Editado Com Sucesso');
               $selectItens = Painel::selectItem('your_table.name','id = ?',array($id));
             }else{
               Painel::alert('error', 'Campos Vazios Não São Permitidos');
             }
          }
        }


    ?>

    <div class="formGroup">
      <label>Titulo do Serviço:</label>
      <input type="text" name="titulo_serv" value="<?php echo $selectItens['titulo_serv'];//Mostrando o Titulo do serviço ?>">
    </div> <!-- formGroup -->

    <div class="formGroup">
      <label>Descrição do Serviço:</label>
      <textarea name="txt_serv" rows="8" cols="80"><?php echo $selectItens['txt_serv'];//Mostrando a descrição do serviço ?></textarea>
    </div> <!-- formGroup -->

    <div class="formGroup">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="hidden" name="table_name" value="your_table.name">
      <button class="btn2" type="submit" name="acao">Atualizar</button>
    </div> <!-- formGroup -->

  </form> <!-- form -->
</section> <!-- contentBox -->
