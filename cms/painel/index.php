<?php
    require_once('../config.php');
    //Verificando se o usuário está logado
    if(Painel::logado() == false) {
      //Se não etiver logado, chama o loging
        include('login.php');
    }else {
      //Se estiver logado, chama a pagina principal.
      include('main.php');
    }
?>
