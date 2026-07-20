<?php
include_once 'funcbase.php';
$bd = "bdfixx";
$bdDest = "bddoccar";
$pm = "";
for ($i = 0; $i <= bd; $i++)
  $pm .= ":";
SetPar($pm, bd, $bd);

CabHTMBas($pm);
echo "<br><br>";
echo "<form action=opc.php method=post target='_self'>";
echo "<input type=text name=codfunc value='' size=10>";
echo "<input type=submit name=processar>";
echo "</form>";


if (isset($_REQUEST["codfunc"]))
{
  $pm = "";
  for ($i = 0; $i <= bd; $i++)
     $pm .= ":";
  SetPar($pm, bd, $bd);
  //caminho da funcionalidade
  echo "<input type=text id=caminho value=\"" . caminhoFunc($pm, new ConjReg($bd), $_REQUEST["codfunc"]) . "\" size=150 class='CE'></input>";
  
  //copiar liberações da funcionalidade para o perfil
   $que = ExportaRegistroTabela($pm, new ConjReg($bd), "PeUsLi", "CodFun = " . $_REQUEST["codfunc"]. " and CodPerfil = 1", [], true, 
    ["CodPerfil" => "##PERFIL##"]);

  
  $consDest = new ConjReg($bdDest);
  $str = "";
  foreach ([1,2,4] as $codPerfil)
  {
      $consDest->ConsGer(str_replace(["##PERFIL##", "insert into "], [$codPerfil, "insert ignore into "], $que));
      $consDest->ExeCons(true);
      $str .= $consDest->ImpCons(true) . "\n";
  }
  echo "<br><br>";
  echo "<textarea name=que rows=10 cols=150 class='CE'>" . $str . "</textarea>";
}
