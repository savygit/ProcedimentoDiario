<?php 
/*
 * @version   1.00
 * @author    Giovana Aline Bruno
 * 
 * @desc recupera um banco de dados de acordo com as opções selecionadas
 *
 * v 1.00 2016-11-10
 * v 1.10 2023-11-01 dsc: Inclusão da importação do novos tabextras e IntEDI
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
		$cmd = "";
		if (isset($_REQUEST["copiaatustrix"]))
				echo 'xcopy "C:\xampp\htdocs\Trix\TrixProjeto\Desenvolvimento\AtuSTrix.sql" "C:\xampp\mysql\bin"\n\n';
			
		$cmd .= "cd $caminho\n";
		$bd = $_REQUEST["nomebd"];
		$cmd .= "mysql -uroot\n";
		if (isset($_REQUEST["recriabd"]))
		$cmd .= "drop database if exists $bd;\n" . 
			 "create database $bd;\n";
			 $cmd .= "use $bd\n";
		if (isset($_REQUEST["recriabd"]))
		$cmd .= "source $bd.sql;\n";
		if (isset($_REQUEST["tabextra"]))
		$cmd .= "source tabextras.sql;\n";
		if (isset($_REQUEST["tabextra2"]))
		$cmd .= "source tabextras2.sql;\n";
		if (isset($_REQUEST["tabextra3"]))
		$cmd .= "source tabextras3.sql;\n";
		if (isset($_REQUEST["tabextra4"]))
		$cmd .= "source tabextras4.sql;\n";
		if (isset($_REQUEST["intedi"]))
		$cmd .= "source IntEDI.sql;\n";
		if (isset($_REQUEST["atustrix"]))
		{			
			$cmd .= "source C:\\xampp\htdocs\Trix\TrixProjeto\Desenvolvimento\AtuSTrix.sql\n";
		}
		elseif (isset($_REQUEST["atustrix2"]))
		{		
			$cmd .= "source C:\\xampp\htdocs\Trix\TrixProjeto2.0\Desenvolvimento\AtuSTrix.sql\n";
		}
		if (isset($_REQUEST["bloqjob"]))
		{
			$cmd .= "update JobAut set Status = 'Y' where Status = 'P';\n";
			$cmd .= "update Emails set StatusEnvio = 'C' where StatusEnvio = 'A';\n";
		}
			
		$cmd .= "exit\n"; 
		
		echo "<textarea cols=100 rows=14 style='font-size:12pt'>$cmd</textarea>";
		
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
echo ("<input type='checkbox' name='tabextra3' >Importar tabextras3.sql<br>");
echo ("<input type='checkbox' name='tabextra4' >Importar tabextras4.sql<br>");
echo ("<input type='checkbox' name='intedi' >Importar IntEDI.sql (SPModal)<br>");
echo ("<input type='checkbox' name='atustrix' checked>Importar AtuSTrix.sql<br>");
echo ("<input type='checkbox' name='atustrix2' >Importar AtuSTrix.sql 2.0<br>");
echo ("<input type='checkbox' name='bloqjob' checked>Bloquear JOBS e E-mails agendados?<br>");
echo ("<br><input type=submit name=GerarCodigo value='Gerar Codigo'>");
echo ("</form>");
?>
</BODY>
</html>