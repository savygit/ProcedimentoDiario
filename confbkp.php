
<?php
//lista os arquivos conforme o que j� foi parametrizado
// bkp_roteiro.txt contem todos os arquivos de backup que devem ser baixados dos servidores FTP
// 	sua configura��o � NomeArquivo**Se tem todos os dias ou qual dia da semana ele � feito 
// 		(T ou n�meto do dia)**Se valida a sua existencia no log ou n�o. Utilizado para quem n�o faz todo dia
// 		ou algum bkp que precisa dessa exce��o
$roteiro = file("bkp_roteiro.txt");
// log_bkp.txt contem o ultimo log de download dos arquivos do ftp, que sera substituido ao final deste programa se o usuario clicar no bot�o CONFIRMAR
$lines = file("log_bkp.txt");

$real = sizeof($lines);

$arr_log = array();
for ($i = 0; $i < $real; $i++)
{
   $arq = explode("___", $lines[$i]);
   $arr_log[$arq[0]] = $arq;
}

$real = sizeof($roteiro);
$c = "../BkFtp/";

/* csr20190309.ini - monta o caminho completo do diretorio local de bkp */
// assume q esta rodando em Windows e q o caminho de backup � um caminho acessivel a partir do caminho atual (ou seja, que tem pelo menos ..\ uma vez)
$c_completo = getcwd();
$ac_completo = explode("\\", $c_completo);
$c_completo = "";
$c_voltas = substr_count($c, "..");
for ($i = 0; $i < sizeof($ac_completo) - $c_voltas; $i++)
   $c_completo .= $ac_completo[$i] . "\\";
$c_completo .= substr($c, $c_voltas * 3, -1);
/* csr20190309.fim */

echo "<!DOCTYPE html>";
echo "<html>";
echo "<head>";
echo "<title>Verifica��o de Backups dos Bancos de dados do Trix</title>";
echo "<script>function ValidaJust() { wtxt=document.getElementById('idObsConfLog').value; if (wtxt== '') {alert('Preencher a justificativa'); return false;} else return true; }</script>";
echo "<script type='text/javascript' src='http://localhost/Trix/TrixProjeto/Desenvolvimento/jquery/jquery.js'></script>";
echo "<script type='text/javascript' src='http://localhost/Trix/TrixProjeto/Desenvolvimento/rotinas.js'></script>";
echo "</head>";
echo "<body>";

$log = "";

$h = "<b style='font-size: 16pt; color: DARKGREEN'>Verifica��o de Backups dos Bancos de dados do Trix</b><br>";
$h .= "<b>�ltimo refresh da tela: " . date('d/m/Y - H:i:s') . " - Diret�rio local de backup: $c_completo</b>\n";
$h .= "<table border=1 style='border: 1px solid black; border-collapse: collapse; font-family: arial; font-size: 9pt' cellpadding=3px cellspacing=3px>";
$h .= "<tr style='background-color:NAVY; color: WHITE; border: white'><th>Data do<br>�ltimo log</th><th>Arquivo</th>";
$h .= "<th>Tamanho do<br>�ltimo backup</th><th>Tamanho<br>encontrado atual</th><th>Data</th><th>Diferen�a</th><th>Diferen�a<br>%</th><th>Status</th></tr>";
$algum_problema = false;
for ($i = 0; $i < $real; $i++)
{
   $cor = "#cdcdcd";
   $n = trim($roteiro[$i]);

//	todas as linhas deve ter **
   $dia = explode("**", $n);
   if (($dia[1] != "T") && ($dia[1] != date("w")))
      continue;
   $nome = $dia[0];
   $arq = $arr_log[$nome];

   if (substr($nome, 0, 10) == "##SERVIDOR")
   {
      $h1 = "<td colspan=8 align=center style='background-color:CYAN'>" . $nome . "</td>";
      $cor = "NAVY";
   }
   else
   {
      $h1 = "<td>" . $arq[2] . "</td>";    // data
      $h1 .= "<td>" . $nome . "</td>";     // arquivo
      $h1 .= "<td align=right>" . $arq[1] . "</td>"; // tamanho do log
      if (sizeof($arq) > 0)
      {
         
      }

//		echo "log: " . $arq[2] . " Arquivo:" . $nome . "Tamanho: " . $arq[1] . "<br>";
      $cor = "RED";
//      echo "$c$nome<hr>";
      if (file_exists($c . $nome))
      {
         //tamanho encontrado em MB
         $t = (round(filesize($c . $nome) / 1024));
         $h1 .= "<td align=right>" . $t . "</td>"; // tamanho encontrado

         $log .= $nome . "___" . $t . "___" . date("Ymd") . "\n";
         $h1 .= "<td>" . date("d/m/Y H:i:s", filemtime($c . $nome)) . "</td>";

         if (sizeof($arq) == 0)
         {
            if ($dia[2] == "S") //=N n�o precisa validar
            {
               $h1 .= "<td>0</td><td><b>ERRO: N�o encontrado no log</b></td>";
               $algum_problema = true;
            }
            else
            {
               if (date("d/m/Y H:i:s", filemtime($c . $nome)) <= $arq[2])
               {
                  $h1 .= "<td>0</td><td><b>ERRO: J� foi feito backup desse arquivo anteriormente</b></td>";
               }
               else
               {
                  $cor = "green";
                  $h1 .= "<td>0</td><td></td><td><b>AVISO: N�o tem log do dia anterior</b></td>";
               }
            }
         }
         else
         {
            $h1 .= "<td align=right>" . ($t - $arq[1]) . "</td>"; // diferen�a
            $dif = $t - $arq[1];
            $dif = round($dif / $arq[1], 2) * 100;
            $h1 .= "<td align=right>$dif</td>";       // % 
            if (abs($dif) > 5)
            {
               if ($dia[2] == "S")
               {
                  $algum_problema = true;
                  $h1 .= "<td><b>ERRO: Varia��o do tamanho maior que 5%</b></td>"; // status
               }
               else
                  $h1 .= "<td><b>AVISO: N�o precisa validar</b></td>"; // status
            }
            else
            {
               if (date("Ymd", filemtime($c . $nome)) <= $arq[2])
               {
                  $h1 .= "<td><b>ERRO: J� foi feito backup desse arquivo anteriormente</b></td>";
               }
               else
               {
                  $h1 .= "<td>OK: arquivo baixado com sucesso do servidor FTP para diret�rio local de backup</td>";  // status
                  $cor = "GREEN";
               }
            }
         }
      }
      else
      {
         $h1 .= "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td><b>ERRO: Arquivo n�o encontrado no diret�rio local de backup (n�o foi baixado do FTP)</b>"; // status
         $algum_problema = true;
      }
   }
   $h .= "<tr style='color:$cor'>" . $h1 . "</tr>";
}
$h .= "</tr></table>";

if (isset($_POST["btConfirmar"]))
{
   echo "<h3>CONFIRMA��O DO LOG</h3>";

   if (isset($_POST["ObsConfLog"]))
   {
      if (strlen(trim($_POST["ObsConfLog"])) < 10)
      {
         die("Justificativa deve ter mais que 10 caracteres");
      }
      else
         file_put_contents("./LogBKPDiario/LogConfBKP" . date("Ymd") . ".txt", $_POST["ObsConfLog"]);
   }
   if (trim($log) != "")
   {
      echo "<h3>&emsp;LOG CONFIRMADO</h3>";
      $handle = fopen('log_bkp.txt', "w");
      fwrite($handle, $log);
      fclose($handle);
      echo $h;
   }
   else
      echo "<h3 style='color:red'>&emsp;N�O H� ARQUIVOS. VOC� EST� PROCESSANDO DUAS X</h3>";
}
else
{
   echo $h;
   if ($algum_problema)
   {
      echo "<meta http-equiv='refresh' content='30'>";
      echo ("<h3>Sua tela ser� atualizada em <span id='segundos'>0</span></h3>");
      echo ("<script>Timer(30, \"segundos\");</script>");

      echo "<b style='color: RED'>FORAM ENCONTRADOS ERROS NO PROCESSO DE DOWNLOAD DOS ARQUIVOS DE BACKUP.</b><BR>";
      echo "<b style='color: RED'>OBRIGAT�RIO INFORMAR UMA JUSTIFICATIVA PARA CONFIRMAR O BACKUP.</b><BR>";
      echo "<form action='confbkp.php' method='post' onsubmit='return ValidaJust();'>";
      echo "Justificativa: <textarea name='ObsConfLog' id='idObsConfLog' cols=100; rows=2></textarea><br><br>";
   }
   else
      echo '<form action="confbkp.php" method="post">';
   echo "<i>Ao clicar em CONFIRMAR, o arquivo log_bkp.txt ser� atualizado com o log atual.</i><br>";
   echo ("<input type=submit name='btConfirmar' value = 'CONFIRMAR'>");
   echo ("</form>");
}
echo "</body></html>";
?>