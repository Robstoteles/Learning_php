<?php
  include("config.php");
  UsuarioOnline::updateUsuarioOnline();//Shows how many users are active on the website
    $infoSite = Painel::selectItem('table_name'); //Here goes the table name from the database
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/style.css">
    <link href="<?php echo INCLUDE_PATH; ?>css/fontawesome-all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <title><?php echo $infoSite['title_of_your_site'];//Here you should put the column name that contains the website name ?></title>
  </head>
  <body>
  <base urlbase="<?php echo INCLUDE_PATH; ?>">
    <div class="sucesso">Formulário Enviado Com Sucesso</div> <!-- sucesso -->
    <div class="erroEnvio">Ocorreu Um Erro ao Enviar o Formulário</div> <!-- erroEnvio -->
    <div class="overlayLoading">
        <img src="<?php INCLUDE_PATH ?>img/ajax-loader.gif" alt="Enviando Formulário">
    </div> <!-- overlayLoading -->
    <?php
      $url = isset($_GET["url"]) ? $_GET["url"]: "home";
      switch ($url) {
        case 'sobre':
          echo '<target target="sobre" />';
        break;
        case 'servicos':
          echo '<target target="servicos" />';
        break;
      }
    ?>

    <?php include("header.php"); ?>

    <div class="boxdinamico">
      <?php
        /*
          Inserindo as paginas dinamicamente
          Calling pages dinamicly
        */
        if(file_exists("pages/".$url.".php")) {
            include("pages/".$url.".php");
        }else {
          if($url != 'sobre' && $url != 'servicos'){
            $page404 = true;
            include("pages/404.php");
          }else{
            include("pages/home.php");
          }
        }
      ?>
    </div> <!-- boxDinamico -->


    <?php include("footer.php"); ?>


    <script src="<?php echo INCLUDE_PATH; ?>js/jquery3.3.1.min.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>
    <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDHPNQxozOzQSZ-djvWGOBUsHkBUoT_qH4'></script>
  	<script src="<?php echo INCLUDE_PATH; ?>js/script.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/formularios.js"></script>
    <?php
      if($url == 'contato') {
    ?>
    <?php } ?>
  </body>
</html>
