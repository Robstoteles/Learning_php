<?php
  //Excluindo uma Imagem
  if(isset($_GET['excluir'])) {
    $idExcluir = intval($_GET['excluir']);
    $selectImage = MySql::dataBaseConnector()->prepare("SELECT img_slide FROM `your_table.name` WHERE id=?");
    $selectImage->execute(array($idExcluir));
    $image = $selectImage->fetch()['img_slide'];
    Painel::deleteFile($image);
    Painel::deleteItem('your_table.name', $idExcluir);
    Painel::redirectPage(INCLUDE_PATH_PAINEL.'listSlides');
  }//Fim deletar Imagem
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
  <h2><i class="fas fa-pencil-alt"></i>  Imagens Cadastradas</h2>
  <div class="wrapperTable">
    <table>
        <tr>
          <td class="w25">Nome Da Imagem</td>
          <td class="w55">Imagens</td>
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
          <td class="w25"><?php echo $value['nome_slide']; ?></td>
          <td class="w55"><img class="slide" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['img_slide']; //Mostrando a imagem no html?>"></td>
          <td> <a class="edit btn" href="<?php echo INCLUDE_PATH_PAINEL; ?>editSlides?editar=<?php echo $value['id'];//Editando um depoimento ?>"><i class="fas fa-pencil-alt"></i> Editar</a> </td>
          <td> <a actionBtn="delete" class="delete btn" href="<?php echo INCLUDE_PATH_PAINEL; ?>listSlides?excluir=<?php echo $value['id'];//Deletando um depoimento ?>"><i class="fas fa-times"></i> Excluir</a> </td>
          <td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listSlides?order=up&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-up"></i></a></td>
    			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listSlides?order=down&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-down"></i></a></td>
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
              echo '<a class="pageSelected" href="'.INCLUDE_PATH_PAINEL.'listSlides?page='.$i.'">'.$i.'</a>';
            }else {
              //Mostra as outras paginas disponiveis
              echo '<a href="'.INCLUDE_PATH_PAINEL.'listSlides?page='.$i.'">'.$i.'</a>';
            }

        }
    ?>
  </div> <!-- pagination -->

</section><!-- contentBox -->
