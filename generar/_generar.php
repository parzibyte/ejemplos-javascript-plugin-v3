<?php
$modulosIngles = [
    [
        "archivo" => "accented-text",
        "titulo" => "Print diacritic text (spanish text)",
    ],
    [
        "archivo" => "barcode",
        "titulo" => "Print barcodes",
    ],
    [
        "archivo" => "cash_drawer",
        "titulo" => "Open cash drawer",
    ],
    [
        "archivo" => "capabilities",
        "titulo" => "ESC POS plugin capabilities",
    ],
    [
        "archivo" => "custom_character",
        "titulo" => "Define custom character",
    ],
    [
        "archivo" => "errors",
        "titulo" => "Error handling",
    ],
    [
        "archivo" => "hello_world",
        "titulo" => "Hello thermal printer",
    ],
    [
        "archivo" => "images",
        "titulo" => "Print URL, local or base64 images",
    ],
    [
        "archivo" => "index",
        "titulo" => "ESC POS free plugin",
    ],
    [
        "archivo" => "license",
        "titulo" => "License use",
    ],
    [
        "archivo" => "qr",
        "titulo" => "Create and print QR codes",
    ],
    [
        "archivo" => "lan",
        "titulo" => "Print on LAN by using plugin as a proxy",
    ],
    [
        "archivo" => "tabulated",
        "titulo" => "Print tabulated data",
    ],
    [
        "archivo" => "html",
        "titulo" => "Print from HTML",
    ],
];
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

    [
        "archivo" => "html",
        "titulo" => "Imprimir a partir de HTML",
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

ob_clean();
$directorioSalida = "../en/";
foreach ($modulosIngles as $indiceModulo => $modulo) {
    ob_start();
    $titulo = $modulo["titulo"];
    $archivo = $modulo["archivo"];
    include "./en/_encabezado.php";
    include "./en/" . $archivo . ".php";
    include "./en/_pie.php";
    $salida = ob_get_clean();
    file_put_contents($directorioSalida . "$archivo.html", $salida);
}
