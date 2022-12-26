<?php
/**
* @version   1.00
* @author    Giovana Aline Bruno
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
div{margin-left:30px;margin-top:3px;border-radius:3px; border: 1px solid #000; min-height: 25px; padding:5px;font-size:10pt; background-color:#F5F6CE; width: 50%}
}
</style>
<BODY>
<?php
echo "<h3> Recuperar e importar Banco de Dados: </h3>";
echo "<b>1- </b>Acessar no servidor <u>Windows</u>: D:\BACKUP <br>" ;
echo "<b>2 - </b>Encontrar qual a data do bkp vai ser restaurada. BK_YYYYMMDD.rar <br>" ;
echo "<b>3- </b>Encontrar qual o banco da empresa será restaurada <br>" ;
echo "<b>4- </b>Extrair o compactado do BKP e extrair o bkp individual, deixando apenas o SQL <br>" ;
echo "<div><span style='color:red'>Se for um bkp Vergon (início c1XXXXX) deve remover a 1a linha do arquivo</span></div>";
echo "<div>Para abrir arquivos grandes, utilizar o TextPad</div>";
echo "<div><b>O Arquivo principal DEVE estar com o mesmo nome do banco a ser criado. <span style='color:red'>É CASE SENSITIVE</span></b></div>";
echo "<b>5- </b>Colocar o arquivo SQL do banco que deseja criar no servidor: <b>\\\\srvsavy\Servidor\sql</b><br>";
echo "<b>6- </b>Acessar o servidor pelo PuTTY e digitar:" .
	"<div style='padding-left:50px'><b>cd /home/servidor/scripts<br>";
echo "sudo ./menu.sh</b><br></div>";
echo "<b>7- </b>&emsp;<i>Pode solicitar a senha do servidor por usar o comando sudo</i><br>";
echo "<b> Digite: </b><br>&nbsp <b>1:</b> Para importar banco de dados<br>&nbsp <b>2:</b> Para importar o AtuSTrix em algum banco<br><br>";
echo "Siga as orientações apresentadas na tela!<br><br>";
echo "<DIV><b>Obs.: Quanto a importação for de uma banco que esta no Windows como o da Tóride, deve usar o programa abaixo para gerar os Alter Table:</b><br>";
echo "http://srvsavy/Trix/OutrosProgramas/RenomearTabelas.php?bd=toride</DIV>";
/*
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
			echo "source AtuSTrix.sql;<br>";
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
echo ("<input type='checkbox' name='bloqjob' checked>Bloquear JOBS e E-mails agendados?<br>");
echo ("<br><input type=submit name=GerarCodigo value='Gerar Codigo'>");
echo ("</form>");
*/
?>
</BODY>
</html>