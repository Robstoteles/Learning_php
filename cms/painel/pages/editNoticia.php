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
  <h2><i class="fas fa-pencil-alt"></i>  Editar Notícia</h2>
  <form class="edUser" method="post" enctype="multipart/form-data">
    <?php
        if(isset($_POST['acao'])) {
          //Se o formulário foi enviado
          //Painel::alert('success',"Cadastro Atualizado Com Sucesso");
          //Editando a imagem
          $name         = strip_tags(addslashes($_POST['name']));
          $categoriaID  = strip_tags(addslashes($_POST['categoria_id']));
          $content      = strip_tags(addslashes($_POST['conteudo']));
          $image        = $_FILES['capa'];
          $currentImage = $_POST['current_image'];
          //Consultando os titulos das notícias
          $verify = MySql::dataBaseConnector()->prepare("SELECT id FROM `your_table.name` WHERE titulo=? AND id != ?");
          $verify->execute(array($name,$id));
          //Verificando se não há notícia com o mesmo titulo
          if($verify->rowCount() == 0) {
            //Se não houver notícia com o mesmo titulo, cai aqui
            //Verificando se alguma imagem foi selecionada
            if($image['name'] != '') {
                //Se existir, verifica se a imagem é válida
                if(Painel::validateImage($image)) {
                  Painel::deleteFile($currentImage);
                  //Se a imagem for válida, faz o upload da imagem e atualiza os dados.
                  $image = Painel::uploadFiles($image);
                  //Cria o slug do titulo da notícia
      						$slug = Painel::generateSlug($name);
                  $arr = ['titulo'=>$name,'categoria_id'=>$categoriaID,'conteudo'=>$content,'capa'=>$image,'slug'=>$slug,'id'=>$id,'data'=>date('Y-m-d'),'table_name'=>'your_table.name'];
                  Painel::updateData($arr);
                  $slide = Painel::selectItem('your_table.name','id = ?',array($id));
                  Painel::alert('success','Notícia Editada Com Sucesso');
                }else {
                    Painel::alert('error',"O Arquivo Não Possui um Formato Válido");
                }
            }else {
              $image = $currentImage;
              //Cria o slug do titulo da notícia
              $slug = Painel::generateSlug($name);
              $arr = ['titulo'=>$name,'categoria_id'=>$categoriaID,'conteudo'=>$content,'capa'=>$image,'slug'=>$slug,'id'=>$id,'data'=>date('Y-m-d'),'table_name'=>'your_table.name'];
              Painel::updateData($arr);
              $slide = Painel::selectItem('your_table.name','id = ?',array($id));
              Painel::alert('success',"Registro Atualizado Com Sucesso");
            }
          }else {
            Painel::alert('error',"Já Existe Uma Notícia Com Este Titulo");
          }

        }
    ?>
    <div class="formGroup">
      <label>Titulo da Notícia:</label>
      <input type="text" name="name" value="<?php echo $slide['titulo'] ?>" required>
    </div> <!-- formGroup -->

    <div class="formGroup">
      <label>Selecione Uma Categoria:</label>
      <select name="categoria_id">
        <?php
            //Pegando as categorias do banco
            $categoria = Painel::selectAll('your_table.name');
            foreach ($categoria as $key => $value):
        ?>
        <option <?php if($value['id'] == $slide['categoria_id']) echo "selected"; ?> value="<?php echo $value['id'] ?>"><?php echo $value['nome']//Mostrando o nome da categoria dentro do option ?></option>
      <?php endforeach; ?>
      </select>
    </div> <!-- formGroup -->

    <div class="formGroup">
      <label>Conteúdo:</label>
      <textarea class="tinymce" name="conteudo" rows="8" cols="80"><?php echo $slide['conteudo'] ?></textarea>
    </div> <!-- formGroup -->

    <div class="formGroup">
      <label>Imagem:</label>
      <input type="file" name="capa"/>
      <input type="hidden" name="current_image" value="<?php echo $slide['capa'] ?>" required>
    </div> <!-- formGroup -->

    <div class="formGroup">
      <button class="btn2" type="submit" name="acao">Atualizar</button>
    </div> <!-- formGroup -->

  </form> <!-- form -->
</section> <!-- contentBox -->
