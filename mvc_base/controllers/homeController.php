<?php
  class homeController extends Controller {
    public function index() {
      $anuncios = new Anuncios();
      //Armazenando os dados num array para exibir na view(simulação)
      $data = array(
        'quantidade' => $anuncios->getQuantidade()
      );
      //Chamando o conteúdo html do home
      $this->loadTemplate('home', $data);
    }
  }
?>
