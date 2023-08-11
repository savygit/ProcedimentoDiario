<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>MOSTRA QUAIS SUBDIRETÓRIOS FORAM VERSIONADOS NO PERÍODO</title>
        <script type='text/javascript' src='../../TrixProjeto/Desenvolvimento/jquery/jquery.js'></script>
    </head>
    <body>        
        <h3>Resultado da análise do arquivo de log dos últimos commits</h3>
        <?php
//        
        $arrFontes = array();
        $fileCommit = "logcommit.txt";
         if (is_file($fileCommit))
         {          
            echo "Data do arquivo: $fileCommit " . date("d/m/Y H:i:s", filemtime($fileCommit)) . "<hr>";
            $lines = file($fileCommit);
            foreach($lines as $line){
               $line = str_replace(array(" ", "\\t", "\\n", "\\r", "Desenvolvimento/"), "", trim($line));
               if ($line != "")
               {
                  $l = explode("/", $line);
                  if (sizeof($l) > 1)
                     $arrFontes["Sub"][] = $line;
                  else
                     $arrFontes["Raiz"][] = $line;
               }               
            }
            if (isset($arrFontes["Sub"]))
            {
               $arrFontes["Sub"] = array_unique($arrFontes["Sub"]);
               sort($arrFontes["Sub"]);
               echo "<h4 style='color: red'>Arquivos versionados em subdiretórios</h4>";
               echo "<div style='background-color:#e0e0e0; padding: 5px'>";
               foreach ($arrFontes["Sub"] as $file)
               {
                  echo "$file<br>";
               }
               echo "</div>";
            }
            if (isset($arrFontes["Raiz"]))
            {
               $arrFontes["Raiz"] = array_unique($arrFontes["Raiz"]);
               echo "<h4>Arquivos versionados na Raiz</h4>";
               foreach ($arrFontes["Raiz"] as $file)
               {
                  echo "$file<br>";
               }
            }
         }
         else
         {
            echo "Arquivo $fileCommit não existe";
         }
        ?>
</body>
</html>