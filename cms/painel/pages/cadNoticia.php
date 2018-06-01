<?php
    //Pegando o cargo do usuário
    $cargo = $_SESSION['cargo_user'];
    Painel::validatePermissionPage(2);
    //Painel::validatePermissionPage(2);
?>
<section class="contentBox">
  <h2><i class="fas fa-pencil-alt"></i>  Cadastrar Notícia</h2>
  <form class="edUser" method="post" enctype="multipart/form-data">
    <?php
        if(isset($_POST['acao'])) {
          //Se o formulário foi enviado

          $categoriaID  = strip_tags(addslashes($_POST['categoria_id']));
          $title        = strip_tags(addslashes($_POST['titulo']));
          $content      = strip_tags(addslashes($_POST['conteudo']));
          $image        = $_FILES['capa'];

          //Verificando se o usuário é admin
          if($_SESSION['cargo_user'] != 2) {
            //Se não for admin
            Painel::alert('error', 'Você Não Tem Permissão Para Cadastrar Notícia');
          }else if($title == '' || $content == '') {
            Painel::alert('error','Campos Vazios Não São Permitidos');
          }else if($image['tmp_name'] == '' ){
            //Se não for selecionada uma imagem para a capa
  					Painel::alert('error','A imagem de capa precisa ser selecionada.');
  				}else{
            //Se estiver tudo certo cai aqui para cadastrar no banco
            //Verifica se a imagem é válida
  					if(Painel::validateImage($image)){
              //Verificando se já existe uma notícia com o mesmo titulo
  						$verify = MySql::dataBaseConnector()->prepare("SELECT * FROM `your_table.name` WHERE titulo=? AND categoria_id = ?");
  						$verify->execute(array($title,$categoriaID));
  						if($verify->rowCount() == 0){
              //Se não houver uma notícia com o mesmo titulo
              //Faz o upload da capa da notícia
  						$cover = Painel::uploadFiles($image);
              //Cria o slug do titulo da notícia
  						$slug = Painel::generateSlug($title);
              //Criando o array para inserção
  						$arr = ['categoria_id'=>$categoriaID,'titulo'=>$title,'conteudo'=>$content,'capa'=>$cover,'slug'=>$slug,'data'=>date('Y-m-d'),
  						'order_id'=>'0',
  						'table_name'=>'your_table.name'
  						];
  						if(Painel::insertData($arr)){
                //Se foi inserido no banco, redireciona
  							Painel::redirectPage(INCLUDE_PATH_PAINEL.'cadNoticia?sucesso');
  						}else{
  							Painel::alert('error','Já existe uma notícia com esse nome!');
  						}
  					}else{
  						Painel::alert('error','Selecione uma imagem válida!');
  					}
          }
        }
      }
      if(isset($_GET['sucesso']) && !isset($_POST['acao'])){
				Painel::alert('success','O cadastro foi realizado com sucesso!');
			}
    ?>

    <div class="formGroup">
      <label>Selecione Uma Categoria:</label>
      <select name="categoria_id">
        <?php
            //Pegando as categorias do banco
            $categoria = Painel::selectAll('your_table.name');
            foreach ($categoria as $key => $value):
        ?>
        <option <?php if($value['id'] == @$_POST['categoria_id']) echo "selected"; ?> value="<?php echo $value['id'] ?>"><?php echo $value['nome']//Mostrando o nome da categoria dentro do option ?></option>
      <?php endforeach; ?>
      </select>
    </div> <!-- formGroup -->

    <div class="formGroup">
      <label>Titulo:</label>
      <input type="text" name="titulo" value="<?php Painel::recoverPost('titulo'); ?>">
    </div> <!-- formGroup -->

    <div class="formGroup">
      <label>Conteúdo da Notícia:</label>
      <textarea class="tinymce" name="conteudo" rows="8" cols="80"><?php Painel::recoverPost('conteudo'); ?></textarea>
    </div> <!-- formGroup -->

    <div class="formGroup">
      <label>Capa da Notícia:</label>
      <input type="file" name="capa"/>
    </div> <!-- formGroup -->

    <div class="formGroup">
      <input type="hidden" name="order_id" value="0">
      <input type="hidden" name="table_name" value="your_table.name">
      <button class="btn2 "type="submit" name="acao">Cadastrar</button>
    </div> <!-- formGroup -->

  </form> <!-- form -->
</section> <!-- contentBox -->
