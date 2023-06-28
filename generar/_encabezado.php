<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bulma.min.css">
    <script src="./ConectorJavaScript.js" type="text/javascript"></script>
    <title><?php echo $titulo ?> - Plugin ESC POS para impresoras térmicas</title>
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

                <a target="_blank" class="navbar-item" href="https://github.com/parzibyte/plugin-impresora-termica-v3/releases/latest">
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
                <a class="navbar-item" href="errores.html">
                    Solución de errores
                </a>
                <a target="_blank" class="navbar-item" href="https://www.youtube.com/playlist?list=PLat1rFhO_zZi1e8VyLJuU1UTDqIN4H_5i">
                    Guías en YouTube
                </a>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <a href="https://parzibyte.me/blog/2022/10/02/contratar-licencia-para-plugin-impresora-termica-v3/" class="button is-primary">
                            <strong>Contratar una licencia</strong>
                        </a>
                        <a class="button is-light" href="https://parzibyte.me/blog/2022/11/01/plugin-gratuito-impresoras-termicas-bluetooth-android/">
                            Versión para Android
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>