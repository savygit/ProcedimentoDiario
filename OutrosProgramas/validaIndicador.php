<?php
include_once 'funcbase.php';
include_once 'ESCPDaSuFr.php';
include_once 'funcNFE0.php';
$bd = "bdsigcfr";
$pm = "";
for ($i = 0; $i <= bd; $i++)
   $pm .= ":";
SetPar($pm, bd, $bd);
SetPar($pm, USID, 115);

$dataBase = "2023-05-01";
$dataLimite = "2016-01-01";

while ($dataBase >= $dataLimite)
{
   SetPar($pm, dado_chave, MesM($dataBase) . "/" . AnoM($dataBase));
   ob_start();
   IndicEscola($fp, $pm, $qual);
   $html = ob_get_contents();
   ob_end_clean();
   $dom = new DOMDocument();
   @$dom->loadHTML($html);

   $array = $array2 = array();
   $links = $dom->getElementsByTagName('table');
   foreach ($links as $link)
   {
      $n = $link->getElementsByTagName('th');
      foreach ($n as $node)
      {
         $array[] = utf8_decode($node->nodeValue);
      }
      $n = $link->getElementsByTagName('td');
      foreach ($n as $node)
      {
         $array2[] = ($node->nodeValue);
      }
   }

   foreach ($array as $i => $val)
   {
      echo "tabela*$dataBase*$val*{$array2[$i]}<br>";
   }
   
//   echo "<hr>";
   $links = $dom->getElementsByTagName('tkf');
   $array = array();
   foreach ($links as $node)
   {
      $array[] = utf8_decode($node->nodeValue);
   }

   $links = $dom->getElementsByTagName('tch');
   $array2 = array();
   foreach ($links as $node)
   {
      $array2[] = utf8_decode($node->nodeValue);
   }

   foreach ($array2 as $i => $val)
   {
      echo "geral*$dataBase*$val*{$array[$i]}<br>";
   }
   
   $dataBase = CalcTempo($dataBase, -1, "mes");
}
?>