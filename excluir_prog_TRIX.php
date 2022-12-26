<?php

if (isset($_REQUEST["Confirmar"]))
{
	$caminho = "../../TrixProjeto/Desenvolvimento/";
	$destino = "../Programas EXCLUIDOS do TRIX/";
	$programas = trim($_REQUEST["prog"]);
	$programas = explode(",", $programas);
	
	if (sizeof($programas) > 0)
	{
		for ($i=0; $i < sizeof($programas); $i++)
		{
			$programas[$i] = trim($programas[$i]);
			$d = explode(".", $programas[$i]);
			$d = $d[0] . "_" . date("Ymd") . "." . $d[1];
			echo "copiou o programa " . $programas[$i] . " para " . $destino . " $d<br>";
			copy($caminho . $programas[$i], $destino . $d);
		}
	}
	else
		echo "Nenhum arquivo informado";
}
else
{
	echo ("<form action='excluir_prog_TRIX.php'>");
	echo "<textarea name=prog placeholder='Programas a serem copiados para Outros Programas, " . 
		"separados por virgula' cols=50 rows 5></textarea>";
	
	echo ("<br><br><input type=submit name='Confirmar'>");
	echo ("</form>");
}
?>