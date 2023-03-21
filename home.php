<?php
$path = "../TrixProjeto2.0/Desenvolvimento/";
include_once "{$path}funcbase.php";
?>
</!DOCTYPE html>
<html>
<head>
	<title>Home Dev Savy</title>
   <?php echo includeCSS("bootstrap.min.css", "{$path}bootstrap/css/");
   ?>
</head>
<?php

$divAbreGuia = "<div id=tabs-#IDGUIA# style='padding:15px' class='tab-pane fade #ATIVA#' role='tabpanel' aria-labelledby='tabs-#IDGUIA#'>";
$arrGuias = array();
      $arrGuias["Atu"] = array("ativa" => true, "titulo" => "Atualiação");
      $arrGuias["Proc"] = array("ativa" => false, "titulo" => "Procedimentos");
      $arrGuias["Cli"] = array("ativa" => false, "titulo" => "Trix Clientes");
      $arrGuias["Cli2"] = array("ativa" => false, "titulo" => "Trix Clientes 2.0");
      $arrGuias["Links"] = array("ativa" => false, "titulo" => "Des e Savy");
 echo ("<ul class='nav nav-tabs' id='tabsHD' role='tablist'>\n");
      foreach ($arrGuias as $idG => $g)
      {
         echo ("<li class='nav-item'><button class='nav-link fs-6 " . ($g["ativa"] ? "active" : "") . "' data-bs-toggle='tab' " .
         "data-bs-target='#tabs-{$idG}' type='button' role='tab' aria-controls='#tabs{$idG}' " .
         "aria-selected='" . ($g["ativa"] ? "true" : "") . "'>" .
         "{$g["titulo"]}</button></li>\n");
      }
      echo "</ul>\n";
      
      echo "<div class='tab-content pd-10' id='myTabContent'>";
      echo str_replace(array("#IDGUIA#", "#ATIVA#"), array("Atu", "show active"), $divAbreGuia);
      echo "<iframe class='frammain' id='Atu' src='http://localhost/Trix/AtualizacaoTRIX/' width='100%' height='100%' style='border:none;'></iframe>\n";
      echo "</div>";
      echo str_replace(array("#IDGUIA#", "#ATIVA#"), array("Proc", ""), $divAbreGuia);
      echo "<iframe class='frammain' id='Proc' src='http://localhost/Trix/ProcedimentoDiario/' width='100%' height='100%' style='border:none;'></iframe>\n";
      echo "</div>";
      echo str_replace(array("#IDGUIA#", "#ATIVA#"), array("Cli", ""), $divAbreGuia);
      echo "<iframe class='frammain' id='Cli' src='http://localhost/Trix/TrixProjeto/Desenvolvimento/trixcliente.php' width='100%' height='100%' style='border:none;'></iframe>\n";
      echo "</div>";
      echo str_replace(array("#IDGUIA#", "#ATIVA#"), array("Cli2", ""), $divAbreGuia);
       echo "<iframe class='frammain' id='Cli' src='http://localhost/Trix/TrixProjeto2.0/Desenvolvimento/trixcliente.php' width='100%' height='100%' style='border:none;'></iframe>\n";
      echo "</div>";
      echo str_replace(array("#IDGUIA#", "#ATIVA#"), array("Links", ""), $divAbreGuia);
       echo ("<div style='margin-top:10px'><a " .
         "href='https://www.reflectsys.com.br/Sistema/TrixDes/trixdes.php'>Acesso Direto TrixDes Produção</a></div>");
       echo ("<div style='margin-top:10px'><a " .
         "href='https://www.reflectsys.com.br/Sistema/TrixDes200/trixdes.php'>Acesso Direto TrixDes 2.00 Produção</a></div>");
       echo ("<div style='margin-top:10px'><a " .
         "href='https://www.reflectsys.com.br/Savy/savy.php'>Acesso Direto Savy Produção</a></div>");
      echo "</div>";
      
      echo "</div>";
 ?>

<body>
</body>
<?php echo includeJS("bootstrap.bundle.min.js", "{$path}bootstrap/js/")
   ?>
</html>
