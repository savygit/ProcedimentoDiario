<?php
include '/../TrixProjeto/Desenvolvimento/funcbase.php';
//programa para gerar projeções de cronograma
//segue os dias do mês ou apenas dias corridos
//parametros:
//qtde de horas por dia
//feriados


$feriados = $tarefas = array();

$titulo = "Implantação Sistema Trix - PCTEC (Full)";
$qtddia = 4;
$mostraQtdHoras = false;
$cronograma = true;

$ini = "2021-07-01";
$feriados["2021-07-09"] = 1;
$feriados["2021-09-07"] = 1;
$feriados["2021-10-12"] = 1;
$feriados["2021-10-22"] = 1;
$feriados["2021-11-02"] = 1;
$feriados["2021-11-15"] = 1;

$tarefas['10'] = array('Liberação do sistema e Módulo Cadastros/Recursos Humanos', 20, 8, 'N');
$tarefas['20'] = array('Liberação do Módulo Financeiro (Pagar e Receber)', 14, 3, 'N');
$tarefas['30'] = array('Treinamento Módulo Financeiro (Pagar e Receber)', 6, 'S');
$tarefas['40'] = array('Liberação do Módulo Compras/Estoque', 14, 3, 'S');
$tarefas['50'] = array('Treinamento Módulo Compras', 8, 'S');
$tarefas['60'] = array('Treinamento Módulo Estoque', 2, 'S');
$tarefas['70'] = array('Liberação do Módulo NFe', 26, 'S');
$tarefas['80'] = array('Treinamento NFe', 3, 'S');

$tarefas['90'] = array('Definições sobre Módulo Contrato', 13, 'S');
$tarefas['100'] = array('Liberação do Módulo Contrato', 52, 'S');
$tarefas['110'] = array('Treinamento Módulo Contrato', 6, 'S');
$tarefas['120'] = array('Definições sobre Módulo Faturamento', 7, 8, 'S');
$tarefas['130'] = array('Liberação do Módulo Faturamento', 39, 'S');
$tarefas['140'] = array('Treinamento Módulo Faturamento', 3, 'S');
$tarefas['150'] = array('Liberação do Módulo NFS (São Paulo e Campinas)', 78, 'S');
$tarefas['160'] = array('Treinamento Módulo NFS', 2, 'S');
$tarefas['170'] = array('Liberação do Módulo Controle de ativos', 26, 'S');
$tarefas['180'] = array('Treinamento Módulo Controle de ativos', 4, 'S');

$arr_dias = array();
$dias = array();
$mes = array();
$cores = array(0 => "#859CA4", 1 => "#FFFFFF", 2 => "#DCF0BA", 6 => "#DCDCDC");
$dcor = array(0 => "#E92922", 1 => "#000000", 2 => "#E92922", 6 => "#363636");

$fim = $ini;
$qdia = $qtddia;
while (list($codtar, $dados) = each($tarefas))
{
   $qtdtar = $dados[1];
   // vem da configuração da tarefa. se tem que fazer em outro dia
   $pular_dia = ($dados[2] == "S");
   $agenda = true;
   while ($agenda)
   {
      // exemplo de pular dia quando tem sobra muito pouco tempo no dia. MAÕ NÃO UTILIZADO
      // $pular_dia = false;
      // if (($qtdtar >= $qdia) && ($qdia <= 0.3))
      // 	$pular_dia = true;

      $m = AnoM($fim) . "-" . sprintf("%02s", MesM($fim)) . "";
      if (!$pular_dia)
         $arr_dias[$m][$codtar][$fim] = array(1, ($qtdtar > $qdia ? $qdia : $qtdtar));
      $mes[$m] = StrMesInf(MesM($fim)) . "/" . AnoM($fim);
      $dias[$m][$fim] = 1;
      if ($qtdtar >= $qdia)
      {
         $diautil = false;
         while (!$diautil)
         {
            $fim = date("Y-m-d", strtotime($fim . " +1 days"));
            $m = Ano(MToB($fim)) . "-" . sprintf("%02s", Mes(MToB($fim))) . "";
            $mes[$m] = StrMesInf(MesM($fim)) . "/" . AnoM($fim);
            $diasem = DiaSem($fim);
            if (($diasem != 6) && ($diasem != 0) && (!isset($feriados[$fim])))
            {
               $diautil = true;
               $dias[$m][$fim] = 1;
            }
            else
            {
               if (isset($feriados[$fim]))
               {
                  $dias[$m][$fim] = 2;
               }
               else
                  $dias[$m][$fim] = $diasem;
            }
         }
         if (!$pular_dia)
            $qtdtar = $qtdtar - $qdia;
         else
            $pular_dia = false;
         $qdia = $qtddia;
      }
      else
      {
         $qdia = $qdia - $qtdtar;
         if (!$pular_dia)
            $agenda = false;
      }
   }
}


reset($tarefas);
ksort($mes);
?>
<style>
    table {border-collapse: collapse;border:1px solid #cdcdcd;font-family:Tahoma;font-size:9pt}
    td {border:1px solid #cdcdcd; height: 20px}
    .main {font-family:Tahoma;}
    .titu {font-size:14pt;font-weight:bold; margin-top:10px; margin-bottom:5px}
    .mes-ano {font-size:12pt;font-weight:bold; margin-top:10px}
</style>
<?php
echo "<div class='main'>";
echo "<div class='titu'>$titulo</div>";

if ($cronograma)
{
   while (list($m, $nomemes) = each($mes))
   {
      $largDia = 25;
      $largTar = 50;
      $largDesc = 350;
      $tamanhoTab = (sizeof($dias[$m]) * $largDia) + $largTar + $largDesc;


      echo "<div class='mes-ano'>$nomemes</div>";
      echo ("<table style='{$tamanhoTab}px'>");
      echo ("<tr>");
      echo ("<td width={$largTar}px>&nbsp</td><td width={$largDesc}px>&nbsp</td>");
      while (list($d, $v) = each($dias[$m]))
      {
         echo ("<td align=center style='color:" . $dcor[$v] . ";width:{$largDia}px'>" . Dia(MToB($d)) . "</td>");
      }
      echo ("</tr>");
      echo ("<tr>");
      reset($dias[$m]);
      echo ("<td>#</td><td>Tarefa</td>");
      while (list($d, $v) = each($dias[$m]))
      {
         echo ("<td align=center style='color:" . $dcor[$v] . "'>" . substr(StrDiaSemI(DiaSem($d)), 0, 1) . "</td>");
      }

      while (list($codtar, $dados) = each($arr_dias[$m]))
      {
         echo ("<tr>");
         echo ("<td align=center>$codtar</td><td style='font-size:8pt' align=left>" . $tarefas[$codtar][0] . "</td>");
         reset($dias[$m]);
         while (list($d, $v) = each($dias[$m]))
         {
            if ($dados[$d][0] == 1)
               $cor = "#19697D";
            else
               $cor = $cores[$v];
            echo ("<td bgcolor='$cor' style='text-align:center; font-size:7pt;'>" .
            ($dados[$d][1] != "" && $mostraQtdHoras ? FormataNumDecVar($dados[$d][1], 0, 1) : "") . "</td>");
         }
         echo ("</tr>");
      }
      echo ("</table>");
   }

   echo ("<br>Legenda<table style='border-collapse: collapse;border:1px solid #000;font-family:Arial;font-size:9pt;width:20%'>");
   echo ("<tr>");
   echo ("<td bgcolor=#19697D width=20%>&nbsp;</td>");
   echo ("<td width=80%>Dia trabalhado</td>");
   echo ("</tr>");
   echo ("<tr>");
   echo ("<td bgcolor=$cores[0] width=20%>&nbsp;</td>");
   echo ("<td width=80%>Domingo</td>");
   echo ("</tr>");
   echo ("<tr>");
   echo ("<td bgcolor=$cores[2] width=20%>&nbsp;</td>");
   echo ("<td width=80%>Feriado/Ponte</td>");
   echo ("</tr>");
   echo ("<tr>");
   echo ("<td bgcolor=$cores[6] width=20%>&nbsp;</td>");
   echo ("<td width=80%>Sábado</td>");
   echo ("</tr>");
   echo ("<tr>");
   echo ("</table>");
   
}
else
{
   echo ("<table style='500px'>");
   echo ("<tr>");
   echo ("<td>#</td><td>Tarefa</td><td>Data Início</td><td>Data Final</td>");
   echo ("</tr>");
   while (list($m, $nomemes) = each($mes))
   {
      while (list($codtar, $dados) = each($arr_dias[$m]))
      {
         list($dataini, $xx) = each($dados);
         reset($dados);
         krsort($dados);
         list($datafim, $xx) = each($dados);
         reset($dados);
         
         echo ("<tr>");
         echo ("<td>$codtar</td><td>{$tarefas[$codtar][0]}</td><td>" . MToB($dataini) . "</td><td>" . MToB($datafim) . "</td>");
         echo ("</tr>");
      }
   }
   echo ("</table>");
}

echo "</div>";
?>