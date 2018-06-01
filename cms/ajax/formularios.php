<?php
include('../config.php');
/*Pegando todas as informações do form_contato*/
$data    = array();
if($_POST['identificador'] == 'form_home') {
  $subject = "Novo Email Cadastrado";
}else {
  $subject = "Nova Mensagem Recebida do Cliente";
}
$body    = '';
foreach ($_POST as $key => $value) {
  $body.= ucfirst($key).": ".$value;
  $body.= "<hr>";
}
$msg  = array('assunto' => $subject, 'corpo' => $body);
$mail = new Email('smtp.gmail.com','robson.rocha18@gmail.com','michelle-souza', 'Robson Rocha');
$mail->addAdress('robson.rocha18@gmail.com', 'Robson Rocha');
$mail->formatarEmail($msg);
if($mail->enviarEmail()) {
  $data['sucesso'] = true;
}else {
  $data['erro'] = true;
}
die(json_encode($data));
?>
