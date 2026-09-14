<?php

function verificarSSL($dominio, $porta = 443)
{
    $context = stream_context_create(array(
        'ssl' => array(
            'capture_peer_cert' => true,
            'verify_peer' => false,
            'verify_peer_name' => false,
        )
    ));

    $client = @stream_socket_client(
        "ssl://{$dominio}:{$porta}",
        $errno,
        $errstr,
        30,
        STREAM_CLIENT_CONNECT,
        $context
    );

    if (!$client) {
        return array(
            'status' => false,
            'erro' => "$errstr ($errno)"
        );
    }

    $params = stream_context_get_params($client);

    if (!isset($params['options']['ssl']['peer_certificate'])) {
        return array(
            'status' => false,
            'erro' => 'Certificado não encontrado.'
        );
    }

    $cert = openssl_x509_parse($params['options']['ssl']['peer_certificate']);

    $expira = $cert['validTo_time_t'];
    $agora = time();
    $dias = floor(($expira - $agora) / 86400);

    return array(
        'status' => true,
        'dominio' => $dominio,
        'inicio' => date('d/m/Y H:i', $cert['validFrom_time_t']),
        'fim' => date('d/m/Y H:i', $expira),
        'dias_restantes' => $dias,
        'expirado' => ($dias < 0)
    );
}

$dominios = array(
    "www.reflectsys.com.br",
    "www.reflectsys1.com.br",
    "www.reflectsys2.com.br",
    "www.sistematrix.com.br",
    "www.savy.com.br"
);

foreach ($dominios as $d) {
    $r = verificarSSL($d);
    echo $d . " - " . $r['inicio'] . " - " . $r['fim'] . " - " . $r['dias_restantes'] . " dias<br>";
}