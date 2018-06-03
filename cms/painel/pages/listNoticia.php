<?php
  //Excluindo uma Imagem junto com a notícia
  if(isset($_GET['excluir'])) {
    $idExcluir = intval($_GET['excluir']);
    $selectImage = MySql::dataBaseConnector()->prepare("SELECT capa FROM `your_table.name` WHERE id=?");
    $selectImage->execute(array($idExcluir));
    $image = $selectImage->fetch()['capa'];
    Painel::deleteFile($image);
    Painel::deleteItem('your_table.name', $idExcluir);
    Painel::redirectPage(INCLUDE_PATH_PAINEL.'listNoticia');
  }//Fim deletar Imagem junto com a notícia
  else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::orderItem('your_table.name',$_GET['order'],$_GET['id']);
	}

  /*Criando a paginação*/
  $paginaAtual = isset($_GET['page']) ? (int)$_GET['page']: 1;
  $quantidadePaginas = 2;
  $itemsList = Painel::selectAll('your_table.name',($paginaAtual -1) * $quantidadePaginas, $quantidadePaginas);
  /*Fim Paginação*/
?>
<section class="contentBox">
  <h2><i class="fas fa-pencil-alt"></i>  Notícias Cadastradas</h2>
  <div class="wrapperTable">
    <table>
        <tr>
          <td class="">Titulo da Notícia</td>
          <td>Categoria </td>
          <td class="">Capa</td>
          <td> </td>
          <td> </td>
          <td> </td>
          <td> </td>
        </tr>

        <?php
            foreach ($itemsList as $key => $value):
              // Mostrando as noticias na tabela HTML
              //Pegando os nomes dentro da tabela tb_site.categorias
              $nomeCategoria = Painel::selectItem('your_table.name','id=?',array($value['categoria_id']))['nome'];
        ?>
        <tr>
          <td class=""><?php echo $value['titulo'];//Mostrando o titulo da noticia ?></td>
          <td><?php echo $nomeCategoria;//Mostrando o nome da categoria que a notícia pertence ?></td>
          <td class=""><img class="slide" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['capa']; //Mostrando a imagem da notícia no html?>"></td>
          <td> <a class="edit btn" href="<?php echo INCLUDE_PATH_PAINEL; ?>editNoticia?editar=<?php echo $value['id'];//Editando uma notícia ?>"><i class="fas fa-pencil-alt"></i> Editar</a> </td>
          <td> <a actionBtn="delete" class="delete btn" href="<?php echo INCLUDE_PATH_PAINEL; ?>listNoticia?excluir=<?php echo $value['id'];//Deletando uma notícia ?>"><i class="fas fa-times"></i> Excluir</a> </td>
          <td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listNoticia?order=up&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-up"></i></a></td>
    			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listNoticia?order=down&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-down"></i></a></td>
        </tr>
        <?php
            endforeach;
        ?>
    </table>
  </div><!-- wrapperTable -->

  <div class="pagination">
    <?php
        //Mostrando a paginação
        $totalPaginas = ceil(count(Painel::selectAll('your_table.name')) / $quantidadePaginas);
        for($i = 1;$i <= $totalPaginas; $i++) {
            //Verificando se é a pagina que está sendo mostrada
            if($i == $paginaAtual) {
              //Destaca o número da pagina que está sendo exibida(pagina 1, pagina 2, etc...)
              echo '<a class="pageSelected" href="'.INCLUDE_PATH_PAINEL.'listNoticia?page='.$i.'">'.$i.'</a>';
            }else {
              //Mostra as outras paginas disponiveis
              echo '<a href="'.INCLUDE_PATH_PAINEL.'listNoticia?page='.$i.'">'.$i.'</a>';
            }

        }
    ?>
  </div> <!-- pagination -->

</section><!-- contentBox -->
