<?php 
/*
* @version   1.00
* @author    Giovana Aline Bruno
* 
* @desc recupera um banco de dados de acordo com as opções selecionadas

v 1.00 2016-11-10
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Recupera Banco de dados</title>
</head>
<style>
body{font-family: Verdana; font-size: 10pt}
li{padding-top:5px; display: block }
input[type="submit"]{height:25px; cursor:pointer;}
input[type="text"]{height:20px; width: 150px; padding:5px; border-radius: 3px}
}
</style>
<BODY>
<a href='http://localhost/Trix/ProcedimentoDiario/'>Home</a><br><br>
<?php
$caminho = "C:\\xampp\\mysql\\bin";
if (isset($_REQUEST["GerarCodigo"]))
{
	if ($_REQUEST["nomebd"] == "")
	 echo "Nome do banco de dados deve ser informado";
	else
	{
		if (isset($_REQUEST["copiaatustrix"]))
				echo 'xcopy "C:\xampp\htdocs\Trix\TrixProjeto\Desenvolvimento\AtuSTrix.sql" "C:\xampp\mysql\bin"<br><br>';
			
		echo "cd $caminho<br>";
		$bd = $_REQUEST["nomebd"];
		echo "mysql -uroot<br>";
		if (isset($_REQUEST["recriabd"]))
			echo "drop database if exists $bd;<br>" . 
			 "create database $bd;<br>";
		echo "use $bd<br>";
		if (isset($_REQUEST["recriabd"]))
			echo "source $bd.sql;<br>";
		if (isset($_REQUEST["tabextra"]))
			echo "source tabextras.sql;<br>";
		if (isset($_REQUEST["tabextra2"]))
			echo "source tabextras2.sql;<br>";
		if (isset($_REQUEST["atustrix"]))
		{			
			//echo "--default-character-set=iso-8859-1;<br>";
			echo "source C:\\xampp\htdocs\Trix\TrixProjeto\Desenvolvimento\AtuSTrix.sql<br>";
		}
		elseif (isset($_REQUEST["atustrix2"]))
		{		
         echo "source C:\\xampp\htdocs\Trix\TrixProjeto2.0\Desenvolvimento\AtuSTrix.sql<br>";
		}
		if (isset($_REQUEST["bloqjob"]))
		{
			echo "update JobAut set Status = 'Y' where Status = 'P';<br>";
			echo "update Emails set StatusEnvio = 'C' where StatusEnvio = 'A';<br>";
		}
			
		echo "exit<br>" . 
			"cd C:\Users\TRIXS\Desktop\Atalhos<br>" . 
		"Acabou.txt<br><br>##fim";
		
	}
	
	die();
}
echo "<h3>Recupera um banco de dados SQL/Importa AtuSTrix em um banco local já existente</h3>";
echo "<ul>";
echo "<li>Todos os arquivos SQL devem estar na pasta xampp/mysql/bin</li>";

$handle = opendir($caminho);
while (false !== ($file = readdir($handle))) // varre cada um dos arquivos da pasta
{
   if (($file != ".") && ($file != ".."))
   {
      if (! is_dir($caminho . "\\" . $file))
      {
      	if (substr($file, -3) == "sql")
         	echo "<li>$file - " . date("d/m/Y H:i:s", filemtime($caminho . "\\" . $file)) . "</li>";
      }
   }
}		
echo "</ul>";

echo ("<form action='recupera_bd.php' method=post>");
echo ("Informe apenas o nome do banco de dados a ser usado: ");
echo ("<input type=text name='nomebd' value = '' size=50>");
echo ("<br><br>Quais processos serão executados:<br>");
echo ("<input type='checkbox' name='recriabd' checked>Recriar o banco de dados<br>");
echo ("<input type='checkbox' name='tabextra' >Importar tabextras.sql<br>");
echo ("<input type='checkbox' name='tabextra2' >Importar tabextras2.sql<br>");
echo ("<input type='checkbox' name='atustrix' checked>Importar AtuSTrix.sql<br>");
echo ("<input type='checkbox' name='atustrix2' >Importar AtuSTrix.sql 2.0<br>");
echo ("<input type='checkbox' name='bloqjob' checked>Bloquear JOBS e E-mails agendados?<br>");
echo ("<br><input type=submit name=GerarCodigo value='Gerar Codigo'>");
echo ("</form>");
?>
</BODY>
</html>