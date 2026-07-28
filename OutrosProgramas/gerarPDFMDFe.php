<?php
include_once 'funcbase.php';
include_once 'funcMFe0.php';
$bd = "bdmbltrix";

$aFiles = ['35241208628365000177580010000004771000004777-mdfe.xml',
'35241208628365000177580010000004781000004782-mdfe.xml',
'35241208628365000177580010000004791000004798-mdfe.xml',
'35241208628365000177580010000004801000004802-mdfe.xml',
'35241208628365000177580010000004811000004818-mdfe.xml',
'35241208628365000177580010000004821000004823-mdfe.xml',
'35241208628365000177580010000004831000004839-mdfe.xml',
'35241208628365000177580010000004841000004844-mdfe.xml',
'35241208628365000177580010000004851000004850-mdfe.xml',
'35241208628365000177580010000004861000004865-mdfe.xml',
'35241208628365000177580010000004871000004870-mdfe.xml',
'35241208628365000177580010000004881000004886-mdfe.xml',
'35241208628365000177580010000004891000004891-mdfe.xml',
'35241208628365000177580010000004901000004906-mdfe.xml',
'35241208628365000177580010000004911000004911-mdfe.xml',
'35241208628365000177580010000004921000004927-mdfe.xml'];
foreach ($aFiles as $nome) {
    $nomeArq = "./xmlmbl/$nome";
    $xml     = simplexml_load_file($nomeArq);
    $contXML = file_get_contents($nomeArq);

// Namespace do MDF-e
    $ns = $xml->getNamespaces(true);

// mdfeProc
    $xml->registerXPathNamespace('mdfe', $ns['']);

// Dados principais
    $nMDF   = (string) $xml->xpath('//mdfe:nMDF')[0];
    $dhEmi  = (string) $xml->xpath('//mdfe:dhEmi')[0];
    $nProt  = (string) $xml->xpath('//mdfe:nProt')[0];
    $vCarga = (string) $xml->xpath('//mdfe:vCarga')[0];
    $placa  = (string) $xml->xpath('//mdfe:placa')[0];
    $RNTRC  = (string) $xml->xpath('//mdfe:RNTRC')[0];
    $chave  = (string) $xml->xpath('//mdfe:chMDFe')[0];

// Emitente
    $emit = $xml->xpath('//mdfe:emit')[0];

    $dadosEmit = [
        'CNPJ'    => (string) $emit->CNPJ,
        'IE'      => (string) $emit->IE,
        'xNome'   => (string) $emit->xNome,
        'xFant'   => (string) $emit->xFant,

        'xLgr'    => (string) $emit->enderEmit->xLgr,
        'nro'     => (string) $emit->enderEmit->nro,
        'xBairro' => (string) $emit->enderEmit->xBairro,
        'cMun'    => (string) $emit->enderEmit->cMun,
        'xMun'    => (string) $emit->enderEmit->xMun,
        'CEP'     => (string) $emit->enderEmit->CEP,
        'UF'      => (string) $emit->enderEmit->UF,
        'fone'    => (string) $emit->enderEmit->fone,
        'email'   => (string) $emit->enderEmit->email,
    ];

    echo "MDF-e: {$nMDF}<br>";
    echo "Data Emissão: {$dhEmi}<br>";
    echo "Protocolo: {$nProt}<br>";
    echo "Valor Carga: {$vCarga}<br>";
    echo "Placa: {$placa}<br><br>";
    echo "RNTRC: {$RNTRC}<br><br>";

    echo "<pre>";
    print_r($dadosEmit);
    echo "</pre>";

    $cons = new ConjReg($bd);
    $cons->ConsIns("ManCap", "CodManif, NumImpressao, ChaveMDFe, CriadoEm, Veiculo, Motorista, FilialOrigem, Filial, " .
        "StatusMDFe, Impresso, EnviaSefaz, ProtAut, Status, RNTRC", "'{$nMDF}', '{$nMDF}', '{$chave}', '{$dhEmi}', '{$placa}', " .
        "1, 1, 1, '9', 'S', 'S', '{$nProt}', 'F', '{$RNTRC}'");
    $cons->ExeCons();
    $cons->ImpCons();

    GeraRegXMLMDFe($cons, $nMDF, $contXML);

    echo "<hr>Inserido $nMDF <hr>";
}

// $bd = "toride";
// $pm = "";
// for ($i = 0; $i <= bd; $i++)
//    $pm .= ":";
// SetPar($pm, bd, $bd);

// CabHTMBas($pm);
// echo "<br><br>";
// echo "<form action=t.php method=post target=_self>";
// echo "<input type=text name=codfunc value='' size=10>";
// echo "<input type=submit name=processar>";
// echo "</form>";

// if (isset($_REQUEST["codfunc"]))
// {
//    $bd = "toride";
//    $pm = "";
//    for ($i = 0; $i <= bd; $i++)
//       $pm .= ":";
//    SetPar($pm, bd, $bd);
//    echo "<input type=text id=caminho value=\"" . caminhoFunc($pm, new ConjReg($bd), $_REQUEST["codfunc"]) . "\" size=150 class='CE'></input>";
// //   echo "<script>copiarTexto(\"caminho\");</script>";
// }
