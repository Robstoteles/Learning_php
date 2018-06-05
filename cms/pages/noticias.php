<section class="headerNews bgPurple padding40_0">
  <div class="center">
      <h2 class="whiteText mainTitle"><i class="far fa-bell"></i>  Últimas Notícias</h2>
  </div><!-- center -->
</section><!-- headerNews -->

<section class="containerPortal padding50_0">
    <div class="center">
      <div class="sidebar">

          <div class="contentSidebar grayDDD padding15">
              <h3 class="purple font18"><i class="fa fa-search"></i>  Pesquisar:</h3>
              <form method="get">
                <input class="generalInput border220 margin10_0 paddingLeft8" type="text" name="search" placeholder="Digite Aqui Sua Busca" value="" required>
                <button class="btnGeneral redF40B5C whiteText margin10_0" type="submit" name="search">Pesquisar</button>
              </form>
          </div><!-- contentSidebar -->
          <div class="contentSidebar grayDDD padding15">
              <h3 class="purple font18">Selecione Uma Categoria</h3>
              <form method="get">
                <select class="generalInput border220 margin10_0 paddingLeft8" name="categoria" value="" required>
                    <option value="esportes">Esportes</option>
                    <option value="politica">Política</option>
                    <option value="saude">Saúde</option>
                </select>
              </form>
          </div><!-- contentSidebar -->
          <div class="contentSidebar grayDDD padding15">
              <h3 class="purple font18"><i class="fa fa-user" aria-hidden="true"></i> Sobre o Autor:</h3>
              <div class="boxAuthor textCenter">
                  <div class="imgAuthor"></div><!-- imgAuthor -->
                  <div class="textAuthor textCenter margin10_0">
                      <h3 class="purple font18 color646464 margin10_0">Robson Rocha</h3>
                      <p class="color646464">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit
                        Sed do eiusmod tempor incididunt ut labore et dolore magna
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit
                        Sed do eiusmod tempor incididunt ut labore et dolore magna
                      </p>
                  </div><!-- textAuthor -->
              </div><!-- boxAuthor -->
          </div><!-- contentSidebar -->
          <div class="clear"></div><!-- clear -->
      </div><!-- sidebar -->

      <main class="contentNews">
          <section class="contentHeader purple">
            <!--<h2 class="fontTitle">Notícias</h2> -->
            <h2 class="fontTitle">Visualizando Notícias Em <span>Esportes</span></h2>
          </section><!-- contentHeader -->
          <?php for($i=0;$i < 5;$i++): ?>
          <section class="news">
              <h2 class="fontSubTitle color646464">05/06/2018 - Conheça os Eleito para Ga...</h2>
              <p class="color646464 fSmall">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              </p>
              <a class="fSmall" href="<?php echo INCLUDE_PATH; ?>esportes/nome-do-post">Continuar Lendo</a>
          </section><!-- news -->
        <?php endfor; ?>
        <div class="clear"></div>
      </main><!-- contentNews -->
    </div><!-- center -->
    <div class="clear"></div>
</section><!-- containerPortal -->
