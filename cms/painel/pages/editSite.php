<?php
    Painel::validatePermissionPage(2);
    $id = 1;
    $selectItens = Painel::selectItem('your_table.name','id = ?',array($id));
?>
<section class="contentBox">
  <h2><i class="fas fa-pencil-alt"></i>  Editar Configurações do Site</h2>
  <form class="edUser" method="post" enctype="multipart/form-data">
    <?php
        if(isset($_POST['acao'])) {
          //Se o formulário foi enviado
          if($_SESSION['cargo_user'] != 2) {
             //Se não for admin
             Painel::alert('error', 'Você Não Tem Permissão Para Fazer Alterações no Site');
          }else {
             if(Painel::updateData($_POST)) {
               Painel::alert('success', 'Site Editado Com Sucesso');
               $selectItens = Painel::selectItem('your_table.name','id = ?',array($id));
             }else{
               Painel::alert('error', 'Campos Vazios Não São Permitidos');
             }
          }
        }


    ?>

    <div class="formGroup">
      <label>Nome do Site:</label>
      <input type="text" name="titulo_site" value="<?php echo $selectItens['titulo_site'];//Mostrando o Titulo do site ?>">
    </div> <!-- formGroup -->

    <div class="formGroup">
      <label>Nome do Autor do Site:</label>
      <input type="text" name="nome_autor" value="<?php echo $selectItens['nome_autor'];//Mostrando o Titulo do site ?>">
    </div> <!-- formGroup -->

    <div class="formGroup">
      <label>Descrição Sobre o Autor do Site:</label>
      <textarea name="descricao" rows="8" cols="80"><?php echo $selectItens['descricao'];//Mostrando a descrição do autor do site ?></textarea>
    </div> <!-- formGroup -->

  <?php
      for($i=1;$i<=3;$i++):
      //Mostrando os inputs
  ?>
    <div class="formGroup">
      <label>Icone <?php echo $i; ?>:</label>
      <input type="text" name="icone<?php echo $i; ?>" value="<?php echo $selectItens['icone'.$i];//Mostrando o  icone ?>">
    </div> <!-- formGroup -->

    <div class="formGroup">
      <label>Titulo do Icone <?php echo $i; ?>:</label>
      <input type="text" name="titulo_icone<?php echo $i; ?>" value="<?php echo $selectItens['titulo_icone'.$i];//Mostrando o Titulo do icone ?>">
    </div> <!-- formGroup -->

    <div class="formGroup">
      <label>Descrição do Icone <?php echo $i; ?> :</label>
      <textarea name="descricao_icone<?php echo $i; ?>" rows="8" cols="80"><?php echo $selectItens['descricao_icone'.$i];//Mostrando a descrição abaixo do icone ?></textarea>
    </div> <!-- formGroup -->
  <?php endfor;//Fechando o for do formGroup com os inputs ?>
    <div class="formGroup">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="hidden" name="table_name" value="your_table.name">
      <button class="btn2" type="submit" name="acao">Atualizar</button>
    </div> <!-- formGroup -->

  </form> <!-- form -->
</section> <!-- contentBox -->
