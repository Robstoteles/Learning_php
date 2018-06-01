<?php
    /*
        A classe painel é responsável por todas as funcionalidades relacionadas ao site
        Painel class is responsible for  all website's functionalities.
    */
    class Painel {
      public static $cargos = [
         0 => '',
         1 => 'Normal',
         2 => 'Administrador',
         3 => 'Jornalista'
      ];
      public static function logado() {
        //Verifica se o usuário está logado
        return isset($_SESSION['login']) ? true: false;
      }
      public static function loggout() {
        //Saindo do sistema
        session_destroy();
        header('Location: '.INCLUDE_PATH_PAINEL);
      }
      public static function pegaCargo($cargoUser) {
        //Pega o cargo do usuário
        return self::$cargos[$cargoUser];
      }
      public static function loadPage(){
      //Carregando a página
			if(isset($_GET['url'])){
				$url = explode('/',$_GET['url']);
				if(file_exists('pages/'.$url[0].'.php')){
					include('pages/'.$url[0].'.php');
				}else{
					//Página não existe!
					header('Location: '.INCLUDE_PATH_PAINEL);
				}
			}else{
				include('pages/home.php');
			}
		}
    public static function alert($type, $message) {
      //Função responsável por mostrar alertas no sistema
      if($type == "success") {
        echo '<div class="alertBox success">'.$message.'</div>';
      }else if($type == "error") {
        echo '<div class="alertBox error">'.$message.'</div>';
      }
    }
    public static function validateImage($image) {
        //Verificando se a imagem pertence ao grupo de arquivos permitidos
        if($image['type'] == 'image/jpeg' || $image['type'] == 'image/jpg' || $image['type'] == 'image/png') {
            $imageSize = intval($image['size'] / 1024);
            //Verificando se a imagem é menor ou igual a 2MB
            if($imageSize <= 2048) {
                return true;
            }else {
                return false;
            }
            return true;
        }else {
          return false;
        }
    }
    public static function uploadFiles($file) {
        //Criando uma ID unica para os arquivos
        $getFileFormat = explode('.',$file['name']);
        $fileName      = uniqid().'.'.$getFileFormat[count($getFileFormat) - 1];
        //Fim ID única
        if(move_uploaded_file($file['tmp_name'],BASE_DIR_PAINEL.'//uploads//'.$fileName)) {
            return $fileName;
        }else {
            return false;
        }
    }
    public static function deleteFile($file) {
        //Deletando um arquivo da pasta uploads
        @unlink('uploads/'.$file);
    }
    public static function selectedMenu($par) {
        //Mostra a opção no menu que está selecionada
        $url = explode('/', @$_GET['url'])[0];
        if($url == $par) {
            echo 'class="activeMenu"';
        }
    }
    public static function validatePermissionMenu($permission) {
        /*
          Verifica o tipo de permissão do usuário
          Se o usuário tiver permissão, mostra todas as opções disponíveis no menu
        */
        if($_SESSION['cargo_user'] >= $permission) {
            return;
        }else {
            //Se não tiver permissão, esconde determinada funcionalidade no menu
            echo 'style="display:none;"';
        }
    }
    public static function validatePermissionPage($permission) {
      /*
        Verifica o tipo de permissão do usuário
        Se houver permissão, entra na página que foi clicada
      */
      if($_SESSION['cargo_user'] >= $permission) {
          return;
      }else {
          //Se não houver, chama denied.php e mostra "Acesso Negado" e mata a conexão
          include_once('pages/denied.php');
          die();
      }
    }
    public static function validateFields($name, $login, $password, $jobPosition) {
        if($name == '') {
          echo self::alert('error', 'O Campo Nome Não Pode Ser Vazio');
        }else if($login == '') {
          echo self::alert('error', 'O Campo Login Não Pode Ser Vazio');
        }else if($password == '') {
          echo self::alert('error', 'O Campo Senha Não Pode Ser Vazio');
        }else if($jobPosition == '') {
          echo self::alert('error', 'Selecione um Cargo');
        }//else if($userPhoto == '') {
          //echo self::alert('error', 'Selecione uma Foto');
        //}
    }
    public static function insertData($arr) {
      //Inserindo dados de forma dinamica
      /*
        Esta query utiliza os campos do HTMl para inserir os dados no banco
        Tornando desnecessária a construção de Queries
        Basta colocar o nome da tabela na pagina em HTML dentro de um campo do tipo hidden
        E toda query será gerada.
        O -> if($name == 'acao' || $name == 'table_name') {
            continue;
        } Ignora o campo ação do input da página e o campo table_name(que está como hidden no HTML).
        Pois estes campos não existem no Banco de dados, mas são necessários para a query

        Para evitar que existam campos vazios, a variável $certo é verificada e torna-se false
        se o campo não tiver sido preenchido e dá um break.
      */
      $certo = true;
      $table_name = $arr['table_name'];
      $query = "INSERT INTO `$table_name` VALUES(null";
      foreach ($arr as $key => $value) {
        $name  = $key;
        $valor = $value;
        if($name == 'acao' || $name == 'table_name') {
            continue;
        }
        if($value == '') {
           $certo = false;
           break;
        }
        $query.=",?";
        $parametros[] = $value;
      }
      $query.=")";
      if($certo) {
        $sql = MySql::dataBaseConnector()->prepare($query);
        $sql->execute($parametros);
        $lastId = MySql::dataBaseConnector()->lastInsertId();
        $sql = MySql::dataBaseConnector()->prepare("UPDATE `$table_name` SET order_id=? WHERE id=$lastId");
        $sql->execute(array($lastId));
      }
      return $certo;
    }
    public static function updateData($arr, $single = false) {
      //Atualizando dados de forma dinamica
      /*
        Esta query utiliza os inputs do HTMl para Atualizar os dados no banco
        Tornando desnecessária a construção de Queries
        Basta colocar o nome da tabela na pagina em HTML dentro de um campo do tipo hidden
        E toda query será gerada.
        O -> if($nome == 'acao' || $nome == 'table_name' || $nome == 'id') {
            continue;
        } Ignoram os campos: ação do input da página, o campo table_name, e o campo id(que estão como hidden no HTML).
        Pois estes campos não existem no Banco de dados, mas são necessários para a query

        Para evitar que existam campos vazios, a variável $certo é verificada e torna-se false
        se o campo não tiver sido preenchido e dá um break.

        A variável $first verifica se a query está sendo criada pela primeira vez
        $first quando false cria a query e atualiza para true
        $first quando true acrescenta  uma ","(virgula) para separar os campos da tabela que serão atualizados
      */
      $certo = true;
			$first = false;
			$table_name = $arr['table_name'];

			$query = "UPDATE `$table_name` SET ";
			foreach ($arr as $key => $value) {
				@$nome = $key;
				$valor = $value;
				if($nome == 'acao' || $nome == 'table_name' || $nome == 'id')
					continue;
				if($value == ''){
					$certo = false;
					break;
				}

				if($first == false){
					$first = true;
					$query.="$nome=?";
				}
				else{
					$query.=",$nome=?";
				}

				$parametros[] = $value;
			}

			if($certo == true){
				if($single == false){
					$parametros[] = $arr['id'];
					$sql = MySql::dataBaseConnector()->prepare($query.' WHERE id=?');
					$sql->execute($parametros);
				}else{
					$sql = MySql::dataBaseConnector()->prepare($query);
					$sql->execute($parametros);
				}
			}
			return $certo;
    }
    //Seleciona apenas um item na tabela
    public static function selectItem($table,$query = '',$arr = '')  {
      if($query != false){
        $sql = MySql::dataBaseConnector()->prepare("SELECT * FROM `$table` WHERE $query");
        $sql->execute($arr);
      }else {
        $sql = MySql::dataBaseConnector()->prepare("SELECT * FROM `$table`");
        $sql->execute();
      }
      return $sql->fetch();
    }
    //Seleciona todos os itens da tabela
    public static function selectAll($table, $start = null, $end = null) {
      if($start == null && $end == null) {
        $sql = MySql::dataBaseConnector()->prepare("SELECT * FROM `$table` ORDER BY order_id ASC");
      }else {
        $sql = MySql::dataBaseConnector()->prepare("SELECT * FROM `$table` ORDER BY order_id ASC LIMIT $start,$end");
      }
      $sql->execute();
      return $sql->fetchAll();
    }
    public static function deleteItem($table, $idItem = false) {
      if($idItem == false) {
        $sql = MySql::dataBaseConnector()->prepare("DELETE FROM `$table`");
      }else {
        $sql = MySql::dataBaseConnector()->prepare("DELETE FROM `$table` WHERE id = $idItem");
      }
      $sql->execute();
    }
    public static function redirectPage($url) {
      //Redirecionando a pagina com JS
      echo '<script>location.href="'.$url.'"</script>';
      die();
    }
    public static function orderItem($table,$orderType,$idItem){
      //Movendo itens para cima
      if($orderType == 'up') {
        $currentItem = self::selectItem($table,'id=?',array($idItem));
        $orderId = $currentItem['order_id'];
        $beforeItem = MySql::dataBaseConnector()->prepare("SELECT * FROM `$table` WHERE order_id < $orderId ORDER BY id DESC LIMIT 1");
        $beforeItem->execute();
        if($beforeItem->rowCount() == 0) {
          return;
        }
        $beforeItem = $beforeItem->fetch();
        self::updateData(array('table_name' => $table,'id'=>$beforeItem['id'],'order_id'=>$currentItem['order_id']));
        self::updateData(array('table_name' => $table,'id'=>$currentItem['id'],'order_id'=>$beforeItem['order_id']));
      }else if($orderType == 'down') {
        $currentItem = self::selectItem($table,'id=?',array($idItem));
        $orderId = $currentItem['order_id'];
        $beforeItem = MySql::dataBaseConnector()->prepare("SELECT * FROM `$table` WHERE order_id > $orderId ORDER BY id ASC LIMIT 1");
        $beforeItem->execute();
        if($beforeItem->rowCount() == 0) {
          return;
        }
        $beforeItem = $beforeItem->fetch();
        self::updateData(array('table_name' => $table,'id'=>$beforeItem['id'],'order_id'=>$currentItem['order_id']));
        self::updateData(array('table_name' => $table,'id'=>$currentItem['id'],'order_id'=>$beforeItem['order_id']));
      }
		}
    public static function generateSlug($str) {
      $str = mb_strtolower($str);
			$str = preg_replace('/(â|á|ã|à)/', 'a', $str);
			$str = preg_replace('/(ê|é|è)/', 'e', $str);
			$str = preg_replace('/(í|Í|ì)/', 'i', $str);
			$str = preg_replace('/(ú|ù)/', 'u', $str);
			$str = preg_replace('/(ó|ô|õ|Ô|ò)/', 'o',$str);
			$str = preg_replace('/(_|\/|!|\?|#)/', '',$str);
			$str = preg_replace('/( )/', '-',$str);
			$str = preg_replace('/ç/','c',$str);
      $str = preg_replace('/ñ/','n',$str);
			$str = preg_replace('/(-[-]{1,})/','-',$str);
			$str = preg_replace('/(,)/','-',$str);
			$str=strtolower($str);
			return $str;
    }
    public static function recoverPost($post){
  		if(isset($_POST[$post])){
  			echo $_POST[$post];
  	}
  }
}

?>
