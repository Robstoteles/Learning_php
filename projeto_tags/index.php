<?php
try {
	$pdo = new PDO("mysql:dbname=your_database;host=your_host", "your_user", "your_password");
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}
/*
		A ideia é pegar as palavras que se repetem nas caracteriscas e exibi-las
		Retornar a quantidade de daquelas palavras
		Com isto é possível pegar as palavras e também a quantidade de vezes que cada uma se repete
		O mesmo conceito pode ser usado para verificar quais usuários logam frequentemente no sistema etc...
*/

$sql = "SELECT caracteristicas FROM usuarios";
$sql = $pdo->query($sql);
if($sql->rowCount() > 0) {
	$lista = $sql->fetchAll();

	$carac = array();

	foreach($lista as $usuario) {
		$palavras = explode(",", $usuario['caracteristicas']);
		foreach($palavras as $palavra) {
			$palavra = trim($palavra);

			if(isset($carac[$palavra])) {
				$carac[$palavra]++;
			} else {
				$carac[$palavra] = 1;
			}
		}
	}

	//Ordenando o array do maior para o menor
	arsort($carac);

	//Pegando apenas as palavras do array
	$palavras = array_keys($carac);
	//Pegando a contagem
	$contagens = array_values($carac);

	//Pegando o que se repete mais vezes
	$maior = max($contagens);

	//Tamanho das palavras(em px)
	$tamanhos = array(11, 15, 20, 30);

	for($x=0;$x<count($palavras);$x++) {

		$n = $contagens[$x] / $maior;

		$h = ceil($n * count($tamanhos));

		echo "<p style='font-size:".$tamanhos[$h-1]."px'>".$palavras[$x]." (".$contagens[$x].")</p>";

	}





}
