    <div class="container">
        <div class="columns">
            <div class="column">
                <h1 class="is-size-1">LAN printing</h1>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="field">
                    <label class="label">Write the remote LAN URL</label>
                    <div class="control">
                        <input id="url" value="" class="input" type="text" placeholder="http://192.168.0.5:8000">
                    </div>
                </div>
                <hr>
                <div class="field is-grouped">
                    <div class="field">
                        <div class="select is-rounded">
                            <select id="listaDeImpresoras"></select>
                        </div>
                    </div>
                    <div class="field">
                        <button id="btnObtenerImpresoras" class="button is-info mx-2">Get printers list</button>
                    </div>
                </div>
                <br>
                <div class="field">
                    <label class="label">Write a message:</label>
                    <div class="control">
                        <input id="mensaje" value="Hola mundo desde parzibyte.me" class="input" type="text" placeholder="A test message">
                    </div>
                </div>
                <br>
                <button id="btnImprimir" class="button is-success mt-2">Print</button>
            </div>
            <div class="column">
                <div class="notification is-warning">
                    <p>
                        When printing, the result receipt should be as follows:
                    </p>
                </div>
                <img src="./img/Hola mundo.jpg" alt="Ticket con acentos">
            </div>
        </div>
    </div>
    <script>
        const URLPlugin = "http://localhost:8000"
        const $listaDeImpresoras = document.querySelector("#listaDeImpresoras"),
            $btnImprimir = document.querySelector("#btnImprimir"),
            $btnObtenerImpresoras = document.querySelector("#btnObtenerImpresoras"),
            $url = document.querySelector("#url"),
            $mensaje = document.querySelector("#mensaje");

        const obtenerImpresoras = async () => {
            const url = $url.value;
            if (!url) {
                return alert("Escribe la URL");
            }
            for (let i = $listaDeImpresoras.options.length; i >= 0; i--) {
                $listaDeImpresoras.remove(i);
            }
            const impresoras = await ConectorPluginV3.obtenerImpresorasRemotas(URLPlugin, url + "/impresoras");
            if (Array.isArray(impresoras)) {

                for (const impresora of impresoras) {
                    $listaDeImpresoras.appendChild(Object.assign(document.createElement("option"), {
                        value: impresora,
                        text: impresora,
                    }));
                }
            } else {
                alert("Error getting printers: " + impresoras);
            }
        };
        const init = async () => {

            $btnImprimir.addEventListener("click", () => {
                const nombreImpresora = $listaDeImpresoras.value;
                if (!nombreImpresora) {
                    return alert("Please select a printer. If there's none, make sure you have shared as indicated in: https://parzibyte.me/blog/en/2019/10/13/how-to-share-printer-windows/")
                }
                imprimirHolaMundo(nombreImpresora);
            });
            $btnObtenerImpresoras.addEventListener("click", () => {
                obtenerImpresoras();
            });
        }


        const imprimirHolaMundo = async (nombreImpresora) => {
            const mensaje = $mensaje.value;
            const url = $url.value;
            if (!mensaje) {
                return alert("Write a message");
            }

            if (!url) {
                return alert("Write the URL");
            }
            const conector = new ConectorPluginV3(URLPlugin);
            conector.Iniciar();
            conector.EscribirTexto(mensaje);
            conector.Feed(1);
            const respuesta = await conector
                .imprimirEnImpresoraRemota(nombreImpresora, url + "/imprimir");
            if (respuesta === true) {
                alert("Printed successfully");
            } else {
                alert("Error: " + respuesta);
            }
        }
        init();
    </script>