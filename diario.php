<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>PROCEDIMENTOS DIÁRIOS DE BACKUP</title>
</head>
<style>
* {
   box-sizing: border-box;
}
h1, h2, h3, h4, h5, h6 {
   width: 100%;
   margin: 2px 0;
}
li{padding-top:5px; display: block }
ol { counter-reset: item }
li:before { content: counters(item, ".") " "; counter-increment: item }
.click{color:red}
.ini_dia {
   background-color: rgb(247, 242, 224);
   margin: 10px auto;
   padding: 10px 10px;
   display: block;
   box-sizing: border-box;
}
.fim_dia {
   background-color: #E0E6F8;
   margin: 10px auto;
   padding: 10px 10px;
   display: block;
   box-sizing: border-box;
}
.server p {
   padding: 0;
   margin: 0;
}
#feedback_bkp{
   color: red;
}
#comando_confbkp,
#comando_bkp{
   font-weight: bold;
}
</style>
<script type='text/javascript' src='../TrixProjeto/Desenvolvimento/jquery/jquery.js'></script>
<script>
 $(document).ready(function (){
    lecampos_bkp();
 });
function lecampos_bkp()
{
   var comando_bkp = "IniBkp.bat";
   var comando_bkpTor = "IniBkpTor.bat";
   var comando_confbkp = "ConfBKP.bat";
   var feedback_bkp = "";
   
   var datacomp = new Date();
   var month = datacomp.getUTCMonth() + 1;
   var day = datacomp.getUTCDate();
   var year = datacomp.getUTCFullYear();
   var data = year + "" + month.toString().padStart(2, "0") + "" + day.toString().padStart(2, "0");
   
   $("#comando_bkp").html("O Comando só aparece preencher as senhas");
   $("#comando_confbkp").html("O Comando só aparece preencher as senhas");
   
   var comando;
   var complemento = '';
   if($('#ftpsit').val() !== undefined)
      complemento = ' ' + $('#ftpsit').val();
   comando =  comando_bkp + " " + $('#rar').val() + " " + $('#ftpsis').val() + complemento;
   comando_bkp = comando + imgCopy(comando);

   comando = comando_bkpTor + " "  + $('#ftpsis').val();
   comando_bkp += "<br>&emsp;&emsp;" + comando + imgCopy(comando);

   comando_confbkp = comando_confbkp + " " + data + " " + $('#rar').val() + " \"F:\\BKP_EMPRESAS E TRIX\" " + 
      $('#ftpsis').val() + " D";
      
    comando_confbkp += imgCopy(comando_confbkp.replaceAll("\"", "\\\""));
      
   if($('#rar').val().trim() == "" || $('#ftpsis').val().trim() == "") {
      if($('#rar').val().trim() == "")
         feedback_bkp = feedback_bkp + "<li>Falta a senha do RAR</li>";

      if($('#ftpsis').val().trim() == "")
         feedback_bkp = feedback_bkp + "<li>Falta a senha do FTP Sistemas</li>";

      $('#feedback_bkp').css("color", "red");
   }
   if($('#ftpsit').val() !== undefined)
   {
      if($('#ftpsit').val().trim() == "")
         feedback_bkp = feedback_bkp + "<li>Falta indicar que vai baixar o CTe SPModal</li>";
      $('#feedback_bkp').css("color", "red");
   }

   if (feedback_bkp == "")
   {
      feedback_bkp = feedback_bkp + "<li>Pode executar o comando</li>";
      $("#comando_bkp").html(comando_bkp);
      $("#comando_confbkp").html(comando_confbkp);
      $('#feedback_bkp').css("color", "green");
   }
   $('#feedback_bkp').html(feedback_bkp);
}
function lecampos_confbkp()
{
   
}

function imgCopy(txt){
   return "&emsp;<img src='./images/copy.png' style='width:20px;height:20px;cursor:pointer' onClick='copy(\"" + txt + 
           "\")' title='Clique para copiar o comando'>"
}
function copy(txt) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val(txt).select();
  document.execCommand("copy");
  $temp.remove();
}
</script>
<BODY style='font-family:Verdana;font-size:10pt'>
<?php
$hora = date("H") * 1;
$dia = date("N");
$letra_usb = "\"F:\BKP_EMPRESAS E TRIX\"";
$caminho_bkp = "C:\\xampp\htdocs\\Trix\\ProcedimentoDiario\\BkFtp";

//$link_conf = "confbkp.php";
//para quarentena
$link_conf = "./confbkp.php";

echo "<h2>PROCEDIMENTOS DIÁRIOS</H2>";


echo "<div class='ini_dia' id='divini'>";

echo "<hr size='1' style='border:1px dashed black';>";

echo "<br><h4>Backup banco de dados FTP (PC do Responsável)</h4>";
echo "<ol>";
echo "<li>Preencha os campos de senhas:";
//if (date("w") == 1)
//{
   echo "<ol>";
   echo "<li>Senha do arquivo RAR (****4241): <input type='password' id='rar' onblur='lecampos_bkp()'></li>";
   echo "<li>Senha do FTP Sistemas Trix (T***@1**1@1**7): <input type='password' id='ftpsis' onblur='lecampos_bkp()'></li>";
//   echo "<li>Senha do FTP Site Toride: <input type='password' id='ftpsit' onblur='lecampos_bkp()'></li>";
   if (date("w") == 1)
      echo "<li>Indica que vai baixar o bkp CTe SPModal: <input type='text' id='ftpsit' onblur='lecampos_bkp()' value='S' size='3'></li>";
   echo "<b><li>Status comando";
   echo "<ol id='feedback_bkp'>";
   echo "<li>Falta a senha do RAR</li>";
   echo "<li>Falta a senha do FTP Sistemas</li>";
   if (date("w") == 1)
      echo "<li>Falta indicar que vai baixar o CTe SPModal</li>";
   echo "</ol></li></b></ol></li>";

echo "<li> Acessar o Atalho no Desktop chamado Backup OU Abrir o DOS, nesse caminho: C:\Windows\System32\cmd.exe cd $caminho_bkp</li>";
echo "<li> Colar o comando: <span id='comando_bkp'>O Comando só aparece preencher as senhas</span>";
echo "<ol>";
echo "<li> Acessar o link: <a href='$link_conf' target='blank'>CONFERENCIA</a> para conferir os arquivos baixados</li>";
echo "<li> Após finalizar o bkp pelo MS DOS, se não finalizou, completar acessando o FileZilla de cada servidor</li>";
echo "</ol>";
echo "</li>";
echo "<li> O BACKUP da Toride agora é feito via MSDOS, caso não consiga baixar pelas rotinas normais: Acessar o endereço http://177.67.1.194/Trix/Toride/bkdados/ e baixar em $caminho_bkp</li>";
echo "<li> Aguardar todos os downloads finalizarem e plugar o pendrive de bkp no computador</li>";
echo "<li> Acessar o link: <a href='$link_conf' target='blank'>CONFERENCIA</a> e confirmar os valores encontrados</li>";
echo "<li> O último parametro abaixo, indica se tem partição D para envio do backup. A existencia dessa partição faz com que uma copia em rar seja enviada " . 
   "para o caminho {$letra_usb}</li>";

echo "<li> Executar o comando no DOS já aberto em $caminho_bkp: "
   . "<span id='comando_confbkp'>O Comando só aparece preencher as senhas</span></li>";

echo "<li> Após executar as ações do comando acima, haverá uma pergunta no MS-DOS <br>" .
	"<i>D:\BACKUP>rd BK_YYYYMMDD/s BK_YYYYMMDD, Tem certeza (S/N)?</i><br>Digite S + Enter</li>";
echo ("</div>");
echo ("</ol>");
echo "</div>";

function DiaSemana($data)
{
	switch (date("w", strtotime($data)))
	{
	case 0:
		return "Domingo";
		break;
	case 1:
		return "Segunda";
		break;
	case 2:
		return "Terça";
		break;
	case 3:
		return "Quarta";
		break;
	case 4:
		return "Quinta";
		break;
	case 5:
		return "Sexta";
		break;
	case 6:
		return "Sábado";
		break;
	}
}
?>
</BODY>
</html>