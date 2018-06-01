<<?php
    Painel::validatePermissionPage(2);
?>
<section class="contentBox">
  <h2><i class="fas fa-pencil-alt"></i>  Cadastrar Serviço</h2>
  <form class="edUser" method="post" enctype="multipart/form-data">
    <?php
        if(isset($_POST['acao'])) {
          //Se o formulário foi enviado
          //Verificando se o usuário é admin
          if($_SESSION['cargo_user'] != 2) {
             //Se não for admin
             Painel::alert('error', 'Você Não Tem Permissão Para Cadastrar Serviços');
          }else {
             if(Painel::insertData($_POST)) {
               Painel::alert('success', 'Serviço Cadastrado Com Sucesso');
             }else{
               Painel::alert('error', 'Ocorreu um Erro ao Cadastrar o Serviço');
             }
          }

        }


    ?>

    <div class="formGroup">
      <label>Nome do Serviço:</label>
      <input type="text" name="nome_depo">
    </div> <!-- formGroup -->

    <div class="formGroup">
      <label>Descrição do Serviço:</label>
      <textarea name="servicos" rows="8" cols="80"></textarea>
    </div> <!-- formGroup -->

    <div class="formGroup">
      <input type="hidden" name="order_id" value="0">
      <input type="hidden" name="table_name" value="your_table.name">
      <button class="btn2" type="submit" name="acao">Cadastrar</button>
    </div> <!-- formGroup -->

  </form> <!-- form -->
</section> <!-- contentBox -->
