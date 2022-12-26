<?php
echo "<style>";
echo "textarea#trecho{font-size:12pt; padding:5px}";
echo "textarea#resultado{font-size:9pt; padding:5px; width:90%; min-height:300px}";
echo "div{font-size:10pt; padding:10px;font-family:Verdana}";
echo "h3{font-size:14pt;color:#045FB4}";
echo "input[type=text]{font-size:10pt;color:#045FB4; height:30px; padding:3px; border-radius:2px; border:solid 1px #045FB4; width:160px}";
echo "input[type=submit]{font-size:12pt;background-color:#045FB4; color:#fff; height:30px; padding:3px; border-radius:2px; " .
   "border:solid 1px #045FB4; width:100px; cursor:pointer}";
echo "</style>";

echo "<div>";

   echo "<form action='buscartrechoprog.php'>";
   echo "<h3>Buscar por arquivos que contenham o trecho informado no diretorio Trix - Desenvolvimento</h3>";
   
   echo "<textarea name='trecho' id='trecho' cols=50 rows=2 placeholder='digite aqui o trecho a ser buscar nos programas dentro do diretorio Desenvolvimento'></textarea>";
   
   echo "<br><br>Buscar onde? <input type=text name='buscaronde' placeholder='* para todos; *.php' value='*.php'></input>";
   echo "<br><br>Recursivo(Dentro dos diretórios)?&emsp;&emsp;Não:<input type=radio name='recursivo' value='N' checked>" . 
      " Sim:<input type=radio name='recursivo' value='S'>";
   echo "<br><br>Considera Maíscula/Minúscula(Case sensitive)?&emsp;&emsp;Não:<input type=radio name='casesensitive' value='N' checked>" . 
      " Sim:<input type=radio name='casesensitive' value='S'>";
   
   echo ("<br><br>&emsp;&emsp;<input type='submit' name='Procurar' value = 'Procurar'>");
   echo "</form>";
if (isset($_REQUEST["Procurar"]))
{
//   $path = "/home/servidor/htdocs/Trix/TrixProjeto/Desenvolvimento/";
// se for recursivo o caminho deve ficar junto com o buscar onde, se não for recursivo, deve ficar junto
   $path = "../../TrixProjeto/Desenvolvimento/" . ($_REQUEST["recursivo"] == "S" ? " " : "") . "{$_REQUEST["buscaronde"]}";
   $cmd = "grep -n" . ($_REQUEST["casesensitive"] == "N" ? " -i " : "") . 
      ($_REQUEST["recursivo"] == "S" ? " -R " : "") . "\"{$_REQUEST["trecho"]}\" $path";
    
     
   $arr = array();
   exec($cmd, $arr);   
   echo "<h3>Resultado</h3>";
   var_dump($cmd);
   echo "<hr>";
      
   echo "<textarea id='resultado'>";
   foreach ($arr as $resultado)
      echo "\n$resultado\n";
   echo "</textarea>";
}
echo "</div>"
?>