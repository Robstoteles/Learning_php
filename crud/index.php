<?php
require 'banco.php';
$banco = new Banco("localhost", "blog", "root", "root");

$banco->query("SELECT * FROM posts LIMIT 3");

print_r($banco->result());

?>