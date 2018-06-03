<?php
  class Usuario {
    public function updateUser($name, $password, $photo) {
        $sql = MySql::dataBaseConnector()->prepare("UPDATE `your_table.name` SET nome_user = ?, password_user = ?, user_img = ? WHERE login_user = ?");
        if($sql->execute(array($name, $password, $photo, $_SESSION['userLogin']))) {
            return true;
        }else {
            return false;
        }
    }
    public static function insertUser($loginUser, $password, $userPhoto, $name, $jobPosition) {
      //Inserindo usuário no banco
      $sql = MySql::dataBaseConnector()->prepare("INSERT INTO `your_table.name` VALUES(null,?,?,?,?,?)");
      if($sql->execute(array($loginUser, $password, $userPhoto, $name, $jobPosition))) {
        return true;
      }else{
        return false;
      }
    }
    public static function getAllUsers() {
      //Seleciona todos os usuários já criados no banco
      $sql = MySql::dataBaseConnector()->prepare("SELECT * FROM `your_table.name`");
			$sql->execute();
			return $sql->fetchAll();
    }
    public static function userExists($loginUser) {
      //Verificando se o usuário existe
      $sql = MySql::dataBaseConnector()->prepare("SELECT id_user FROM `your_table.name` WHERE login_user=?");
      $sql->execute(array($loginUser));
      if($sql->rowCount() == 1) {
        return true;
      }else {
        return false;
      }
    }
  }
?>
