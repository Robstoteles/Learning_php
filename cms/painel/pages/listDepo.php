<?php
  //Excluindo um depoimento
  if(isset($_GET['excluir'])) {
    $idExcluir = intval($_GET['excluir']);
    Painel::deleteItem('your_table.name', $idExcluir);
    Painel::redirectPage(INCLUDE_PATH_PAINEL.'listDepo');
  }//Fim deletar depoimento
  else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::orderItem('your_table.name',$_GET['order'],$_GET['id']);
	}

  /*Criando a paginação*/
  $paginaAtual = isset($_GET['page']) ? (int)$_GET['page']: 1;
  $quantidadePaginas = 2;
  $depoimentos = Painel::selectAll('your_table.name',($paginaAtual -1) * $quantidadePaginas, $quantidadePaginas);
  /*Fim Paginação*/
?>
<section class="contentBox">
  <h2><i class="fas fa-pencil-alt"></i>  Depoimentos Cadastrados</h2>
  <div class="wrapperTable">
    <table>
        <tr>
          <td class="w25">Nome</td>
          <td class="w55">Depoimento</td>
          <td> </td>
          <td> </td>
          <td> </td>
          <td> </td>
        </tr>

        <?php
            foreach ($depoimentos as $key => $value):
              // Mostrando os depoimentos na tabela HTML
        ?>
        <tr>
          <td class="w25"><?php echo $value['nome_depo']; ?></td>
          <td class="w55"><?php echo $value['depoimentos']; ?></td>
          <td> <a class="edit btn" href="<?php echo INCLUDE_PATH_PAINEL; ?>editDepo?editar=<?php echo $value['id'];//Editando um depoimento ?>"><i class="fas fa-pencil-alt"></i> Editar</a> </td>
          <td> <a actionBtn="delete" class="delete btn" href="<?php echo INCLUDE_PATH_PAINEL; ?>listDepo?excluir=<?php echo $value['id'];//Deletando um depoimento ?>"><i class="fas fa-times"></i> Excluir</a> </td>
          <td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listDepo?order=up&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-up"></i></a></td>
    			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listDepo?order=down&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-down"></i></a></td>
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
              echo '<a class="pageSelected" href="'.INCLUDE_PATH_PAINEL.'listDepo?page='.$i.'">'.$i.'</a>';
            }else {
              //Mostra as outras paginas disponiveis
              echo '<a href="'.INCLUDE_PATH_PAINEL.'listDepo?page='.$i.'">'.$i.'</a>';
            }

        }
    ?>
  </div> <!-- pagination -->

</section><!-- contentBox -->
