<?php
  include_once('../config.php');
  $usuariosOnline = UsuarioOnline::getOnlineUser();
  $contadorTotal  = UsuarioOnline::getOnlineVisitors();
  $contadorHoje   = UsuarioOnline::getTodayVisitors();
  $usuariosCadastrados = Usuario::getAllUsers();
?>
<section class="contentBox w100">
    <h2>Painel de Controle - <?php echo NOME_EMPRESA; ?></h2>
    <div class="boxMetricas">
      <section class="boxMetricasSingle">
          <div class="boxMetricaWrapper">
              <h2>Usuários Online</h2>
              <p><?php echo count($usuariosOnline); ?></p>
          </div><!-- boxMetricaWrapper -->
      </section><!-- boxMetricasSingle -->

      <section class="boxMetricasSingle">
          <div class="boxMetricaWrapper">
              <h2>Total de Visitas</h2>
              <p><?php echo $contadorTotal; ?></p>
          </div><!-- boxMetricaWrapper -->
      </section><!-- boxMetricasSingle -->

      <section class="boxMetricasSingle">
          <div class="boxMetricaWrapper">
              <h2>Visitas Hoje</h2>
              <p><?php echo $contadorHoje; ?></p>
          </div><!-- boxMetricaWrapper -->
      </section><!-- boxMetricasSingle -->
      <div class="clear"></div><!-- clear -->

    </div><!-- boxMetricas -->
</section> <!-- contentBox -->

<section class="contentBox w100">
  <h2> <i class="fas fa-users"></i>  Usuários Online </h2>

  <div class="responsiveTable">
    <div class="row">
      <div class="col">
          <span>IP</span>
      </div> <!-- col -->
      <div class="col">
          <span>Ultima Ação</span>
      </div> <!-- col -->
      <div class="clear"></div> <!-- clear -->
    </div> <!-- row -->
    <?php
      foreach ($usuariosOnline as $key => $value) {
        // code...
     ?>
    <div class="row">
      <div class="col">
          <span><?php echo $value['ip_online']; ?></span>
      </div> <!-- col -->
      <div class="col">
          <span><?php echo date('d/m/Y H:i:s',strtotime($value['ultima_acao_online'])); ?></span>
      </div> <!-- col -->
     <div class="clear"></div> <!-- clear -->
    </div> <!-- row -->
  <?php } ?>
  </div> <!-- responsiveTable -->

</section> <!-- contentBox -->

<section class="contentBox w100">
  <h2> <i class="fas fa-users"></i>  Usuários Cadastrados </h2>

  <div class="responsiveTable">
    <div class="row">
      <div class="col">
          <span>Login</span>
      </div> <!-- col -->
      <div class="col">
          <span>Cargo</span>
      </div> <!-- col -->
      <div class="clear"></div> <!-- clear -->
    </div> <!-- row -->
    <?php
      foreach ($usuariosCadastrados as $key => $value) {
        // code...
     ?>
    <div class="row">
      <div class="col">
          <span><?php echo $value['login_user']; ?></span>
      </div> <!-- col -->
      <div class="col">
          <span><?php echo Painel::pegaCargo($value['cargo_user']); ?></span>
      </div> <!-- col -->
     <div class="clear"></div> <!-- clear -->
    </div> <!-- row -->
  <?php } ?>
  </div> <!-- responsiveTable -->

</section> <!-- contentBox -->
