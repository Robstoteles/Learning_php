<?php
    //Verificando se o usuário clicou em sair/logout
    if(isset($_GET['loggout'])) {
      //Se sim, então sai do sistema
      Painel::loggout();
    }

    /*Verificando se o usuário está logado
    if(Painel::logado() == false) {
      //Se não etiver logado, chama o loging
        header('Location:'.INCLUDE_PATH_PAINEL);
    }else {
      //echo '<h1>'."Bem Vindo: ".$_SESSION['userLogin'].'</h1>';
*/
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/style.css">
    <link href="<?php echo INCLUDE_PATH; ?>css/fontawesome-all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <title>Painel de Controle</title>
  </head>
  <body>
    <aside class="menu">
      <div class="menuWrapper">
        <div class="boxUser">
          <?php
            //Verificando se o usuário possui uma foto.
            if($_SESSION['user_img'] == '') {
              /*
                Se não tiver foto, define o 'fa fa-user' que esta na <div class='photoPadrao'</div>
                como foto padrão do sistema
              */
          ?>
          <div class="photoPadrao">
            <i class="fa fa-user"></i>
          </div> <!-- photoPadrao -->
        <?php }/*Fecha if $_SESSION['user_img'] */else{
            /*
              Se houver foto, inclui a foto do usuário no sistema e mostra no painel de controle
            */
          ?>
            <div class="photoUser">
              <img src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $_SESSION['user_img'];//Inclui a foto no painel de controle ?>" alt="Foto do Usuário">
            </div> <!-- photoUser -->
          <?php }/*Fecha else da $_SESSION['user_img']*/ ?>
          <div class="nameUser">
            <p><?php echo $_SESSION['nome_user']; ?></p>
            <p><?php echo Painel::pegaCargo($_SESSION['cargo_user']); ?></p>
          </div><!-- nameUser -->
        </div> <!-- boxUser -->
        <div class="menuItems">
            <h2>Cadastro</h2>
            <a <?php Painel::selectedMenu('cadDep'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadDep">Cadastrar Depoimento</a>
            <a <?php Painel::selectedMenu('cadServ'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadServ">Cadastrar Serviço</a>
            <a <?php Painel::selectedMenu('cadSlides'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadSlides">Cadastrar Slides</a>

            <h2>Gestão</h2>
            <a <?php Painel::selectedMenu('listDepo'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>listDepo">Listar Depoimentos</a>
            <a <?php Painel::selectedMenu('listServ'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>listServ">Listar Serviços</a>
            <a <?php Painel::selectedMenu('listSlides'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>listSlides">Listar Slides</a>

            <h2>Administração do Painel</h2>
            <a <?php Painel::selectedMenu('cadUser'); ?> <?php Painel::validatePermissionMenu(2); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadUser">Adicionar Usuários</a>
            <a <?php Painel::selectedMenu('edUser'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>edUser">Editar Usuário</a>

            <h2>Gestão de Notícias</h2>
            <a <?php Painel::selectedMenu('cadCategoria'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadCategoria">Cadastrar Categoria</a>
            <a <?php Painel::selectedMenu('listCategoria'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>listCategoria">Listar Categoria</a>
            <a <?php Painel::selectedMenu('cadNoticia'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadNoticia">Cadastrar Notícia</a>
            <a <?php Painel::selectedMenu('listNoticia'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>listNoticia">Listar Notícia</a>

            <h2>Configurações Gerais</h2>
            <a <?php Painel::selectedMenu('editSite'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>editSite">Editar Site</a>
        </div><!-- menuItems-->
      </div><!-- menuWrapper -->
    </aside><!-- menu -->
    <header>
      <div class="center">
        <div class="menuBtn">
          <i class="fa fa-bars"></i>
        </div> <!-- menuBtn -->

        <div class="logout">
          <a <?php if(@$_GET['url'] == ''): ?> style="background: grey;padding: 17px;"<?php endif; ?>href="<?php echo INCLUDE_PATH_PAINEL ?>"><span>Pagina Inicial</span> <i class="fa fa-home"></i> </a>
          <a href="<?php echo INCLUDE_PATH_PAINEL ?>?loggout"><span>Sair</span> <i class="fa fa-window-close"></i> </a>
        </div> <!-- logout -->
        <div class="clear"></div> <!-- clear -->
      </div> <!-- center -->
    </header>
    <div class="content">
        <?php Painel::loadPage();//Loading home ?>
      <div class="clear"></div> <!-- clear -->
    </div> <!-- content -->

    <script src="<?php echo INCLUDE_PATH; ?>js/jquery3.3.1.min.js"></script>
    <script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/main.js"></script>
    <script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/jquery.mask.js"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>
      tinymce.init({ selector:'.tinymce'});
    </script>
  </body>
</html>
