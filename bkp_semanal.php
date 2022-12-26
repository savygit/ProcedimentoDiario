<?php
echo "<h2>BACKUP AUTOMÁTICO </h2>";
echo "<b> 1 - </b>Acessar no Windows (computador da Giovana) o atalho no Desktop chamado Backup OU Abrir o DOS " .
	"nesse caminho: C:\\xampp\htdocs\Trix\BkFtp<br>";

echo "<b>2 - </b>Executar o seguinte comando: <b>bksemanal soft4241 " . (date("Ymd")) ."  " . (date('m-d-', strtotime('-1 week'))). substr(date('Y'),2,4) ."</b><br>";
echo " &nbsp &nbsp<i>2.1 O comando acima pode ser alterado respeitando o seguinte formato: bksemanal soft4241 DATAATUAL(YYYYMMDD)  DATACORTE(MM-DD-YY) </i>";
echo "<br><br><hr>";
echo "<h3 style ='color:red'>Se NÃO der certo o comando acima faça o procedimento manual: </h3>";
echo "<h2>BACKUP MANUAL </h2>";
echo "<b>Servidor Linux</b><br>";
echo "<b> 1 - </b>Acessar a pasta de fontes do Trix \\\SRVSAVY\Servidor\htdocs\Trix\TrixProjeto <br>";
echo "<b> 2 -  </b>Gerar um .rar do diretório Desenvolvimento + .git chamado de TrixCompletoYYYYMMDD (com senha ...4241) <br>";
echo "<b> 3 -  </b>Mover esse arquivo TrixCompletoYYYYMMDD para \\\SRVSAVY\Servidor\arquivos\Backup\TrixFontes<br><br>";
echo "<b> Windows</b><br>";
echo "<b> 4 -  </b>Acessar: \\\Trixs-pc\d\BACKUP <br>";
echo "<b> 5 -  </b>Copiar os backups dos últimos 7 dias para dentro do diretório G:\BKP_EMPRESAS E TRIX <br><br>";
echo "<b>Servidor Linux</b><br>";
echo "<b> 6 -  </b>Acessar: \\\SRVSAVY\Servidor\arquivos\Backup\TrixFontes <br>";
echo "<b> 7 -  </b>Copiar os últimos backups desde o último TrixCompleto inclusive o de hoje para o diretório G:\BKP_EMPRESAS E TRIX <br>";
echo "<b> 8 -  </b>Excluir arquivos mais antigos do diretório G:\BKP_EMPRESAS E TRIX <br> <br>";
echo "<b>HD Externo</b><br>";
echo "<b>9 -  </b> Acessar G:\DOCUMENTOS\Clientes <br> ";
echo "<b>10 -  </b> Apagar a pasta <u>AtivosTemp</u> <br>";
echo "<b>11 -  </b> Renomear a parta <u>Ativos</u> para <u>AtivosTemp</u> <br>";
echo "<b>11 -  </b> Acessar a pasta \\\Trixs-pc\d\Savy Soluções Documentos\Clientes <br>";
echo "<b>11 -  </b> Copiar a pasta <u>Ativos</u> para G:\DOCUMENTOS\Clientes";
echo "<br><br><hr>";
echo "<h2> BACKUP E-MAIL</h2>";
echo "<b><i>O procedimento abaixo deve ser realizado na última sexta-feira da cada mês</i></b><br>";
echo "<b>1 - </b>Criar um .rar da conta com o nome no formato Outlook_PC_SEUNOME_YYYYMMDD e senha ...4241 <br>";
echo "<b>2 -  </b>Copiar o .rar para o HD externo na pasta G:\OUTLOOK <br>";
echo "<b>3 - </b> Quando todos finalizarem o backup do HD, os arquivos deverão ser salvos no computador da Giovana, na pasta \\\Trixs-pc\d\BKP Outlook <br>";
echo "<b>2 -  </b>Excluir aquivos mais antigos do HD ";
echo "<br><br><hr>";
echo "<h2> BACKUP DVD</h2>";
echo "<b><i>O procedimento abaixo deve ser realizado com frequência</i></b><br>";

echo "<b>1 - </b>Acessar \\\Trixs-pc\d\BACKUP<br>";
echo "<b>2 - </b>O DVD deve ser identificado como '<i><b>Banco de dados - Dedd/mm/yyyy A dd/mm/yyyy</b></i>'<br>";
 echo "<b>3 -  </b>No programa CDBurnerXP, adicionar os arquivos BK_YYYYMMDD.rar para gravação. <br>";
echo "<b>4 - </b>Utilizando o CDBurnerXP grave na velocidade 8x<br>";
echo "<b> Após a gravação dos arquivos BK_YYYYMMDD.rar:</b><br>";
echo "<b>1 - </b>Acessar \\\SRVSAVY\Servidor\arquivos\Backup\TrixFontes<Br>";
echo "<b>2 - </b>O DVD deve ser identificado como '<i><b>Trix Completo - De dd/mm/yyyy A dd/mm/yyyy</b></i>'<br>";
echo "<b>3 - </b>Adicione e grave os arquivos TrixYYYYMMDD.zip e TrixCompletoYYYYMMDD.rar em velocidade 8x<br><br>";
?>