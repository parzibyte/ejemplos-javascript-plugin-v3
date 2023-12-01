<!DOCTYPE html>
<html lang="en">
<!--Generated at <?php echo date("Y-m-d H:i:s"); ?>-->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bulma.min.css">
    <script src="../ConectorJavaScript.js" type="text/javascript"></script>
    <meta name="description" content="ESC POS plugin for thermal printer. Print text, images, qr codes and design tickets">
    <meta name="keywords" content="thermal printer, esc pos, image, receipt, ticket, plugin, free">
    <title><?php echo $titulo ?> - Free ESC POS plugin for thermal printers</title>
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
                    Docs
                </a>

                <a target="_blank" class="navbar-item" href="https://github.com/parzibyte/plugin-impresora-termica-v3/releases/latest">
                    Download
                </a>

                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        Examples
                    </a>
                    <div class="navbar-dropdown"><?php
                                                    foreach ($modulosIngles as $indiceModulo => $modulo) {
                                                        $tituloParaMenu = $modulo["titulo"];
                                                        $archivoEnlace = $modulo["archivo"];
                                                        if ($archivoEnlace === "errors" || $archivoEnlace === "index") {
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
                        Connectors
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
                            Learn how to create a new connector
                        </a>
                        <a class="navbar-item" href="https://parzibyte.me/#contacto">
                            Request connector
                        </a>
                    </div>
                </div>
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        Help
                    </a>
                    <div class="navbar-dropdown">
                        <a target="_blank" href="https://parzibyte.me/blog/en/2019/10/13/how-to-share-printer-windows/" class="navbar-item">
                            Setup printer
                        </a>
                        <a target="_blank" href="https://github.com/parzibyte/plugin-impresora-termica-v3/releases/latest" class="navbar-item">
                            Download plugin
                        </a>
                        <a target="_blank" href="errors.html" class="navbar-item">
                            Error handling
                        </a>
                        <a target="_blank" href="https://www.youtube.com/playlist?list=PLat1rFhO_zZi1e8VyLJuU1UTDqIN4H_5i" class="navbar-item">
                            YouTube guides
                        </a>
                        <a target="_blank" href="https://github.com/parzibyte/ejemplos-javascript-plugin-v3/" class="navbar-item">
                            Examples source code
                        </a>
                    </div>
                </div>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <a href="https://parzibyte.me/apps/ticket-designer/#/first-steps" class="button is-danger">
                            <strong>ESC POS designer</strong>
                        </a>
                        <a href="https://parzibyte.me/blog/2022/10/02/contratar-licencia-para-plugin-impresora-termica-v3/" class="button is-primary">
                            <strong>Buy a license</strong>
                        </a>
                        <a class="button is-light" href="https://parzibyte.me/blog/2022/11/01/plugin-gratuito-impresoras-termicas-bluetooth-android/">
                            Android version
                        </a>
                        <a href="../" class="button is-success">
                            🇪🇸&nbsp;
                            Español
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
                    Remember that, when printing from the browser, you must use
                    https, localhost o 127.0.0.1.
                    It won't work on sites without HTTPS nor localhost with a different port than 80 (which is the default ) nor IP.
                    If you want to print on the local area network, check:<a href="./lan.html">How to print on a network printer</a>
                    <br>
                    <strong>If the examples are not working, make sure that:</strong>
                    <br>
                    <ol>
                        <li>The plugin is running in the background. Download it from: <a href="https://github.com/parzibyte/plugin-impresora-termica-v3/releases/latest">https://github.com/parzibyte/plugin-impresora-termica-v3/releases/latest</a></li>
                        <li>
                            Your printer is shared and has a friendly name as indicated in:
                            <a href="https://parzibyte.me/blog/en/2019/10/13/how-to-share-printer-windows/">https://parzibyte.me/blog/en/2019/10/13/how-to-share-printer-windows/</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>