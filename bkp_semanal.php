<?php
echo "<h2>BACKUP AUTOM�TICO </h2>";
echo "<b> 1 - </b>Acessar no Windows (computador da Giovana) o atalho no Desktop chamado Backup OU Abrir o DOS " .
	"nesse caminho: C:\\xampp\htdocs\Trix\BkFtp<br>";

echo "<b>2 - </b>Executar o seguinte comando: <b>bksemanal soft4241 " . (date("Ymd")) ."  " . (date('m-d-', strtotime('-1 week'))). substr(date('Y'),2,4) ."</b><br>";
echo " &nbsp &nbsp<i>2.1 O comando acima pode ser alterado respeitando o seguinte formato: bksemanal soft4241 DATAATUAL(YYYYMMDD)  DATACORTE(MM-DD-YY) </i>";
echo "<br><br><hr>";
echo "<h3 style ='color:red'>Se N�O der certo o comando acima fa�a o procedimento manual: </h3>";
echo "<h2>BACKUP MANUAL </h2>";
echo "<b>Servidor Linux</b><br>";
echo "<b> 1 - </b>Acessar a pasta de fontes do Trix \\\SRVSAVY\Servidor\htdocs\Trix\TrixProjeto <br>";
echo "<b> 2 -  </b>Gerar um .rar do diret�rio Desenvolvimento + .git chamado de TrixCompletoYYYYMMDD (com senha ...4241) <br>";
echo "<b> 3 -  </b>Mover esse arquivo TrixCompletoYYYYMMDD para \\\SRVSAVY\Servidor\arquivos\Backup\TrixFontes<br><br>";
echo "<b> Windows</b><br>";
echo "<b> 4 -  </b>Acessar: \\\Trixs-pc\d\BACKUP <br>";
echo "<b> 5 -  </b>Copiar os backups dos �ltimos 7 dias para dentro do diret�rio G:\BKP_EMPRESAS E TRIX <br><br>";
echo "<b>Servidor Linux</b><br>";
echo "<b> 6 -  </b>Acessar: \\\SRVSAVY\Servidor\arquivos\Backup\TrixFontes <br>";
echo "<b> 7 -  </b>Copiar os �ltimos backups desde o �ltimo TrixCompleto inclusive o de hoje para o diret�rio G:\BKP_EMPRESAS E TRIX <br>";
echo "<b> 8 -  </b>Excluir arquivos mais antigos do diret�rio G:\BKP_EMPRESAS E TRIX <br> <br>";
echo "<b>HD Externo</b><br>";
echo "<b>9 -  </b> Acessar G:\DOCUMENTOS\Clientes <br> ";
echo "<b>10 -  </b> Apagar a pasta <u>AtivosTemp</u> <br>";
echo "<b>11 -  </b> Renomear a parta <u>Ativos</u> para <u>AtivosTemp</u> <br>";
echo "<b>11 -  </b> Acessar a pasta \\\Trixs-pc\d\Savy Solu��es Documentos\Clientes <br>";
echo "<b>11 -  </b> Copiar a pasta <u>Ativos</u> para G:\DOCUMENTOS\Clientes";
echo "<br><br><hr>";
echo "<h2> BACKUP E-MAIL</h2>";
echo "<b><i>O procedimento abaixo deve ser realizado na �ltima sexta-feira da cada m�s</i></b><br>";
echo "<b>1 - </b>Criar um .rar da conta com o nome no formato Outlook_PC_SEUNOME_YYYYMMDD e senha ...4241 <br>";
echo "<b>2 -  </b>Copiar o .rar para o HD externo na pasta G:\OUTLOOK <br>";
echo "<b>3 - </b> Quando todos finalizarem o backup do HD, os arquivos dever�o ser salvos no computador da Giovana, na pasta \\\Trixs-pc\d\BKP Outlook <br>";
echo "<b>2 -  </b>Excluir aquivos mais antigos do HD ";
echo "<br><br><hr>";
echo "<h2> BACKUP DVD</h2>";
echo "<b><i>O procedimento abaixo deve ser realizado com frequ�ncia</i></b><br>";

echo "<b>1 - </b>Acessar \\\Trixs-pc\d\BACKUP<br>";
echo "<b>2 - </b>O DVD deve ser identificado como '<i><b>Banco de dados - Dedd/mm/yyyy A dd/mm/yyyy</b></i>'<br>";
 echo "<b>3 -  </b>No programa CDBurnerXP, adicionar os arquivos BK_YYYYMMDD.rar para grava��o. <br>";
echo "<b>4 - </b>Utilizando o CDBurnerXP grave na velocidade 8x<br>";
echo "<b> Ap�s a grava��o dos arquivos BK_YYYYMMDD.rar:</b><br>";
echo "<b>1 - </b>Acessar \\\SRVSAVY\Servidor\arquivos\Backup\TrixFontes<Br>";
echo "<b>2 - </b>O DVD deve ser identificado como '<i><b>Trix Completo - De dd/mm/yyyy A dd/mm/yyyy</b></i>'<br>";
echo "<b>3 - </b>Adicione e grave os arquivos TrixYYYYMMDD.zip e TrixCompletoYYYYMMDD.rar em velocidade 8x<br><br>";
?>