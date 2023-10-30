<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <title>COMO ATUALIZAR A VERSÃO DO SISTEMA TRIX EM PRODUÇÃO</title>
    <script type='text/javascript' src='../TrixProjeto/Desenvolvimento/jquery/jquery.js'></script>
    <script>
        function datault() {
            $("*#datasubs").each(function() {
                if ($("#datault").val() === "") {
                    $(this).html("YYYY-MM-DD");
                    $("#datastatus").html("<b style=\"color:red\">Data deve ser YYYY-MM-DD</b>");
                } else {
                    if ($("#datault").val().length === 10) {
                        $(this).html($("#datault").val());
                        $("#datastatus").html("");
                    } else {
                        $("#datastatus").html("<b style=\"color:red\">Data deve ser YYYY-MM-DD</b>");
                    }

                }
            })
        }
        alert("Atenção!!!Conferir também os subdiretórios \n\n LEIA O PROCEDIMENTO COMPLETO");
    </script>
    <style>
        body {
            font-family: Verdana;
            font-size: 10pt
        }

        ul li {
            margin: 5px
        }

        ol li {
            margin: 5px
        }

        h2,
        h3,
        .container {
            margin: 0 auto;
            width: 95%
        }

        h2,
        h3 {
            margin-bottom: 10px;
            margin-top: 10px;
        }

        div.container {
            border: solid 1px #e0e0e0;
            border-radius: 5px;
        }

        div.msdos {
            border-radius: 5px;
            background-color: #000000;
            color: #ffffff;
            font-weight: bold;
            padding: 10px;
            width: 70%
        }

        span.comandolinux {
            background-color: #363636;
            color: #e0e0e0;
            font-style: italic;
        }

        span.comentario {
            color: #363636;
            font-style: italic;
        }

        span.importante {
            color: red;
            font-style: italic;
        }

        .texto_atu {
            padding: 10px;
            border-radius: 5px;
            font-size: 10pt;
            background-color: #363636;
            color: #40FF00
        }
    </style>
</head>

<body>
    <h2>Procedimento de atualização de versão do sistema Trix em produção</h2>
    <a href='http://localhost/Trix/ProcedimentoDiario/'>Home</a>
    <h3>Introdução</h3>
    <div class='container'>
        <ul>
            <li>A atualização de versão do sistema Trix em produção consiste em deixar o Trix do Cliente na mesma versão que o Trix Desenvolvimento</li>
            <li>Para isso é necessário fazer o upload dos fontes e do AtuSTrix.sql</li>
            <li>Para os fontes, a atualização principal consiste em levar todos os programas fontes .php e .js do "Desenvolvimento" modificados a partir da última<br> atualização; todo o conteúdo do diretório "styles" e as imagens mais recentes do diretório "images"</li>
            <li><i>Caso haja mais algum diretório adicional, esse também deve ser considerado</i></li>
            <li><i>Se houver algum update, liberação de funcionalidades ou execução de script para implantar algum Help Desk, esses devem ser separados manualmente pelo responsável e deve ser executado após a atualização OU antes se o processo assim exigir.</i></li>
        </ul>
    </div>
    <h3>Preparar</h3>
    <?php
    $gerarBat = false;
    if (isset($_REQUEST["d"])) {
        $d = $_REQUEST["d"];
        $dYY = explode("-", $d);
        $dYY = "20{$dYY[2]}-{$dYY[0]}-{$dYY[1]}";
        $gerarBat = true;
    } else {
        $d = "MM-DD-YY";
        $dYY = "YYYY-MM-DD";
    }

    if (isset($_REQUEST["pasta"]))
        $pasta = $_REQUEST["pasta"];
    else
        $pasta = "Oficial";

    $caminho = "C:\\xampp\htdocs\Trix\\";
    $caminhoOri = $caminho . "$pasta\\";
    $caminhoProprio = $caminho . "ProcedimentoDiario\\";

    $cmd = "";
    if ($gerarBat) {
        //gerar o bat para o comando dos versionandos
        $cmd .= "cd \"$caminhoOri\"\n";
        //               $cmd .= "git log --pretty=format:\"%str%h - %str%an, %str%ad : %str%s\" master --name-only --since=\"$dYY\" > " . 
        $cmd .= "git log --pretty=format:\"\" master --name-only --since=\"$dYY\" > " .
            "$caminhoProprio\logcommit.txt\n";
        $cmd .= "cmd\n";
        file_put_contents("ultimosCommitsMaster.bat", $cmd);
    }


    ?>
    <div class='container'>
        <h2>Procedimento de atualização de versão do sistema Trix em produção</h2>
        <h3>Para windows - Usado temporariamente para copiar os programas via MS-DOS</h3>
        <h4>O roteiro deve ser usado com base no Oficial ou Oficial2.0</h4>
        <h4>Diretório: <?php echo $pasta;?></h4>

        <form action='atualizarversao.php' method=post>
            <div style='font-size:10pt;padding:5px;background-color:#e0e0e0'>
            Data:<input type=text name=d value='' placeholder='MM-DD-YY' size=10><br><br>
            Pasta:<input type=text name=pasta value='Oficial' placeholder='' size=20><br><br>
            <input type=submit name=enviar value='processar'>
            </div>
        </form>
        <ol>
            <li>Se o Diretório base for o <b>Oficial</b>, faça o push nesse ambiente para pegar o AtusSTrix versionado mais recentemente</li>
            <li>Acessar o MSDOS. Pode abrir em qualquer endereço</li>
            <li>Executar o comando abaixo trocando MM-DD-YY pelo mês, dia e ano que se deseja pegar dos fontes</li>
            <!-- <ul>
                <li>DICA:chamar esse mesmo programa com o parametro: ?d=MM-DD-YY (exemplo: 02-12-19 que é 12/02/2019)</li>
                <li>DICA:para trocar a pasta do Oficial, chamar esse programa com parametro: ?pasta=NOMEDIR (exemplo: &pasta=Oficial2.0)</li>
            </ul> -->
            <div style='background-color:#e0e0e0; padding: 5px'>
                <b><?php echo $caminhoProprio; ?>ultimosCommitsMaster.bat</b><br>
                mkdir <?php echo $caminho; ?>Compilados\atu<br>
                mkdir <?php echo $caminho; ?>Compilados\atu\styles<br>
                mkdir <?php echo $caminho; ?>Compilados\atu\images<br>
                cd <?php echo $caminhoOri; ?>Desenvolvimento<br>
                xcopy *.php <?php echo $caminho; ?>Compilados\atu /D:<?php echo $d; ?><br>
                xcopy *.js <?php echo $caminho; ?>Compilados\atu /D:<?php echo $d; ?><br>
                <div style="color:red">
                    del <?php echo $caminho; ?>Compilados\atu\dcxirt.php<br>
                    del <?php echo $caminho; ?>Compilados\atu\def_proprio.php<br>
                    del <?php echo $caminho; ?>Compilados\atu\defmail.php<br>
                    del <?php echo $caminho; ?>Compilados\atu\TRIXcliente.php<br>
                    del <?php echo $caminho; ?>Compilados\atu\conf_logincliente.php<br>
                    del <?php echo $caminho; ?>Compilados\atu\trixdes.php<br>
                    del <?php echo $caminho; ?>Compilados\atu\t.php<br>
                    del <?php echo $caminho; ?>Compilados\atu\defibd.php<br>
                    del <?php echo $caminho; ?>Compilados\atu\def_sis_teste.php<br>
                </div>
                xcopy AtuSTrix.sql <?php echo $caminho; ?>Compilados\<br>
                cd styles<br>
                xcopy * <?php echo $caminho; ?>Compilados\atu\styles /D:<?php echo $d; ?><br>
                cd ..<br>
                cd images<br>
                xcopy * <?php echo $caminho; ?>Compilados\atu\images /D:<?php echo $d; ?><br><br>
            </div>

            <div style="font-size:10pt; font-weight: bold; margin:10px">
                <a href=" ./separaFontesSubDir.php" target="_blank">Separar fontes do subdiretório</a>
            </div>
            ** <i>Para comparar o que foi versionado, acessar o diretório "Oficial" e conferir tudo o que foi versionado,
                principalmente o que não está na raiz do Desenvolvimento</i><br>
            git log --pretty=format:"%h - %an, %ad : %s" --name-only --since="<?php echo $dYY; ?>" >
            <?php echo $caminho; ?>ProcedimentoDiario\logcommit.txt<br>
            <i>Usar o link acima "Separar fontes do subdiretório" para analisar os arquivos versionandos</i>
            <li>Os comandos acima geram um diretório "atu" com todos os fontes e copia o "AtuSTrix.sql" para o diretório "Compilados"</li>
            <li>Compactar como zip num único arquivo: AtusSTrix e atu em "atualizar.zip"</li>

        </ol>
    </div>

    <h3>Na hora da atualização</h3>
    <div class='container'>
        <ol>
            <h4>Preparar arquivos no FTP - Exceto Toride</h4>
            <li>Acessar o FTP do servidor onde ocorrerá a atualização, via SSH (Putty)</li>
            <li>Executar os comandos de descompactação e alteração da data de modificação dos arquivos (assim eles ficam no FTP com a
                data da atualização)</li>
            <li>ATENÇÃO: deve estar acessando o diretório "atualizar"</li>
            unzip atualizar.zip<br>
            cd atu<br>
            touch -m *<br>
            touch -m ./styles/*<br>
            touch -m ./images/*<br>
            cd ..<br><br>
            <li>Os comandos acima só precisam ser feitos antes da atualização, independente de quantos sistemas serão atualizados</li>

            <h4>Preparar arquivos no servidor TORIDE</h4>
            <li>Acessar servidor usando o programa TEAMVIEWER</li>
            <li>Antes da atualização é necessário compactar o diretório <b>TORIDE</b> (C:\xampp\htdocs\Trix\TORIDE); colocar o nome do arquivo a ser compactado como BKP_FONTES_TORIDE_YYYYMMDD.zip</li>
            <li>Acessar o diretório C:\xampp\htdocs\Trix\atualizar</li>
            <li>Descompactar os arquivos</li>
            <ul>
                <li>Recortar todos os arquivos do diretório atu e colar no diretório TORIDE (C:\xampp\htdocs\Trix\TORIDE)</li>
                <li>Levar o AtusSTrix no diretório C:\xampp\mysql\bin</li>
            </ul>
            <li>Executar o AtusSTrix
                <ul>
                    <li>Acessar no MSDOS o caminho C:\xampp\mysql\bin</li>
                    <li>Digite: mysql -uroot -pSENHA_BD_TORIDE</li>
                    <li>Digite: use toride;</li>
                    <li>Digite: source AtuSTrix.sql;</li>
                    <li>Após finalizar execução digite: exit</li>
                </ul>
                <br>
            <li><i>Remover o arquivo atualizar.zip do diretório Compilados</i></li>

            <h4>Atualizar o sistema Trix</h4>
            <li>Acesse a AtualizacaoTRIX e gere o arquivo em_atualizacao.php.
                <ul>
                    <li>Ao gerar esse arquivo e enviar para o sistema que será atualizado, ele mostra uma mensagem de que o sistema está em atualização. Não sendo necessário alterar a pasta do sistema para derrubar os usuários logados</li>
                    <li>Atualize esse arquivo na pasta do Trix do sistema a ser atualizado</li>
                    <li>Clique <a target=_blank href='../AtualizacaoTRIX/gerararq_ematu.php'>AQUI</a> para acessar o link para gerar esse arquivo</li>
                </ul>
            </li>
            <li>Abrir a planilha de checklist que está no Google Drive (SavyDocs) "CheckList Atualização Sistemas"
                <ul>
                    <li>Observação: Está compartilhado essa planilha com as contas pessoais do google de cada analista</li>
                </ul>
            </li>
            <li>Nessa planilha há um checklist dos passos que devem ser executados PRINCIPALMENTE quando for uma atualização de vários sistemas como no caso da Rede Sigbol ou Brascon</li>
            <li><span class='importante'>IMPORTANTE: Siga os passos abaixo marcando na planilha o que foi executado e o que está em andamento<span></li>
            <h5>Programas Fontes e AtuSTrix.sql (Exceto Toride):</h5>
            <li>No sistema Trix Savy, acessar: Cadastro de Sistemas >> Cadastros >> Backup/Atualização Sistema</li>
            <li>Selecione o sistema que será atualizado, deixe o "Tipo" selecionado com "Atualização de versão"</li>
            <li>Ao processar, o Trix gera uma sequencia de comandos:
                <ol>
                    <li><span class='comandolinux'>cd public_html</span>: <span class='comentario'>Já sugere o servidor Locaweb, mas pode não ser. Entende que você acabou de se logar no FTP via SSH</span></li>
                    <li><span class='comandolinux'>cd atualizar</span>: <span class='comentario'>Acessa o diretório onde estão os arquivos para atualização</span></li>
                    <li><span class='comandolinux'>mysql -h HOST -u USER -pPASS -q NOMEBD < AtuSTrix.sql</span>: <span class='comentario'>importa o AtuSTrix.sql no banco de dados</span></li>
                    <li><span class='comandolinux'>cp atu/* -Rap CAMINHO DOS FONTES</span>: <span class='comentario'>copia todo o conteúdo do diretorio "atu" para o diretório do sistema selecionado</span></li>
                    <li><span class='comandolinux'>rm CAMINHO DOS FONTES/MsgArqUsu/*.txt</span>: <span class='comentario'>apaga todo o conteúdo do diretório MsgArqUsu</span></li>
                    <li><span class='comandolinux'>chmod -R 0777 CAMINHO DOS FONTES</span>: <span class='comentario'>da permissão de leitura e escrita no diretório do sistema selecionado</span></li>
            </li>
        </ol>
        <h5>Gerar Dados e Check Estrutura:</h5>
        <li>Depois de executar os comandos acima, deve acessar o sistema que está sendo atualizado e Gerar Dados. Funcionalidade 726.</li>
        <li>Após Gerar Dados, deve-se Checar a Estrutura[370] com todas as opções Sim/Não = SIM
            <ol>
                <li>A opções são: Tabela, View, Índice e Trigger</li>
                <li>Para o Índice deve-se escolher a opção "Executar cadastros do Trix"</li>
            </ol>
        </li>
        <h5>Mensagem de atualização para os usuários:</h5>
        <li>Após a atualização da versão, é interessante criar uma mensagem para os usuários informando que o sistema foi atualizado</li>
        <li>Acessar a funcionalidade 1212 e criar uma mensagem informando que o Trix foi atualizado</li>
        <li>A validade da mensagem sugerida é de 1 dia</li>
        <li>Texto Sugerido:</li>
        <textarea cols=100 rows="5" class='texto_atu'><div style=\"font-size:18pt;padding:20px;line-height:40px; background-color:#F5DA81;border-radius:5px\"><h2 style=\"font-size:24pt\">COMUNICADO - ATUALIZAÇÃO DO SISTEMA!</h2>O sistema Trix foi atualizado hoje!<br>Qualquer dúvida, entre em contato com o suporte Trix<br><br>Bom Trabalho!</div></textarea>
        <li>SQL para insert com validade para a data atual (esse SQL pode ser execultado pelo atualização):</li>
        <textarea cols=100 rows="6" class='texto_atu'>INSERT INTO MesEmp (ID, DaData, AteData, Mensagem, DoAdmTrix, Ativo, Titulo, AbreTelaInic, LargMsg, AltMsg) VALUES ('', curdate(), curdate(), '<div style=\"font-size:18pt;padding:20px;line-height:40px; background-color:#F5DA81;border-radius:5px\"><h2 style=\"font-size:24pt\">COMUNICADO - ATUALIZAÇÃO DO SISTEMA!</h2>O sistema Trix foi atualizado hoje!<br>Qualquer dúvida, entre em contato com o suporte Trix<br><br>Bom Trabalho!</div>', 'S', 'S', '', 'S', '95%', '300px')</textarea>
        <h5>Remover o arquivo em_atualizacao.php do sistema:</h5>
        <li>Acesse a AtualizacaoTRIX e remova o arquivo em_atualizacao.php.
            <ul>
                <li>Atualize esse arquivo na pasta do Trix do sistema que foi atualizado</li>
                <li>Clique <a target=_blank href='../AtualizacaoTRIX/preparar.php?excluir_arq=S&file_exc=em_atualizacao.php'>AQUI</a> para acessar o remover arquivo em_atualizacao.php</li>
            </ul>
        </li>
        <h5>Help Desk:</h5>
        <li>Registrar a atualização da versão em Help Desk
            <ul>
                <li>Assunto: Atualização da versão Trix dd/mm/aaaa: <b>Atualização da versão Trix <?php echo date("d/m/Y") ?></b></li>
                <li>Interação: Atualização da versão Trix com o objetivo de implantar melhorias estruturais do sistema<br>
                    Essa atualização também implanta os Help Desks XXXXXXX
                </li>
            </ul>
        </li>
        <li>Franquias Sigbol: O Help Desk DEVE ser aberto no sistema de Controle de Franquias</li>
        <h5>Apontamento de horas</h5>
        <li>A classificação do apontamento é "Atualização Sistema"</li>
        <li>Na grande maioria dos sistemas Trix a atualização de versão é apontada como Locação, exceto:</li>
        <ul>
            <li>Sigbol Ensino: Deve ser Cobrado SIM pois eles não pagam locação</li>
            <li>Sigbol Controle: 40% do tempo deve ser Cobrado SIM pois eles não pagam locação e o restante Cobrado = NÃO pois se refere às franquias</li>
            <li>SAVY: Deve ser Cobrado NÃO pois não tem Locação.</li>
        </ul>

        <h5>Remover arquivos do diretório "atualizar" do servidor</h5>
        <li>ATENÇÃO: O comando abaixo é para servidores que utilizam o acesso via SSH e deve estar dentro da "atualizar"</li>
        rm -R atu<br>
        rm AtuSTrix.sql atualizar.zip<br>&nbsp;

        </ol>
    </div>
</body>

</html>