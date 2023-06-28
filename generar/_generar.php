<?php
$modulos = [
    [
        "archivo" => "acentos",
        "titulo" => "Imprimir acentos y páginas de códigos",
    ],
    [
        "archivo" => "barcode",
        "titulo" => "Imprimir códigos de barras",
    ],
    [
        "archivo" => "cajon",
        "titulo" => "Apertura del cajón de dinero",
    ],
    [
        "archivo" => "capacidades",
        "titulo" => "Capacidades de impresión",
    ],
    [
        "archivo" => "caracter_personalizado",
        "titulo" => "Definir carácter personalizado",
    ],
    [
        "archivo" => "errores",
        "titulo" => "Manejo de errores",
    ],
    [
        "archivo" => "hola",
        "titulo" => "Hola mundo en impresora térmica",
    ],
    [
        "archivo" => "imagenes",
        "titulo" => "Imprimir imágenes de internet, locales o en base64",
    ],
    [
        "archivo" => "index",
        "titulo" => "Página de inicio de plugin para impresora térmica",
    ],
    [
        "archivo" => "licencia",
        "titulo" => "Indicar licencia",
    ],
    [
        "archivo" => "qr",
        "titulo" => "Generar e imprimir código QR",
    ],
    [
        "archivo" => "red",
        "titulo" => "Imprimir en red local usando plugin como proxy",
    ],
    [
        "archivo" => "tabla",
        "titulo" => "Datos tabulados",
    ],
];
ob_clean();
$directorioSalida = "../";
foreach ($modulos as $indiceModulo => $modulo) {
    ob_start();
    $titulo = $modulo["titulo"];
    $archivo = $modulo["archivo"];
    include "_encabezado.php";
    include $archivo . ".php";
    include "_pie.php";
    $salida = ob_get_clean();
    file_put_contents($directorioSalida . "$archivo.html", $salida);
}
