<?php
  include('../config.php');
/*Usando o PHPMailer para envio de email*/
//Verificando se o form_home foi enviado
  if(isset($_POST['acao']) && $_POST['identificador'] == 'form_home') {
    //Verificando se o input email foi preenchido
    if($_POST['email'] != '') {
      $emailUser = $_POST['email'];
      //Verificando se o email é válido
      if(filter_var($emailUser, FILTER_VALIDATE_EMAIL)) {
          //Tudo certo, só enviar o email
          /*
            O código abaixo dispara um email para o dono do Site
            Quando um novo email é cadastrado na pagina
          */
          $mail = new Email('smtp.gmail.com','robson.rocha18@gmail.com','michelle-souza', 'Robson Rocha');
          $mail->addAdress('robson.rocha18@gmail.com', 'Robson Rocha');
          $emailBody = "Novo Email Cadastrado no Site.<hr> ".$emailUser;
          $msg  = array('assunto' => 'Novo Email Cadastrado', 'corpo' => $emailBody);
          $mail->formatarEmail($msg);
          if($mail->enviarEmail()) {
            echo '<script>alert("Mensagem Enviada com Sucesso!.")</script>';
          }else {
            echo '<script>alert("Ocorreu um Erro.")</script>';
          }
      }else{
        echo '<script>alert("Insira Um Email Válido.")</script>';
      }
    }else {
      echo '<script>alert("O Campo Email Não Pode Ser Vazio.")</script>';
    }
  }else if(isset($_POST['acao']) && $_POST['identificador'] == 'form_contato') {

  }


?>
