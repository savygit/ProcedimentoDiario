<?php
include_once 'funcbase.php';
if (isset($_GET["bd"]))
{
   $id = 99;
   $bd = $_GET["bd"];
   $aFun = array();
   $nomeEmpresa = EmpresaSimples($bd, "NomeFantasia")["NomeFantasia"];
   //acesso local
   $cons = new ConjReg($bd);
   $cons->ConsGer("SELECT SisFuI.CodFuncional, SisFuI.Descricao, SisFuI.Ativo, PeUsCa.SuporteTrix, '{$id}' as IDEmpresa, " . 
      "'{$nomeEmpresa}' as NomeEmpresa FROM PeUsLi, PeUsCa, SisFuI " .   
      "WHERE PeUsLi.CodFun = SisFuI.CodFuncional and PeUsLi.CodPerfil = PeUsCa.Sequencial and PeUsCa.SuporteTrix = 'N' and " . 
      "SisFuI.Ativo = 'S' and PeUsLi.Acessa = 'S' GROUP BY PeUsLi.CodFun");
   $cons->ExeCons(true);
   $titu = true;
   while ($cons->LeProxReg())
   {
      $d = $cons->ArrRegAtu(false);
      if ($titu)
      {
         echo "\"" . implode("\";\"", array_keys($d)) . "\"<br>";
         $titu = false;
      }
      echo "\"" . implode("\";\"", array_values($d)) . "\"<br>";

      $aFun[$cons->Campo("CodFuncional")] = 1;
   }
   echo "<hr>LOGS<br>";
   $cons->ConsGer("select Funcionalidad, Max(Tempo), count(*) as qtd, '{$id}' as IDEmpresa, '{$nomeEmpresa}' as NomeEmpresa from SisLog where Funcionalidad in (" .
      implode(", ", array_keys($aFun)) . ") group by Funcionalidad");
   $cons->ExeCons(true);
   $titu = true;
   while ($cons->LeProxReg())
   {
      $d = $cons->ArrRegAtu(false);
      if ($titu)
      {
         echo "\"" . implode("\";\"", array_keys($d)) . "\"<br>";
         $titu = false;
      }
      echo "\"" . implode("\";\"", array_values($d)) . "\"<br>";
      $aFun[$cons->Campo("CodFuncional")] = 1;
   }
   return true;
}
$aSistemas = array();
$aSistemas[] = 1;
$aSistemas[] = 8;
$aSistemas[] = 11;
$aSistemas[] = 13;
$aSistemas[] = 14;
$aSistemas[] = 16;
$aSistemas[] = 17;
$aSistemas[] = 18;
$aSistemas[] = 32;
$aSistemas[] = 55;
$aSistemas[] = 59;
$aSistemas[] = 89;
$aSistemas[] = 94;
//$aSistemas[] = 118; //toride alt. naõ acessa remoto
//$aSistemas[] = 25; //toride
$aSistemas[] = 20;

if (isset($_GET["ii"]))
{
   $ii = $_GET["ii"];
}
else
{
   unlink("estudo-lib.txt");
   unlink("estudo-log.txt");
   $ii = 0;
}
if (!isset($aSistemas[$ii]))
{
   die("Acabou");
}
$json = "C:/xampp/htdocs/Trix/AtualizacaoTRIX/localdata.json";
$dados = file_get_contents($json);

$dados = json_decode($dados, true);

$id = $aSistemas[$ii];

$dados = $dados[$id];
echo "<pre style='font-family:Tahoma;font-size:9pt'>";
print_r($dados);
echo "</pre>";
$info = T82_HJ($dados["InfoCon"], $id);
$info = explode("|", $info);

$serv = array();
foreach ($info as $k => $v)
{
   $v = explode("__", $v);
   $serv[$v[0]] = $v[1];
}

$nomeEmpresa = str_replace("Sistema Trix", "", utf8_decode($dados["NomeEmpresa"]));

$aCon = array();
$aCon["H"] = $serv["BDHOST"];
$aCon["U"] = $serv["BDUSER"];
$aCon["P"] = $serv["BDSENHA"];
$aCon["B"] = $serv["BDNOME"];
$cons = new ConjReg("", "", $aCon);

$aFun = array();
$file = fopen("estudo-lib.txt", "a+");
 $cons->ConsGer("SELECT SisFuI.CodFuncional, SisFuI.Descricao, SisFuI.Ativo, PeUsCa.SuporteTrix, '{$id}' as IDEmpresa, '{$nomeEmpresa}' as NomeEmpresa FROM PeUsLi, PeUsCa, SisFuI " .
      "WHERE PeUsLi.CodFun = SisFuI.CodFuncional and PeUsLi.CodPerfil = PeUsCa.Sequencial and PeUsCa.SuporteTrix = 'N' and " . 
      "SisFuI.Ativo = 'S' and PeUsLi.Acessa = 'S' GROUP BY PeUsLi.CodFun");
$cons->ExeCons(true);
$titu = true;
while ($cons->LeProxReg())
{
   $d = $cons->ArrRegAtu(false);
   if ($titu)
   {
      $str = "\"" . implode("\";\"", array_keys($d)) . "\"\n";
      fwrite($file, $str);
      $titu = false;
   }
   $str = "\"" . implode("\";\"", array_values($d)) . "\"\n";
   fwrite($file, $str);
   $aFun[$cons->Campo("CodFuncional")] = 1;
}
fclose($file);

$file = fopen("estudo-log.txt", "a+");
$cons->ConsGer("select Funcionalidad, Max(Tempo), count(*) as qtd, '{$id}' as IDEmpresa, '{$nomeEmpresa}' as NomeEmpresa from SisLog where Funcionalidad in (" .
   implode(", ", array_keys($aFun)) . ") group by Funcionalidad");
$cons->ExeCons(true);
$titu = true;
while ($cons->LeProxReg())
{
   $d = $cons->ArrRegAtu(false);
   if ($titu)
   {
      $str = "\"" . implode("\";\"", array_keys($d)) . "\"\n";
      fwrite($file, $str);
      $titu = false;
   }
   $str = "\"" . implode("\";\"", array_values($d)) . "\"\n";
   fwrite($file, $str);
   $aFun[$cons->Campo("CodFuncional")] = 1;
}
fclose($file);
$ii++;
echo "$ii <hr>";
echo ("<script>setTimeout(Sub,2000);function Sub(){window.location.href=\"estudo-acesso.php?ii=" . $ii . "\"}</script>");
