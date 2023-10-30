<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>DOCUMENTAR PARAMETROS DE FUNÇÃO</title>        
    </head>
    <style>
        body{font-family: Verdana; font-size: 10pt}
         li{padding-top:5px; display: block }
         input[type="submit"]{height:25px; cursor:pointer;}
         input[type="text"]{height:20px; width: 150px; padding:5px; border-radius: 3px}
        ul li {margin:5px}
        ol li {margin:5px}
        h2, h3, .container {margin: 0 auto; width: 95%}
        h2, h3 {margin-bottom: 10px; margin-top: 10px;}
        div.container {border: solid 1px #e0e0e0; border-radius: 5px;}   
    </style>
    <body>
        <?php
         if (isset($_POST["parametros"]))
         {
            $parametros = $_POST["parametros"];
            $p = explode(",", $parametros);
            foreach ($p as $param)
            {   
               $param = trim($param);
               $desc = "";
               if (substr($param, 0,1) == "&")
               {
                  $desc .= " (ref)";
                  $param = substr($param, 1);
               }
               $pOpc = explode("=", $param);
               if (sizeof($pOpc) > 1)
               {
                   $desc .= " (opc)";

               }
               $param = trim($pOpc[0]);   
               echo " * @param Type $param$desc <br>";
            }
//            return true;
         }
         if (isset($_POST["nomeProg"]))
         {
            $nomeProg = trim($_POST["nomeProg"]);
            if (isset($_POST["Continuar01"]))
               $path = "C:\\xampp\\htdocs\\Trix\\TrixProjeto\\Desenvolvimento";
            else
               $path = "C:\\xampp\\htdocs\\Trix\\TrixProjeto2.0\\Desenvolvimento";
            
            if (!is_file($path . "\\" .$nomeProg))
               die("Não é arquivo: " . $path . "\\" .$nomeProg);
            $handle = fopen($path . "\\" .$nomeProg, "r");
            $novoArquivo = "";
            while (!feof($handle)) 
            {
               $linha = fgets($handle);               
               $texto = str_replace(array(" ", "\\t", "\\n", "\\r"), "", trim($linha));
               if (substr($texto, 0, 11) == "while(list(")
               {                      
                  $texto = str_replace(array("while(list(", "))", ")=each("), array("", "", ","), $texto);
                  $p = explode(",", $texto);
                  $p = array_map("trim", $p);
                  $novoTexto = "foreach ({$p[2]} as {$p[0]} => {$p[1]})";                  
                  //para manter os espaços em branco do começo
                  $pos = strpos($linha, "while");
                  $novoArquivo .= substr($linha, 0, $pos) . "$novoTexto\n";
               }
               else
               {
                  $novoArquivo .= ($linha);
               }
            }
            fclose($handle);
            
            file_put_contents("temp_arq.txt", $novoArquivo);
            
            echo "<h3>Gerado o arquivo temp_arq.txt</h3>";
            echo "<h4>Abrir ele em C:/xampp/htdocs/Trix/ProcedimentoDiario com TextPad e " .
               "colar o conteudo no programa $nomeProg</h4>";
            echo "<h4>Origem do programa: $path</h4>";
            echo "<h4>Confira com a comparação do GIT se mudou apenas os whiles para foreach</h4>";
            
         }
         if (isset($_POST["trechoProg"]))
         {
            $nomeProg = trim($_POST["trechoProg"]);
            $qualLinha = explode(",", $_POST["linhas"]);
            $qualLinha = array_map("trim", $qualLinha);
            
            if (sizeof($qualLinha) != 2)
               die("Linhas devem ser informadas: Inicial e final separado por virgula" . sizeof($qualLinha));
            
            if (trim($_POST["nomeObj"]) == "")
                die("nome do objeto deve ser informado");
            
            if (trim($_POST["nomeArray"]) == "")
                die("nome do array deve ser informado");
            
            if (isset($_POST["Continuar01"]))
               $path = "C:\\xampp\\htdocs\\Trix\\TrixProjeto\\Desenvolvimento";
            else
               $path = "C:\\xampp\\htdocs\\Trix\\TrixProjeto2.0\\Desenvolvimento";
//            
            if (!is_file($path . "\\" .$nomeProg))
               die("Não é arquivo: " . $path . "\\" .$nomeProg);
            $handle = fopen($path . "\\" .$nomeProg, "r");
            
            $novoArquivo = "";
            $numLinha = 0;
            
            $nomeObj = trim($_POST["nomeObj"]);
            $nomeObj = "\${$nomeObj}->Campo(";
            $nomeArray = trim($_POST["nomeArray"]);
            
            $novoArquivo = "";
            while (!feof($handle)) 
            {                 
               $linha = fgets($handle);
               $numLinha++;
               if ($qualLinha[0] <= $numLinha && $qualLinha[1] >= $numLinha)
               {
                  $nTemObjeto = (strpos($linha, $nomeObj) === false);
                  
                  if (!$nTemObjeto)
                  {
//                     echo "<hr>Linha antes: $linha<br>";
                     $trecho = explode("$nomeObj", $linha);
//                     echo "::::" .sizeof($trecho)  . ":::<br>";
                     $novoTrecho = $trecho[0];
                     for ($i = 1; $i < sizeof($trecho); $i++)
                     {
                        $final = $trecho[$i];
                        $pos = strpos($final, ")");
                        $final = substr($final, 0, $pos) . "]" . substr($final, $pos+1, strlen($final));
                        $novoTrecho .= "\${$nomeArray}[" . $final;
                     }
                     $novoArquivo .= "$novoTrecho";
//                     echo "Linha depois: $novoTrecho<br>";
                  }
                  else
                     $novoArquivo .= "$linha";
               }            
            }
            fclose($handle);
//            
            file_put_contents("temp_arq.txt", $novoArquivo);
            
            echo "<h3>Gerado o arquivo temp_arq.txt</h3>";
            echo "<h4>Abrir ele em C:/xampp/htdocs/Trix/ProcedimentoDiario com TextPad e " .
               "colar o conteudo no programa $nomeProg</h4>";
            echo "<h4>Origem do programa: $path</h4>";
            echo "<h4>Susbtitua só as linhas</h4>";
            echo "<h4>Confira com a comparação do GIT se mudou apenas os whiles para foreach</h4>";
            
         }
         ?>
        <h2>Documentar parametros de função</h2>
        <form action="documentar.php" method="post">
            <textarea cols="100" rows="2" name="parametros"></textarea>
            <br><br>
            <input type="submit" name="Continuar01" value="Continuar">
        </form>
        
        <h2>Trocar while por foreach (nome do programa)</h2>
        <form action="documentar.php" method="post">
            <textarea cols="100" rows="2" name="nomeProg"></textarea>
            <br><br>
            <input type="submit" name="Continuar01" value="Desenvolvimento">
            <input type="submit" name="Continuar02" value="DES 2.0">
        </form>
        
        <h2>Trocar objeto por array</h2>
        <form action="documentar.php" method="post">
            Nome Prog: <textarea cols="100" rows="2" name="trechoProg"></textarea>
            <br>Linhas: <textarea cols="100" rows="2" name="linhas" placeholder="separado por virgula"></textarea>
            <br>Nome objeto (sem o $): <textarea cols="100" rows="2" name="nomeObj"></textarea>
            <br>nome do array (sem o $): <textarea cols="100" rows="2" name="nomeArray"></textarea>
            <br><br>
            <input type="submit" name="Continuar01" value="Desenvolvimento">
            <input type="submit" name="Continuar02" value="DES 2.0">
        </form>
   </body>
   </html>