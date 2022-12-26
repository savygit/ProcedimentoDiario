</!DOCTYPE html>
<html>
<head>
	<title>Acesso aos procedimentos</title>
   <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <div class="proced">
         <h1 > Procedimentos</h1>
         <ul style="list-style-type: none;">
             <li><a href="./diario.php">Backup diário + inicialização e finalização do servidor</a></li>

             <li><b>DESCRIÇÃO:</b> Rotina do backup dos bancos de dados dos clientes e inicialização dos programas do Trix Desenvolvimento. <br>
                 Deve ser feito diariamente no início do dia e no final do dia </li>
             
              <li><a href="./documentar.php" >Documentar parametros da função</a></li>

              <li><b>DESCRIÇÃO:</b>  Ao colocar os parametros da função, preenche a documentação de forma automática e padronizada. </li>
              
              
               <li><a href="./documentar.php" >Trocar while por foreach</a></li>

              <li><b>DESCRIÇÃO:</b>  Ao colocar o nome do programa, vai buscar no TrixProjeto e gerar um txt com o novo conteúdo para o analista substituir. </li>
              

             <li><a href="../AtualizacaoTRIX/mov_prog_comp.php" >Copiar fontes DES para Compilados</a></li>

              <li><b>DESCRIÇÃO:</b>  Rotina para copiar os arquivos fontes para a pasta Compilados. Lista os programas de acordo com data e hora da última alteração. </li>

             <li><a href="../AtualizacaoTRIX/">Atualizar fontes e SQL nos sistemas em Produção</a></li>

               <li><b>DESCRIÇÃO:</b> Rotina para atualizar os programas fontes e queries no sistema de produção. </li>

             <li><a href=" ./recupera_bd.php">Criar BD / Importar AtuSTrix</a></li>

               <li><b>DESCRIÇÃO:</b>  Recupera um banco de dados SQL/Importa AtuSTrix em um banco local já existente. </li>

             

             <li><a href=" ./atualizarversao.php">Preparar e atualizar versão Trix</a></li>

               <li><b>DESCRIÇÃO:</b> Como separar os fontes, AtuSTrix e executar a atualização de versão do sistema Trix do cliente. Tem a descrição do que é e como proceder.</li>
               
               
               <li><a href="./espaco_em_disco/">Espaço em discos SERVIDORES - LINUX</a></li>

               <li><b>DESCRIÇÃO:</b> Abre uma tela que consulta em tempo real o espaço em disco dos servidores linux pelo comando df -h</b> </li>

               <li><a href=" ./excluir_prog_TRIX.php">Copiar programa do Trix antes da Exclusão</a></li>

               <li><b>DESCRIÇÃO:</b>  Move o programa informado para uma pasta de backup. Não faz a exclusão. <br>
                   Para excluir deve remover inclusive do versionamento. Por isso esse passo de exclusão é feito manual.</li>
<!--                 <li><a href=" ../../TrixProjeto/Desenvolvimento/PainelTrix.php">Painel Trix</a></li>

                 <li><b>DESCRIÇÃO:</b> Consulta o status dos jobs e banco de dados.</b> </li>-->

<!--            <li><a href=" ./buscartrechoprog.php">Buscar trechos em programas Desenvolvimento</a></li>

               <li><b>DESCRIÇÃO:</b> Utiliza o grep do Linux para buscar trechos no diretorio Desenvolvimento.</li>-->

               <!--<li><a href=" ./servicos.php">Parar, Iniciar e Reiniciar serviços Apache e MySQL</a></li>-->

<!--               <li><b>DESCRIÇÃO:</b> Indica o acesso ao servidor Linux para parar e iniciar esses serviços quando necessário.</li>
               <li><a href=" ./bkp_semanal.php">Backup </a></li>

               <li><b>DESCRIÇÃO:</b> Rotinas de backups - semanal (automatico e manual),  e-mails e DVD.</li>-->
               <br><br>
         </ul>
 </div>

</body>
</html>


