<?php
//Selecionando uma Imagem
if(isset($_GET['editar'])){
  $id = (int)$_GET['editar'];
  $slide = Painel::selectItem('your_table.name','id = ?',array($id));
}//Fim Selecionar Imagem
else{
  Painel::alert('error','Você precisa passar o parametro ID.');
  die();
}

?>
<section class="contentBox">
  <h2><i class="fas fa-pencil-alt"></i>  Editar Slide</h2>
  <form class="edUser" method="post" enctype="multipart/form-data">
    <?php
        if(isset($_POST['acao'])) {
          //Se o formulário foi enviado
          //Painel::alert('success',"Cadastro Atualizado Com Sucesso");
          //Editando a imagem
          $name         = strip_tags(addslashes($_POST['name']));
          $userPhoto    = $_FILES['user_photo'];
          $currentImage = $_POST['current_image'];

          //Verificando se alguma imagem foi selecionada
          if($userPhoto['name'] != '') {
              //Se existir, verifica se a imagem é válida
              if(Painel::validateImage($userPhoto)) {
                Painel::deleteFile($currentImage);
                //Se a imagem for válida, faz o upload da imagem e atualiza os dados.
                $userPhoto = Painel::uploadFiles($userPhoto);
                $arr = ['nome_slide'=>$name,'img_slide'=>$userPhoto, 'id'=>$id,'table_name'=>'your_table.name'];
                Painel::updateData($arr);
                $slide = Painel::selectItem('your_table.name','id = ?',array($id));
                Painel::alert('success','Slide Atualizado Com Sucesso');
              }else {
                  Painel::alert('error',"O Arquivo Não Possui um Formato Válido");
              }
          }else {
            $userPhoto = $currentImage;
            $arr = ['nome_slide'=>$name,'img_slide'=>$userPhoto, 'id'=>$id,'table_name'=>'your_table.name'];
            Painel::updateData($arr);
            $slide = Painel::selectItem('your_table.name','id = ?',array($id));
            Painel::alert('success',"Registro Atualizado Com Sucesso");
          }
        }
    ?>
    <div class="formGroup">
      <label>Nome da Imagem:</label>
      <input type="text" name="name" value="<?php echo $slide['nome_slide'] ?>" required>
    </div> <!-- formGroup -->

    <div class="formGroup">
      <label>Imagem:</label>
      <input type="file" name="user_photo"/>
      <input type="hidden" name="current_image" value="<?php echo $slide['img_slide'] ?>" required>
    </div> <!-- formGroup -->

    <div class="formGroup">
      <button class="btn2" type="submit" name="acao">Atualizar</button>
    </div> <!-- formGroup -->

  </form> <!-- form -->
</section> <!-- contentBox -->
