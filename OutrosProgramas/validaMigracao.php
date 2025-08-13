<?php
include_once 'funcbase.php';

if (!isset($_REQUEST["H"]))
{
   CabHTMBas($pm);
   echo "<br><br>";
   echo "<form action=validaMigracao.php method=post>";
   echo "H<input type=text name=H value='' size=100><br>";
   echo "U<input type=text name=U value='' size=100><br>";
   echo "P<input type=password name=P value='' size=100><br>";
   echo "B<input type=password name=B value='' size=100><br>";
   echo "<input type=submit name=processar class='BT'>";
   echo "</form>";
   return true;
}

$lastId = 0;
if (isset($_GET["id"]))
   $lastId = $_GET["id"];
else
{
   unlink("file-compara.txt");
}

$file = fopen("file-compara.txt", "a+");
$aCon = [];
$aCon["H"] = $_REQUEST["H"];
$aCon["U"] = $_REQUEST["U"];
$aCon["P"] = $_REQUEST["P"];
$aCon["B"] = $_REQUEST["B"];
$cons = new ConjReg("", "", $aCon);

$cons->ConsSele("Sequencial, ID", "SisTab", "SisTab.Ativo = 'S' and TipoFisico = 'M' and SisTab.ID <> 'SisPar' and SisTab.Sequencial > $lastId" . "", 
   "SisTab.Sequencial asc limit 10");
//$cons->ImpCons();
$cons->ExeCons();
$aTab = $cons->GetArray(false);

$aDados = [];
if (CountArray($aTab) > 0)
{
   $aTipos = ["float", "double", "decimal", "int", "mediumint", "smallint"];
   foreach ($aTab as $v)
   {
      $tab = $v["ID"];
      $lastId = $v["Sequencial"];
      $cons->ConsGer("show fields from {$tab}");
      $cons->ImpCons();
      $cons->ExeCons(true);
      while ($cons->LeProxReg())
      {
         if ($cons->Campo("Key") == "PRI")
         {
            $aDados[$tab]["PRI"] = $cons->Campo("Field");
         }
         else
         {
            foreach ($aTipos as $tipo)
            {
               if (substr($cons->Campo("Type"), 0, strlen($tipo)) == $tipo)
               {
                  $aDados[$tab]["SUM"][$cons->Campo("Field")] = $cons->Campo("Field");
               }
            }
            reset($aTipos);
         }
      }
      $extras = "";
       if (isset($aDados[$tab]["PRI"]))
         $extras .= ", MAX({$aDados[$tab]["PRI"]}) as MaxID, MIN({$aDados[$tab]["PRI"]}) as MinID";
      if (CountArray($aDados[$tab]["SUM"]) > 0)
      {
         ksort($aDados[$tab]["SUM"]);
         foreach ($aDados[$tab]["SUM"] as $campo)
         {
            $extras .= ", Sum($campo) as Soma{$campo}";
         }
      }
     
      $str = "";
      $cons->ConsSele("count(*) as Qtd $extras", "$tab");
//      $cons->ImpCons();
      $cons->ExeCons(true);
      if ($cons->LeProxReg())
      {
         $str .= "$tab;";
         $d = $cons->ArrRegAtu(false);
         foreach ($d as $key => $val)
         {
            $str .= "$key===$val**";
         }
      }
      fwrite($file, $str . "\n");
   }
   fclose($file);
   echo "Ultimo: $lastId<br>";
   echo ("<script>setTimeout(Sub,0);function Sub(){window.location.href=\"validaMigracao.php?" . 
      "H={$aCon["H"]}&U={$aCon["U"]}&P={$aCon["P"]}&B={$aCon["B"]}&id=$lastId\"}</script>");
}