<?php
  class Core {
    public function run() {
        $url = '/';
        if(isset($_GET['url'])) {
          $url .= $_GET['url'];
        }
        $param = array();
        //Verificando se a url não está vazia e se é diferente de "/"
        if(!empty($url) && $url != '/') {
          $url = explode('/', $url);
          array_shift($url);

          $currentController = $url[0].'Controller';
          array_shift($url);

          if(isset($url[0]) && !empty($url[0])) {
            $currentAction = $url[0];
            array_shift($url);
          }
          else {
            $currentAction = 'index';
          }
          if(count($url) > 0) {
            $param = $url;
          }
        }
        else {
          $currentController = 'homeController';
          $currentAction     = 'index';
        }

        $c = new $currentController();
        call_user_func_array(array($c, $currentAction), $param);
        /*echo "Controller: ".$currentController.'<br>';
        echo "Action: ".$currentAction.'<br>';
        echo "Param: ".print_r($param, true).'<br>';*/
    }
  }
?>
