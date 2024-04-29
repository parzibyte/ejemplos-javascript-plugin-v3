<!DOCTYPE html>
<html lang="es">
<!--Generado el <?php echo date("Y-m-d H:i:s"); ?>-->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Plugin gratuito ESC POS para impresoras térmicas. Imprime recibos con texto con estilos, códigos QR, imágenes y más">
    <meta name="keywords" content="impresora térmica, esc pos, pos, impresora, plugin, imagen, código qr, código de barras">
    <link rel="stylesheet" href="./bulma.min.css">
    <script src="./ConectorJavaScript.js" type="text/javascript"></script>
    <title><?php echo $titulo ?> - Plugin ESC POS para impresoras térmicas</title>
    <?php if (strcmp($archivo, "html") === 0) { ?>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
        <link href="./summernote/summernote-bs4.min.css" rel="stylesheet">
        <script src="./summernote/summernote-bs4.min.js"></script>
    <?php } ?>
</head>

<body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" target="_blank" href="https://parzibyte.me/blog/2022/09/30/plugin-impresoras-termicas-version-3/">
                    Documentación y presentación
                </a>

                <a target="_blank" class="navbar-item" href="https://github.com/parzibyte/plugin-impresora-termica-v3/releases/tag/3.2.1">
                    Descargar plugin
                </a>

                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        Ejemplos
                    </a>
                    <div class="navbar-dropdown"><?php
                                                    foreach ($modulos as $indiceModulo => $modulo) {
                                                        $tituloParaMenu = $modulo["titulo"];
                                                        $archivoEnlace = $modulo["archivo"];
                                                        if ($archivoEnlace === "errores" || $archivoEnlace === "index") {
                                                            continue;
                                                        }
                                                    ?>
                            <a href="<?php echo $archivoEnlace ?>.html" class="navbar-item"><?php echo $tituloParaMenu; ?></a>
                        <?php
                                                    }
                        ?>
                    </div>
                </div>
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        Conectores
                    </a>
                    <div class="navbar-dropdown">
                        <a target="_blank" href="https://parzibyte.me/blog/2023/03/29/imprimir-impresora-termica-c-sharp-visual-studio/" class="navbar-item">
                            C# (Visual Studio o Mono)
                        </a>
                        <a target="_blank" href="https://parzibyte.me/blog/2022/09/30/comunicar-javascript-impresora-termica-usando-plugin-v3/" class="navbar-item">
                            JavaScript
                        </a>
                        <a target="_blank" href="https://parzibyte.me/blog/2022/10/04/imprimir-impresora-termica-java/" class="navbar-item">
                            Java
                        </a>
                        <a target="_blank" href="https://parzibyte.me/blog/2022/09/30/conectar-impresora-termica-python-imprimir-tickets-usando-plugin-v3/" class="navbar-item">
                            Python
                        </a>
                        <a target="_blank" href="https://parzibyte.me/blog/2023/06/26/impresora-termica-php-plugin/" class="navbar-item">
                            PHP
                        </a>
                        <a target="_blank" href="https://parzibyte.me/blog/2023/06/27/impresora-termica-node-js/" class="navbar-item">
                            Node.js
                        </a>
                        <hr class="navbar-divider">
                        <a class="navbar-item" href="https://parzibyte.me/blog/2022/11/30/crear-conector-plugin-impresora-termica/">
                            Aprender a crear el tuyo
                        </a>
                        <a class="navbar-item" href="https://parzibyte.me/#contacto">
                            Solicitar uno
                        </a>
                    </div>
                </div>
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        Ayuda
                    </a>
                    <div class="navbar-dropdown">
                        <a target="_blank" href="https://parzibyte.me/blog/2017/12/11/instalar-impresora-termica-generica/" class="navbar-item">
                            Configurar impresora
                        </a>
                        <a target="_blank" href="https://github.com/parzibyte/plugin-impresora-termica-v3/releases/tag/3.2.1" class="navbar-item">
                            Descargar plugin
                        </a>
                        <a target="_blank" href="errores.html" class="navbar-item">
                            Solución de errores
                        </a>
                        <a target="_blank" href="https://www.youtube.com/playlist?list=PLat1rFhO_zZi1e8VyLJuU1UTDqIN4H_5i" class="navbar-item">
                            Tutoriales en YouTube
                        </a>
                        <a target="_blank" href="https://github.com/parzibyte/ejemplos-javascript-plugin-v3/" class="navbar-item">
                            Código fuente de los ejemplos
                        </a>
                    </div>
                </div>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <a href="https://parzibyte.me/apps/ticket-designer/#/first-steps" class="button is-danger">
                            <strong>Prueba el diseñador</strong>
                        </a>
                        <a href="https://parzibyte.me/blog/2022/10/02/contratar-licencia-para-plugin-impresora-termica-v3/" class="button is-primary">
                            <strong>Contratar una licencia</strong>
                        </a>
                        <a class="button is-light" href="https://parzibyte.me/blog/2022/11/01/plugin-gratuito-impresoras-termicas-bluetooth-android/">
                            Versión para Android
                        </a>
                        <a href="./en/" class="button is-success">
                            🇺🇸&nbsp;English
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="columns">
            <div class="column">
                <div class="notification is-warning">
                    Recuerda que debes invocar al plugin (servir este sitio) por https, localhost o 127.0.0.1.
                    No funcionará en lugares sin HTTPS y tampoco en localhost con un puerto distinto al 80 (que es el puerto por defecto) ni en IP.
                    Si quieres imprimir en red mira el ejemplo de <a href="./red.html">Cómo usar el plugin en red</a>
                    <br>
                    <strong>Si los ejemplos no funcionan asegúrate de:</strong>
                    <br>
                    <ol>
                        <li>El plugin debe estarse ejecutando en segundo plano. Descárgalo de: <a href="https://github.com/parzibyte/plugin-impresora-termica-v3/releases/tag/3.2.1">https://github.com/parzibyte/plugin-impresora-termica-v3/releases/tag/3.2.1</a></li>
                        <li>
                            Tu impresora debe estar compartida y tener un nombre amigable como se indica en: <a href="https://parzibyte.me/blog/2017/12/11/instalar-impresora-termica-generica/">https://parzibyte.me/blog/2017/12/11/instalar-impresora-termica-generica/</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>