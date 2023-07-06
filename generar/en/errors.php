<div class="container">
    <div class="columns">
        <div class="column">
            <h1 class="is-size-1">Common errors</h1>
        </div>
    </div>
    <div class="columns">
        <div class="column">
            <ol>
                <li>
                    <strong>Printer list is not loading</strong>
                    The plugin is not running, you have not given permission, the port
                    was changed or the examples source code was modified.
                </li>
                <li>
                    <strong>My printer is not listed</strong>
                    You have not installed or shared your printer. Remember that you must share it as indicated in:
                    <a href="https://parzibyte.me/blog/en/2019/10/13/how-to-share-printer-windows/">https://parzibyte.me/blog/en/2019/10/13/how-to-share-printer-windows/</a>
                </li>
                <li>
                    <strong>The plugin is working on the examples but not on my website</strong>
                    The plugin creates an HTTP server. That server is on localhost, which (from the browser) can be only invoked from HTTPS sites or localhost
                    More info: <a href="https://parzibyte.me/blog/2021/10/01/the-request-client-is-not-a-secure-context-and-the-resource-is-in-more-private-address-space-local/">https://parzibyte.me/blog/2021/10/01/the-request-client-is-not-a-secure-context-and-the-resource-is-in-more-private-address-space-local/</a>
                </li>
                <li>
                    <strong>There's a server error</strong>
                    The plugin is as transparent as possible. The error will always tell you the reason, whether it's in English or translated, either as an HTTP response or in the log created in the plugin's directory.
                </li>
                <li>
                    <strong>I am sending the license but it behaves like if I wasn't sending it</strong>
                    Remember that the license must be sent in the "serial" field along with the operations and
                    printer name. If you send an invalid license, the plugin will act as if you weren't sending one.
                    <strong>I always test the license on this site in the License example</strong>
                </li>
                <li>
                    <strong>error 0xc00007b</strong>
                    Some users have reported that error which is caused due to a missing DLL. I have included that
                    DLL in the zip and it shouldn't be a problem from now. Make sure to distribute that DLL along the plugin
                </li>
                <li>
                    <strong>open Printer: the network name cannot be found o La ruta de acceso
                        especificada no es válida</strong>
                    You have not shared your printer, your printer's name is not using letters only or you are trying to print on a LAN.
                </li>
                <li>
                    <strong>I need help with the integration</strong>
                    Glad to help you at<a href="https://parzibyte.me/#contacto">https://parzibyte.me/#contacto</a>
                </li>
            </ol>
        </div>
    </div>
</div>