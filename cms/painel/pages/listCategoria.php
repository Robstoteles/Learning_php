<?php
  //Excluindo uma Categoria
  if(isset($_GET['excluir'])) {
    $id = intval($_GET['excluir']);
    Painel::deleteItem('your_table.name', $id);
    //Deletando as notícias junto com a categoria deletada
    //Selecionando as noticias
		$noticias = MySql::dataBaseConnector()->prepare("SELECT * FROM `your_table.name` WHERE categoria_id = ?");
		$noticias->execute(array($id));
		$noticias = $noticias->fetchAll();
    //Deletando as imagens das noticias
		foreach ($noticias as $key => $value) {
			$imgDelete = $value['capa'];
			Painel::deleteFile($imgDelete);
		}
    //Deletando as notícias
		$noticias = MySql::dataBaseConnector()->prepare("DELETE FROM `your_table.name` WHERE categoria_id = ?");
		$noticias->execute(array($id));
    //Fim deletar noticias junto com a categoria

    //Redireciona para a mesma pagina
    Painel::redirectPage(INCLUDE_PATH_PAINEL.'listCategoria');
  }//Fim deletar Categoria
  else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::orderItem('your_table.name',$_GET['order'],$_GET['id']);
	}

  /*Criando a paginação*/
  $paginaAtual = isset($_GET['page']) ? (int)$_GET['page']: 1;
  $quantidadePaginas = 5;
  $itemsList = Painel::selectAll('your_table.name',($paginaAtual -1) * $quantidadePaginas, $quantidadePaginas);
  /*Fim Paginação*/
?>
<section class="contentBox">
  <h2><i class="fas fa-pencil-alt"></i>  Categorias Cadastradas</h2>
  <div class="wrapperTable">
    <table>
        <tr>
          <td class="w25">Nome Da Categoria</td>
          <td class="w55">Slug</td>
          <td> </td>
          <td> </td>
          <td> </td>
          <td> </td>
        </tr>

        <?php
            foreach ($itemsList as $key => $value):
              // Mostrando os depoimentos na tabela HTML
        ?>
        <tr>
          <td class="w25"><?php echo $value['nome']; ?></td>
          <td class="w55"><?php echo $value['slug']; //Mostrando o slug?></td>
          <td> <a class="edit btn" href="<?php echo INCLUDE_PATH_PAINEL; ?>editCategoria?editar=<?php echo $value['id'];//Editando uma categoria ?>"><i class="fas fa-pencil-alt"></i> Editar</a> </td>
          <td> <a actionBtn="delete" class="delete btn" href="<?php echo INCLUDE_PATH_PAINEL; ?>listCategoria?excluir=<?php echo $value['id'];//Deletando uma Categoria ?>"><i class="fas fa-times"></i> Excluir</a> </td>
          <td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listCategoria?order=up&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-up"></i></a></td>
    			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listCategoria?order=down&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-down"></i></a></td>
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
              echo '<a class="pageSelected" href="'.INCLUDE_PATH_PAINEL.'listCategoria?page='.$i.'">'.$i.'</a>';
            }else {
              //Mostra as outras paginas disponiveis
              echo '<a href="'.INCLUDE_PATH_PAINEL.'listCategoria?page='.$i.'">'.$i.'</a>';
            }

        }
    ?>
  </div> <!-- pagination -->

</section><!-- contentBox -->
