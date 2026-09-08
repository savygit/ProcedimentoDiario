<?php
// ESSE PROGRAMA DEVE SER ATUALIZADO DIRETAMENTE NA PASTA DA EMPRESA E ACESSADO PELA URL + inutilizarNF_NFe.php
// ATENÇÃO PARA EMPRESAS QUE POSSUEM MAIS DE UMA FILIAL, ELE ESTÁ INUTILIZANDO PARA CNPJ DO CONFIG.PHP
if (!isset($_REQUEST["ano"]))
	die("Você deve preencher o ano (ano=) e deve ser apenas os dois últimos dígitos");
elseif (strlen($_REQUEST["ano"]) != 2)
	die("Ano deve ter apenas 2 dígitos");
	
if (!isset($_REQUEST["serie"]))
	die("Série deve ser prenchida (serie=0)");
	
if (!isset($_REQUEST["nf"]))
	die("Número da nf deve ser preenchido (nf=9999)");
	
include_once('./NFePHP/libs/NFe/ToolsNFePHP.class.php');

$nAno = $_REQUEST["ano"]; //preencher
$nSerie = $_REQUEST["serie"];
$nIni = $nFin = $_REQUEST["nf"]; //preencher

//preencher
$xJust = ("O software de emissao pulou a numeracao {$_REQUEST["nf"]}. Esse numero nao sera mais utilizado");
$aRetorno = array();

echo ("Ano: $nAno &emsp; Série: $nSerie &emsp; Número NF: $nFin<br>");
echo ("&emsp;&emsp;Justificativa: $xJust<br>");

$tpAmb = 1; // 1: ambiente de produção 0: homologação

$toolsNF = new ToolsNFePHP();
$toolsNF->inutNF($nAno, $nSerie, $nIni, $nFin, $xJust, $toolsNF->tpAmb, $aRetorno);
//echo $toolsNF->errMsg . " -------------------";
//
//echo $toolsNF->soapDebug;
echo "<br>Resultado<br><ul>";
while (list($k, $v) = each($aRetorno))
{
	 echo "<li>$k :: " . utf8_decode($v) . "</li>";
}
echo "</ul>";