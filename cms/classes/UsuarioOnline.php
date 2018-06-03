<?php
  class UsuarioOnline {
    public static function updateUsuarioOnline() {
      //Verificando se já existe a sessão
      if(isset($_SESSION['online'])) {
        //Se existir, atualiza no banco
        $token = $_SESSION['online'];
        $horarioAtual = date('Y-m-d H:i:s');
        $check = MySql::dataBaseConnector()->prepare("SELECT id_online FROM `your_table.name` WHERE token_online = ?");
        $check->execute(array($_SESSION['online']));
        if($check->rowCount() == 1) {
          $sql = MySql::dataBaseConnector()->prepare("UPDATE `your_table.name` SET ultima_acao_online = ? WHERE token_online = ?");
          $sql->execute(array($horarioAtual, $token));
        }else {
          $ipUser = $_SERVER['REMOTE_ADDR'];
          $token  = $_SESSION['online'];
          $horarioAtual = date('Y-m-d H:i:s');
          $sql = MySql::dataBaseConnector()->prepare("INSERT INTO `your_table.name` VALUES(null,?,?,?)");
          $sql->execute(array($ipUser, $horarioAtual, $token));
        }
      }else {
        //Se não tiver sessão, insere no banco
        $_SESSION['online'] = uniqid();
        $ipUser = $_SERVER['REMOTE_ADDR'];
        $token  = $_SESSION['online'];
        $horarioAtual = date('Y-m-d H:i:s');
        $sql = MySql::dataBaseConnector()->prepare("INSERT INTO `your_table.name` VALUES(null,?,?,?)");
        $sql->execute(array($ipUser, $horarioAtual, $token));
      }
    }
    public static function getOnlineUser() {
      self::clearOnlineUser();
      //Listando os usuários Que estão online
      $sql = MySql::dataBaseConnector()->prepare("SELECT * FROM `your_table.name`");
			$sql->execute();
			return $sql->fetchAll();
    }
    public static function clearOnlineUser() {
      //Deletando do banco os usuários online após 1 minuto de inatividade
      $date = date('Y-m-d H:i:s');
			$sql = MySql::dataBaseConnector()->exec("DELETE FROM `your_table.name` WHERE ultima_acao_online < '$date' - INTERVAL 1 MINUTE");
    }
    public static function onlineCounter() {
      //Este contador registra os visitantes que possuam IP'S diferentes
      if(!isset($_COOKIE['visita'])) {
        setcookie('visita',true,time() + (60*60*24*7));
        $sql = MySql::dataBaseConnector()->prepare("INSERT INTO `your_table.name` VALUES(null, ?, ?)");
        $sql->execute(array($_SERVER['REMOTE_ADDR'],date('Y-m-d')));
      }
    }
    public static function getOnlineVisitors() {
      $sql = MySql::dataBaseConnector()->prepare("SELECT * FROM `your_table.name`");
      $sql->execute();
      return $sql = $sql->rowCount();
    }
    public static function getTodayVisitors() {
      $sql = MySql::dataBaseConnector()->prepare("SELECT * FROM `your_table.name` WHERE dia_visitas =?");
      $sql->execute(array(date('Y-m-d')));
      return $sql = $sql->rowCount();
    }
  }
?>
