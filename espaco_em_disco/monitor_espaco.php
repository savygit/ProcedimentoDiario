<?php
//para servidores que o comando system NÃO está liberado, Vergon
//esse programa fica dentro do Crontab para ficar monitorando o espaço em disco
//esses dados são gerados por um sh que roda todo o dia
//trix.inf.br; mobtrix.com.br;
header("Content-Type: text/html; charset=ISO-8859-1",true);
$file = "monitor_espaco.txt";
if (file_exists($file))
{
   $data = date("d/m/Y H:i:s", filemtime($file));
   echo "Data da geração: $data";
   $texto = file_get_contents($file);
   echo "<pre style='font-family:Tahoma;font-size:9pt'>";
   print_r($texto);
   echo "</pre>";
}
else
   echo "Arquivo $file não encontrado";


//para servidores que o comando system está liberado, Vergon
//esse programa fica na raiz web dos servidores linux contratados
//atualmente ficam em:
//sistematrix.com.br
//seu objetivo é com o comando df -h monitorar o espaço em disco desses servidores
//echo "<pre style='font-family:Tahoma;font-size:9pt'>";
//system("df -h", $result);
//echo "</pre>";