<?php

//ESSE PROGRAMA FOI CRIADO EM 06/08/2011 E VAI BUSCAR O ULTIMO ARQUIVO PROCESSADO NO SISTEMA DA SIGBOL MATRIZ
//REFERENTE A QUITAÇÃO DE BOLETOS
//POR PADRÃO BUSCARÁ O ULTIMO ARQUIVO PROCESSADO, OU SEJA DA DATA ATUAL
//SENÃO PODERÁ RECEBER OS PARAMETROS:
//$LAY= LAYOUT QUE PODE SER 10 OU 11
//$DT = DATA NO FORMATO YYYY-MM-DD
//$bd = banco de dados
include_once ("funcbase.php");

if (isset($_REQUEST["Consultar"]))
{
	if ($_REQUEST["bd"] == "")
	{
		MessImgSVoltar("Banco é obrigatório", MESSERRO);		
	}
	elseif ($_REQUEST["lay"] == "")
	{
		MessImgSVoltar("layout é obrigatório", MESSERRO);
	}
	elseif ($_REQUEST["data"] == "")
	{
		MessImgSVoltar("Data é obrigatória", MESSERRO);
	}
	else	
	 	GeraArqQuitSigbol($_REQUEST["bd"], $_REQUEST["lay"], $_REQUEST["data"]);
}
else
{
	echo "<h1> Download de arquivos processos pelo EDI </h1>";
	echo ("<form method='post' action='ArqQuit.php' enctype='multipart/form-data'>");
	echo ("Banco: <input type=text name=bd value='' size=15 placeholder='dbname'>\n<br><br>");
	echo ("Layout: <input type=text name=lay value='' size=15 placeholder='código do layout'>\n<br><br>");
	echo ("Data processamento: <input type=text name=data value='' size=15 placeholder='YYYY-MM-DD'>\n<br><br>");
	echo ("<br><br><input type=submit name=Consultar value='Consultar'>");
	echo ("</form>");
}

function GeraArqQuitSigbol($bd, $lay, $data)
{
   $arq = new ConjReg($bd);
   if ($lay == "")
      $lay = 10;
   if ($data == "")
      $data = BToM(DataAtual());
   
   $arq->ConsSele("ar.NomeTXT, ar.LayOutEDI, lin.Linha", "ArqEDI as ar, IntEDI as lin", 
   	"lin.IDArquivo = ar.ID and ar.LayOutEDI = '$lay' and Date(ar.Tempo) = '$data'", "", "lin.NumLinha asc");
   $arq->ExeCons(true);
//   $arq->ImpCons();
//   die();
   if ($arq->TotReg() > 0)
   {
      $nome = "";
      while ($arq->LeProxReg())
      {
         if ($nome == "")
         {
            $nome = 1;
            header("Content-disposition:attachment; filename=" . $arq->Campo("NomeTXT"));
            header("Content-type: application/octetstream");
            header("Pragma: no-cache");
            header("Expires: 0");
         }
         echo str_replace("\n", "", $arq->Campo("Linha")) . "\n";
      }
   }
   else
   {
       echo "Não tem registros";
   }
}
?>