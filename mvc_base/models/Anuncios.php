<?php
  class Anuncios extends Model{
    public function getQuantidade() {
      //Pegando a quantidade de anúncios do banco
      $sql = "SELECT COUNT(*) as c FROM anuncios";
      $sql = $this->pdo->query($sql);
      //Verificando se houver retorno
      if($sql->rowCount() > 0) {
        $sql = $sql->fetch();
        return $sql['c'];
      }else {
        return 0;
      }
    }
  }
?>
