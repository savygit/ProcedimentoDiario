<?php
include_once "funcbase.php";
$bd = "";
CabHTMBas($pm);
echo "<br><br>";
echo "<form action=substituir.php method=post target=_self>";
echo "<div class='pd-5'>BD <input type=text name=bd value='' size=20></div>";
echo "<div class='pd-5'>Nome Tabela <input type=text name=tabela value='' size=20></div>";
echo "<div class='pd-5'>Nome Campo <input type=text name=campo value='' size=30></div>";
echo "<div class='pd-5'>Texto De <input type=text name=textode value='' size=30></div>";
echo "<div class='pd-5'>Texto Para <input type=text name=textopara value='' size=30></div>";
echo "<div class='pd-5'><input type=submit name=processar class='BT' value='Buscar'></div";

if (isset($_REQUEST["bd"]))
{
   $campo = $_REQUEST["campo"];
   $tabela = $_REQUEST["tabela"];
   $textode = $_REQUEST["textode"];
   $textopara = $_REQUEST["textopara"];
   $bd = $_REQUEST["bd"];
   $cons = new ConjReg($bd);
}

if (isset($_REQUEST["processar"]))
{

   $pm = "";
   for ($i = 0; $i <= bd; $i++)
      $pm .= ":";
   SetPar($pm, bd, $bd);

   $cons->ConsSele("*", $tabela, "$campo like '%$textode%'");
   $cons->ExeCons(true);
   if ($cons->TotReg() > 0)
   {
      $aDados = $cons->GetArray(false);

      $campoKey = "";
      $cons->ConsGer("show fields from {$tabela}");
      $cons->ExeCons();
      while ($cons->LeProxReg())
      {
         if ($cons->Campo("Key") == "PRI")
         {
            $campoKey = $cons->Campo("Field");
            break;
         }
      }

      if ($campoKey == "")
         die("Campo chave primaria não encontrado");


      $aIDs = [];
      foreach ($aDados as $i => $val)
      {
         $idCampo = $val["$campoKey"];
         $valor = $val["$campo"];

         $aIDs[$idCampo] = $idCampo;
         echo "<br><br><br><b>Lendo o $idCampo : $campo</b><br><br>";
         $posicoes = [];
         $texto = strtolower($valor); // Converte o texto para minúsculas
         $palavra = strtolower($textode); // Converte a palavra para minúsculas
         $posicao = strpos($texto, $palavra); // Encontra a primeira ocorrência

         while ($posicao !== false)
         {
            $posicoes[] = $posicao; // Adiciona a posição ao array
            $posicao = strpos($texto, $palavra, $posicao + 1); // Encontra a próxima ocorrência
         }

         foreach ($posicoes as $pos)
         {
//           echo "<br>$valor : $pos<br><br>";
            echo "<hr>";
            $trecho = substr($valor, $pos - 15, 30);
            echo "<b>Trecho Original</b>: $trecho<br>";
            echo "<br>";
            echo "<b style='color:blue'>Trecho Alterado</b>: " . str_ireplace($palavra, "<b>$textopara</b>", $trecho) . "<br>";
         }

         echo "<br><input type='checkbox' name=conf[$idCampo]> Conferido?<br>";
         echo "<textarea name=txt[$idCampo] class='CE' cols=70 rows=6>" . str_ireplace($palavra, $textopara, $valor) . "</textarea>";
      }


      $fp = $_REQUEST;
      unset($fp["processar"]);
      foreach ($fp as $k => $v)
      {
         echo "<input type='hidden' name=$k value='$v'>\n";
      }
      echo "<input type='hidden' name=campokey value='$campoKey'>\n";

      echo "<div class='pd-5'><input type=submit name=substituir class='BT' value='Substituir'></div";
      echo "<hr>";
      echo "IDs: " . implode(", ", $aIDs);
   }
}

if (isset($_REQUEST["substituir"]))
{
   echo "<br><br>";
   $fp = $_REQUEST;
   $campoKey = $fp["campokey"];

   $update = "";
   if (isset($fp["conf"]))
   {
      foreach ($fp["conf"] as $idCampo => $val)
      {
         $cons->ConsAtu($tabela, "$campo = '{$fp["txt"][$idCampo]}'", "$campoKey = '$idCampo'");
         $update .= "##$campo: $idCampo\n\n";
         $update .= $cons->ImpCons(true) . ";@\n\n";
      }

      echo "<textarea name= class='CE' cols=120 rows=10>" . $update . "</textarea>";
   }
}

echo "</form>";
