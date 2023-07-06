
    <div class="container">
        <div class="columns">
            <div class="column">
                <h1 class="is-size-1">Test license</h1>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="notification is-primary">
                    <strong>Note:</strong> if you are facing issues with the license, please watch the next video: 
                    <a target="_blank" href="https://www.youtube.com/watch?v=-8ZD__jG5As">https://www.youtube.com/watch?v=-8ZD__jG5As</a>
                </div>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="select is-rounded">
                    <select id="listaDeImpresoras"></select>
                </div>
                <br>
                <div class="field">
                    <label class="label">Write a message:</label>
                    <div class="control">
                        <input id="mensaje" value="Hello world from parzibyte.me" class="input" type="text"
                            placeholder="A test message">
                    </div>
                </div>
                <div class="field">
                    <label class="label">License</label>
                    <div class="control">
                        <input id="licencia" value="" class="input" type="text"
                            placeholder="Your license">
                    </div>
                </div>
                <button id="btnImprimir" class="button is-success mt-2">Print</button>
            </div>
            <div class="column">
                <div class="notification is-warning">
                    <p>
                        When printing, the result receipt should be as follows:
                    </p>
                </div>
                <img src="./img/Ticket con licencia.jpg" alt="Ticket con licencia">
            </div>
        </div>
    </div>
    <script>

        const obtenerListaDeImpresoras = async () => {
            return await ConectorPluginV3.obtenerImpresoras();
        }
        const URLPlugin = "http://localhost:8000"
        const $listaDeImpresoras = document.querySelector("#listaDeImpresoras"),
            $mensaje = document.querySelector("#mensaje"),
            $licencia = document.querySelector("#licencia"),
            $btnImprimir = document.querySelector("#btnImprimir");

        const init = async () => {
            const impresoras = await ConectorPluginV3.obtenerImpresoras(URLPlugin);
            for (const impresora of impresoras) {
                $listaDeImpresoras.appendChild(Object.assign(document.createElement("option"), {
                    value: impresora,
                    text: impresora,
                }));
            }
            $btnImprimir.addEventListener("click", () => {
                const nombreImpresora = $listaDeImpresoras.value;
                if (!nombreImpresora) {
                    return alert("Please select a printer. If there's none, make sure you have shared as indicated in: https://parzibyte.me/blog/en/2019/10/13/how-to-share-printer-windows/")
                }
                imprimir(nombreImpresora);
            });
        }

        const imprimir = async (nombreImpresora) => {
            const mensaje = $mensaje.value;
            const licencia = $licencia.value;
            if (!mensaje) {
                return alert("Write a message");
            }
            const conector = new ConectorPluginV3(URLPlugin, licencia);
            conector.Iniciar();
            conector.EscribirTexto(mensaje);
            conector.Feed(3);
            const respuesta = await conector
                .imprimirEn(nombreImpresora);
            if (respuesta === true) {
                alert("Printed successfully");
            } else {
                alert("Error: " + respuesta);
            }
        }
        init();
    </script>