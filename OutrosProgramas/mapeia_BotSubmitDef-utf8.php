<?php
//mapeia os programas listados que tem o BotSubmitDef
//grep "BotSubmitDef(" -n -w -rl *  --exclude=\*.sh > ./resultado.log
//grep "BotSubmitDef(" -n -w -rl --text *  --exclude=\*.sh > ./resultado.log
include_once 'funcbase.php';
echo CabecHTMLDefault($pm);
if (isset($_REQUEST["ip"]))
   $ip = $_REQUEST["ip"];
else
   $ip = 0;
$aProg = listaProgramas();

if (!isset($aProg[$ip]))
   die("acabou os programas");

echo "<div class='pd-10'>";

$nomeProg = $aProg[$ip];
echo "<h4>$ip) $nomeProg - total de " . sizeof($aProg) . "</h4>";
$handle = fopen($nomeProg, "r");
$novoArquivo = "";
while (!feof($handle))
{
   $achou = false;
   $linha = fgets($handle);
//   $texto = str_replace(array(" ", "\\t", "\\n", "\\r"), "", trim($linha));
   $pos = strpos($linha, "BotSubmitDef(");

//   echo "$pos:($linha)<br>";

   $novaLinha = $linha;
   if (!$pos === false)
   {
      $l = $pos + strlen("BotSubmitDef(");
//      //percorre até encontrar o fecha de um parenteses
      $fim = strlen("BotSubmitDef(");
      for (; $l <= strlen($linha); $l++)
      {
         $fim++;
         if ($linha[$l] == "(")
         {
            break;
         }
         if ($linha[$l] == ")")
         {
            $achou = true;
            break;
         }
      }

      if ($achou)
      {
         $trecho = substr($linha, $pos, $fim);
         $novoTrecho = str_replace("BotSubmitDef", "BotaoSubmitTipo", $trecho);
         $partes = explode(",", $novoTrecho);
         $qtd = sizeof($partes);

         $title = $alterar = "";
         if (isset($partes[3]))
         {
            $title = $partes[3];
            $title = str_replace(["\"", ")", ","], "", trim($title));
         }

         $novoTrecho = $partes[0] . "," . $partes[1] . "," . str_replace(")", "", $partes[2]);
         if ($qtd == 3)
         {
            //não faz nada
         }
         elseif ($qtd == 4)
         {
            //4o parametro é o title, então inverte e encaixa apenas um []
            if ($title != "")
            {
               $alterar .= "[]";
            }
         }
         elseif ($qtd == 5)
         {
            $alterar = $partes[4];
            $alterar = str_replace([" ", "\"", ")", ","], "", $alterar);
            if ($alterar == "BT_Verde")
            {
               $alterar = "[\"tipoBotao\" => \"BotaoVerde\"]";
            }
            elseif ($alterar == "BT_Cinza")
            {
               $alterar = "[\"tipoBotao\" => \"BotaoCinza\"]";
            }
            elseif ($alterar == "BT_Azul")
            {
               $alterar = "[\"tipoBotao\" => \"BotaoAzul\"]";
            }
            elseif ($alterar == "BT_Vermelho")
            {
               $alterar = "[\"tipoBotao\" => \"BotaoVermelho\"]";
            }
            elseif ($alterar == "BT_Laranja")
            {
               $alterar = "[\"tipoBotao\" => \"BotaoAmarelo\"]";
            }
            else
            {
               $achou = false;
            }
         }

         $conteudo = "Trecho Ori: $trecho";
         $conteudo .= " ||||| Trecho Des: $novoTrecho";
         $conteudo .= "\n\nLINHA: $linha";
         if ($achou)
         {
            //5o parametro é o title, inverte com a mudança do botão
            if ($alterar != "")
            {
               $novoTrecho .= ", $alterar";
            }
            if ($title != "")
            {
               $novoTrecho .= ", \"$title\"";
            }
            $novoTrecho .= ")";

            $conteudo .= "\n--------------------------------\nNOVA: " . str_replace($trecho, $novoTrecho, $linha);

            echo "<textarea class='CE' cols=100 rows=10>$conteudo</textarea>";
            $novaLinha = str_replace($trecho, $novoTrecho, $linha);
            MessImgSVoltar("Vai substituir as linhas do programa", MESSSUCE);
         }
         else
         {
            echo "<textarea class='CE' cols=100 rows=10>$conteudo</textarea>";
            echo "<div style='color:red'>Encontrou a função mas não conseguiu mapear a troca</div>";
         }
      }
      else
      {
         $conteudo .= "\n\nLINHA: $linha";
         echo "<textarea class='CE' cols=100 rows=10>$conteudo</textarea>";
         echo "<div style='color:red'>Não encontrou para fechar a função</div>";
      }
   }
   $novoArquivo .= $novaLinha;
}
fclose($handle);
echo "<form action=mapeia.php method=post name=frmSIST>";

if (!isset($_REQUEST["Processar"]))
   echo BotaoSubmitTipo("Processar", "Processar", "proc", ["tipoBotao" => "BotaoVerde"]);
else
{
   file_put_contents($nomeProg, $novoArquivo);
   $ip++;
   echo BotaoSubmitTipo("Continuar", "Continuar", "proc", ["tipoBotao" => "BotaoAzul"]);

   MessImgSVoltar("Arquivo atualizado", MESSSUCE);
   ini_set('display_errors', 1);
   error_reporting(E_ALL);
   include_once "$nomeProg";
}

echo "<input type=hidden name=ip value='$ip'>";
echo "</form>";

echo "</div>";
function listaProgramas()
{
//$prog[] = 'CFGPAjConf.php';
//$prog[] = 'CFGPCoCaFu.php';
//$prog[] = 'CFGPExcFun.php';
//$prog[] = 'CFGPImpCer.php';
//$prog[] = 'CFGPLgnUni.php';
//$prog[] = 'CFGPRelFun.php';
//$prog[] = 'CFRIFicFra.php';
//$prog[] = 'COMPGerPed.php';
//$prog[] = 'CTePEmMDFe.php';
//$prog[] = 'DEVIDaDeDe.php';
//$prog[] = 'DEVIItNfDe.php';
//$prog[] = 'DEVPDecFin.php';
//$prog[] = 'DEVPEnvEma.php';
//$prog[] = 'DEVPExcFin.php';
//$prog[] = 'DEVPGePeDe.php';
//$prog[] = 'DISPSucItm.php';
//$prog[] = 'EFDPPrNFFo.php';
//$prog[] = 'EMAPEnvEma.php';
//$prog[] = 'ENGPAnRqAl.php';
//$prog[] = 'ENGPCaRqAl.php';
//$prog[] = 'ENGPExItCx.php';
//$prog[] = 'ESCIEtqDip.php';
//$prog[] = 'ESCILsPeRP.php';
//$prog[] = 'ESCIModCur.php';
//$prog[] = 'ESCPAlBaAl.php';
//$prog[] = 'ESCPAlPfTu.php';
//$prog[] = 'ESCPAtSuUn.php';
//$prog[] = 'ESCPCoPrEs.php';
//$prog[] = 'ESCPDelSPr.php';
//$prog[] = 'ESCPDesMod.php';
//$prog[] = 'ESCPExPend.php';
//$prog[] = 'ESCPExcRep.php';
//$prog[] = 'ESCPHisPro.php';
//$prog[] = 'ESCPRenCon.php';
//$prog[] = 'ESTIEtqEst.php';
//$prog[] = 'ESTIVeSiEs.php';
//$prog[] = 'FIMIProFin.php';
//$prog[] = 'FINPIncRet.php';
//$prog[] = 'FIPPAltVen.php';
//$prog[] = 'FISIItmSuc.php';
//$prog[] = 'FISINfCfop.php';
//$prog[] = 'FISISitNfi.php';
//$prog[] = 'FISPAlQtdN.php';
//$prog[] = 'FISPNumero.php';
//$prog[] = 'FISPPreNFE.php';
//$prog[] = 'FISPUnTrEx.php';
//$prog[] = 'FPrPAlCoMo.php';
//$prog[] = 'FPrPEsRePa.php';
//$prog[] = 'FPrPRenPar.php';
//$prog[] = 'FPrPRtCREx.php';
//$prog[] = 'HLPPAbHDEx.php';
//$prog[] = 'ITMIExcItem.php';
//$prog[] = 'ITMPAlInRe.php';
//$prog[] = 'ITMPCrPrCl.php';
//$prog[] = 'ITMPRenReg.php';
//$prog[] = 'K_tratareg.php';
//$prog[] = 'LGPPEnvTer.php';
//$prog[] = 'LOGPInPLPN.php';
//$prog[] = 'MAMICerTra.php';
//$prog[] = 'MAMIReCoCi.php';
//$prog[] = 'MAMIReCoFa.php';
//$prog[] = 'MAMPAlDtCl.php';
//$prog[] = 'MAMPBaiTic.php';
//$prog[] = 'MAMPCoRoCo.php';
//$prog[] = 'MAMPEstEnv.php';
//$prog[] = 'MAMPImArBa.php';
//$prog[] = 'MAMPInReMa.php';
//$prog[] = 'MAMPPreInt.php';
//$prog[] = 'MAMPPtoRot.php';
//$prog[] = 'MAMPSusCPS.php';
//$prog[] = 'MAMPValImp.php';
//$prog[] = 'MAmIManCar.php';
//$prog[] = 'MAmPGeFaBo.php';
//$prog[] = 'MAmPGeFaCo.php';
//$prog[] = 'MAmPPrCoMa.php';
//$prog[] = 'MAmPPrTrCo.php';
//$prog[] = 'NFSPLiLRPS.php';
//$prog[] = 'NFSPNfsMas.php';
//$prog[] = 'NFeCanNFe.php';
//$prog[] = 'NFePEmiNFe.php';
//$prog[] = 'NFePFinXML.php';
//$prog[] = 'NFePRBasNf.php';
//$prog[] = 'POSIGeLsNF.php';
//$prog[] = 'POSILsClVe.php';
//$prog[] = 'PROPEstApo.php';
//$prog[] = 'PROPExPrPr.php';
//$prog[] = 'PROPLsInAp.php';
//$prog[] = 'PROPPrRePr.php';
//$prog[] = 'QUAPInHeDe.php';
//$prog[] = 'QUEPCanQue.php';
//$prog[] = 'RHUPApPrTr.php';
//$prog[] = 'RHUPConGer.php';
//$prog[] = 'RHUPFeVaAd.php';
//$prog[] = 'RHUPHorFun.php';
//$prog[] = 'SMSPEnvCli.php';
//$prog[] = 'SRVPOrcSer.php';
//$prog[] = 'TRAPReCTRC.php';
//$prog[] = 'TRMPAPArCo.php';
//$prog[] = 'TRMPEnPgCi.php';
//$prog[] = 'TRMPGeCaSe.php';
//$prog[] = 'TRMPLiNFCT.php';
//$prog[] = 'TRMPZerVCa.php';
//$prog[] = 'USUPBloqUs.php';
//$prog[] = 'USUPTrLogi.php';
//$prog[] = 'UTLIDaCoTr.php';
//$prog[] = 'UTLILsReAl.php';
//$prog[] = 'UTLPAlReBd.php';
//$prog[] = 'UTLPExcCas.php';
//$prog[] = 'UTLPExeQue.php';
//$prog[] = 'UTLPExpCad.php';
//$prog[] = 'VENPCopVen.php';
//$prog[] = 'VENPExGrPo.php';
//$prog[] = 'VENPPedVen.php';
//$prog[] = 'VENPTroMat.php';
//$prog[] = 'WoFAVenCur.php';
//$prog[] = 'WoFPTraAti.php';
//$prog[] = 'WoFPVenCur.php';
//$prog[] = 'XMLPImXMLEm.php';
//$prog[] = 'XMLPImXMLS.php';
//$prog[] = 'XMLPImpIrr.php';
//$prog[] = 'XMLPXMLPre.php';
//$prog[] = 'clsInput.php';
//$prog[] = 'funcDEV0.php';
//$prog[] = 'funcESC10.php';
//$prog[] = 'funcNFe0.php';
//$prog[] = 'funcRRe0.php';
//$prog[] = 'funcSRV0.php';
//$prog[] = 'funcbas1.php';
$prog[] = 'mapeia.php';
$prog[] = 'portaldoaluno.php';


   return $prog;
}
