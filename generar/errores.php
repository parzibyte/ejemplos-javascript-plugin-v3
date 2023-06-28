
    <div class="container">
        <div class="columns">
            <div class="column">
                <h1 class="is-size-1">Errores comunes</h1>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <ol>
                    <li>
                        <strong>La lista de impresoras no carga</strong>
                        El plugin no se está ejecutando, no diste los permisos, cambiaste el puerto del plugin o
                        modificaste el código de los ejemplos. Recuerda que el puerto del plugin está documentado en la
                        página de documentación junto con la URL
                    </li>
                    <li>
                        <strong>No aparece la impresora</strong>
                        No has instalado o compartido tu impresora. Recuerda que debes instalarla, compartirla y luego
                        probarla como se indica en:
                        <a
                            href="https://parzibyte.me/blog/2017/12/11/instalar-impresora-termica-generica/">https://parzibyte.me/blog/2017/12/11/instalar-impresora-termica-generica/</a>
                    </li>
                    <li>
                        <strong>El plugin funciona en los ejemplos pero no en mi sitio web</strong>
                        El plugin crea un servidor HTTP al que se le hacen llamadas. Ese servidor está en localhost, al
                        cual solo puedes invocar desde sitios seguros con https o desde localhost

                        Más información en: <a
                            href="https://parzibyte.me/blog/2021/10/01/the-request-client-is-not-a-secure-context-and-the-resource-is-in-more-private-address-space-local/">https://parzibyte.me/blog/2021/10/01/the-request-client-is-not-a-secure-context-and-the-resource-is-in-more-private-address-space-local/</a>
                    </li>
                    <li>
                        <strong>Aparece un error de servidor</strong>
                        El plugin es lo más transparente posible. El error siempre te dirá la razón (si está en inglés
                        puedes traducirla) ya sea como respuesta en HTTP o en el log que se crea en el directorio del
                        plugin
                    </li>
                    <li>
                        <strong>Envío la licencia pero el plugin se comporta como si no la tuviera</strong>
                        Recuerda que la licencia debe ser enviada en el campo "serial" junto con las operaciones y el
                        nombre de la impresora. Si envías una licencia pero es inválida, el plugin simplemente va a
                        actuar como si no tuvieras una.
                        <strong>Yo pruebo todas las licencias antes de enviarlas usando este sitio web en el ejemplo de
                            "Probar licencia"</strong>
                    </li>
                    <li>
                        <strong>error 0xc00007b</strong>
                        Algunos usuarios me informan que tienen el error 0xc00007b o que les pide una DLL de
                        libiconv-2.dll o algo así. Ya he incluido esa DLL en el zip de pluginv3_windows_64.zip y ya no
                        debería dar ningún tipo de problema. Asegúrate de distribuir el plugin junto con esa DLL
                    </li>
                    <li>
                        <strong>open Impresora: the network name cannot be found o La ruta de acceso
                            especificada no es válida</strong>
                        es debido a que no has compartido tu impresora, no has
                        especificado la impresora o estás intentando imprimir en una impresora en red local, cosa
                        que no es posible. La impresora debe estar conectada en la computadora donde se ejecuta el
                        plugin y debe estar compartida.
                    </li>
                    <li>
                        <strong>Necesito ayuda con la implementación</strong>
                        Te ayudo con gusto en <a
                            href="https://parzibyte.me/#contacto">https://parzibyte.me/#contacto</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>