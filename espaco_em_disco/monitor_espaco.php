<?php
//para servidores que o comando system N�O est� liberado, Vergon
//esse programa fica dentro do Crontab para ficar monitorando o espa�o em disco
//esses dados s�o gerados por um sh que roda todo o dia
//trix.inf.br; mobtrix.com.br;
header("Content-Type: text/html; charset=ISO-8859-1",true);
$file = "monitor_espaco.txt";
if (file_exists($file))
{
   $data = date("d/m/Y H:i:s", filemtime($file));
   echo "Data da gera��o: $data";
   $texto = file_get_contents($file);
   echo "<pre style='font-family:Tahoma;font-size:9pt'>";
   print_r($texto);
   echo "</pre>";
}
else
   echo "Arquivo $file n�o encontrado";


//para servidores que o comando system est� liberado, Vergon
//esse programa fica na raiz web dos servidores linux contratados
//atualmente ficam em:
//sistematrix.com.br
//seu objetivo � com o comando df -h monitorar o espa�o em disco desses servidores
//echo "<pre style='font-family:Tahoma;font-size:9pt'>";
//system("df -h", $result);
//echo "</pre>";