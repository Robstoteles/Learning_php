<?php
  class Controller {
    //Carregando a view
    public function loadView($viewName, $viewData=array()) {
        //Extraindo os dados do array e convertendo-os em variáveis para exibir na view
        extract($viewData);
        require('views/'.$viewName.'.php');
    }
    //Carregando o template
    public function loadTemplate($viewName, $viewData=array()) {
        require('views/template.php');
    }
    //Carrendo a view dentro do template
    public function loadViewWithinTemplate($viewName, $viewData=array()) {
        extract($viewData);
        require('views/'.$viewName.'.php');
    }
  }
?>
