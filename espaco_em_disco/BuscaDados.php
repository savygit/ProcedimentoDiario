<?php
$arrServidor = array(
    "reflectsys" => array("URL" => "https://reflectsys.com.br/Crontab/monitor_espaco.php", "COLOR" => "#E06666"), 
    "sistematrix" => array("URL" => "https://sistematrix.com.br/Crontab/monitor_espaco.php", "COLOR" => "#F6B26B"), 
    "reflectsys1" => array("URL" => "https://reflectsys1.com.br/Crontab/monitor_espaco.php", "COLOR" => "#9900FF"),
    "reflectsys2" => array("URL" => "https://reflectsys2.com.br/Crontab/monitor_espaco.php", "COLOR" => "#C27BA0")
);

$arrDados = array();
foreach($arrServidor as $servidor => $arrDadosServ)
{
    $fp = fopen($arrDadosServ["URL"], "r");
    if($fp)
    {
        while (($buffer = fgets($fp, 4096)) !== false) 
        {
            if(strpos($buffer, '/dev/xvda2') !== false)
                $arrDados[$servidor] = $buffer;
        }
        fclose($fp);
    }
}
if(count($arrDados) > 0)
{
    $html = "<table>";
    $html .= "<tr>";
    $html .= "<td style='font-weight:bold;'>Servidor</td>";
    $html .= "<td style='font-weight:bold;'>Filesystem</td>";
    $html .= "<td style='font-weight:bold;'>Size</td>";
    $html .= "<td style='font-weight:bold;'>Used</td>";
    $html .= "<td style='font-weight:bold;'>Avail</td>";
    $html .= "<td style='font-weight:bold;'>Use%</td>";
    $html .= "<td style='font-weight:bold;'>Mount</td>";
    $html .= "</tr>";
    foreach($arrDados as $servidor => $dado)
    {
        $linha = explode(" ", $dado);
        $html .= "<tr>";
        $html .= "<td style='color:{$arrServidor[$servidor]["COLOR"]};font-weight:bold;'>" . $servidor . "</td>";
        foreach($linha as $conteudo)
        {
            if(empty($conteudo))
                continue;
                
            $html .= "<td>" . $conteudo . "</td>";
        }
        $html .= "</tr>";
        //echo "<p style='font-family:\"Arial\";font-size:10pt;padding:0;margin:0;'><span style='color:{$arrServidor[$servidor]["COLOR"]};font-weight:bold;'>$servidor: </span>$dado</p>";
    }
    $html .= "</table>";
}
?>
<html>
    <head>
    <style>
        body {
            font-family:"Arial";
            font-size:10pt;
        }
        table {
            font-size:10pt;
            border-collapse:collapse;
        }
        table tr td {
            border: 1px solid #cccccc;
            padding: 2.5px 5px;
            text-align: center;
        }
        .leitura {
            font-weight: bold;
        }
    </style>
    </head>
    <body>
        <p class='leitura'>Leitura: <?php echo date("d/m/Y"); ?></p>
        <?php echo $html; ?>
    </body>
</html>