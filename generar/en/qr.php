
    <div class="container">
        <div class="columns">
            <div class="column">
                <h1 class="is-size-1">Print QR on thermal printer</h1>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="select is-rounded">
                    <select id="listaDeImpresoras"></select>
                </div>
                <br>
                <div class="field">
                    <label class="label">QR code content</label>
                    <div class="control">
                        <input id="qr" value="I am the QR content. Visit parzibyte.me" class="input" type="text"
                            placeholder="The QR content. May be a URL or Text">
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
                <img src="./img/Imprimir código QR en impresora térmica de forma gratis.jpg" alt="Ticket con acentos">
            </div>
        </div>
    </div>
    <script>

        const obtenerListaDeImpresoras = async () => {
            return await ConectorPluginV3.obtenerImpresoras();
        }
        const URLPlugin = "http://localhost:8000"
        const $listaDeImpresoras = document.querySelector("#listaDeImpresoras"),
            $qr = document.querySelector("#qr"),
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
                imprimirQr(nombreImpresora);
            });
        }

        const imprimirQr = async (nombreImpresora) => {
            const contenido = $qr.value;
            if (!contenido) {
                return alert("Write the QR content");
            }
            const conector = new ConectorPluginV3(URLPlugin);
            conector.Iniciar();
            conector.EscribirTexto("Here's a QR code:");
            conector.Feed(1);
            conector.ImprimirCodigoQr(contenido, 160, 2, ConectorPluginV3.TAMAÑO_IMAGEN_NORMAL);
            conector.Iniciar(); //Nota: esto solo es necesario en ocasiones, por ejemplo en mi impresora debo hacerlo siempre que acabo de imprimir una imagen
            conector.Feed(1);
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