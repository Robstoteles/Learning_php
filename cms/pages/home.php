<?php
  //All these methods are explained in Painel class
  $depoimentos = Painel::selectAll('table'); //Here you should put the table name you want to work with
  $servicos = Painel::selectAll('table');//Here you should put the table name you want to work with

?>
<section class="mainBanner">
  <div class="overlay"></div><!-- overlay -->
  <div class="center">
    <form method="post">
      <h2>Qual seu Melhor Email?</h2>
      <input type="email" name="email" required>
      <input type="hidden" name="identificador" value="form_home">
      <button type="submit" name="acao">Cadastrar</button>
    </form> <!-- FORM -->
  </div> <!-- center -->
</section> <!-- Section mainBanner -->

<section class="authorDescription">
    <div class="center">
      <div class="w50 left">
        <h2><?php echo $infoSite['column'];//Showing the author's name on the page ?></h2>
        <p>
            <?php echo $infoSite['column'];//Showing the description about the website's creator ?>
        </p>
        <p>
            <?php echo $infoSite['column'];//Showing the description about the website's creator ?>
        </p>
      </div> <!-- W50 -->

      <div class="w50 left">
        <!-- Coloque sua foto aqui -->
        <img class="right" src="<?php echo INCLUDE_PATH; ?>img/eu.jpg" alt="Foto do fundador do site Robson Rocha">
      </div> <!-- W50 -->
        <div class="clear"></div> <!-- clear -->
    </div> <!-- center -->
</section> <!-- SECTION authorDescription -->

<section class="works">
  <div class="center">
    <h2 class="title">Especialidades</h2>
  <?php for($i=1;$i<=3;$i++){
      //Criando um looping para mostrar os icones, titulos, e descrições
      //Looping through the data and showing icons, and a bunch of texts on the web page
  ?>
    <div class="w33 left worksBox">
      <h3><i class="<?php echo $infoSite['column'.$i];//Showing icons ?>"></i></h3>
      <h4><?php echo $infoSite['column'.$i];//Showing title of the icons ?></h4>
      <p>
        <?php echo $infoSite['column'.$i];//Showing the text below the icons' images ?>
      </p>
    </div> <!-- worksBox -->
  <?php }//Fechando o for do worksBox ?>
    <div class="clear"></div> <!-- clear -->
  </div> <!-- center -->
</section> <!-- section works -->

<section class="extras">
   <div class="center">
     <div id="sobre" class="w50 left">
       <h2 class="title">Depoimentos</h2>
       <?php
           foreach ($depoimentos as $key => $value):
             // Mostrando os depoimentos

       ?>
       <div class="singleTestemonials">
         <p class="testemonialDescription">
           <?php echo $value['column'];//Mostrando o depoimento ?>
         </p>
         <p class="authorName"><?php echo $value['column'];//Mostrando o nome do autor ?></p>
       </div> <!-- singleTestemonials -->
       <?php
           endforeach;
       ?>
     </div> <!-- w50 -->

     <div id="servicos" class="w50 left">
       <h2 class="title">Serviços</h2>
       <div class="services">
         <ul>
           <?php
               foreach ($servicos as $key => $value):
                 // Mostrando os serviços
           ?>
           <li>
              <?php echo $value['column']; ?>
           </li>
           <?php
               endforeach;
           ?>
         </ul>
       </div> <!-- workList -->
     </div> <!-- w50 -->
     <div class="clear"></div> <!-- Clear -->
   </div> <!-- center -->
</section> <!-- Extras -->
