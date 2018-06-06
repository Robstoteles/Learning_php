<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Template</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
  </head>
  <body>
      <header class="header bgColor">
        <div class="center">
            <h1 class="fColor">Este é o Topo</h1>
        </div>
      </header>
      <section>
        <h2><?php $this->loadViewWithinTemplate($viewName, $viewData); ?></h2>
      </section>

      <footer>Oi, eu sou um footer</footer>
  </body>
</html>
