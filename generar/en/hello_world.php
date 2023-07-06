
    <div class="container">
        <div class="columns">
            <div class="column">
                <h1 class="is-size-1">Hello thermal printer</h1>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="select is-rounded">
                    <select id="listaDeImpresoras"></select>
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

        const obtenerListaDeImpresoras = async () => {
            return await ConectorPluginV3.obtenerImpresoras();
        }
        const URLPlugin = "http://localhost:8000"
        const $listaDeImpresoras = document.querySelector("#listaDeImpresoras"),
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
                imprimirHolaMundo(nombreImpresora);
            });
        }


        const imprimirHolaMundo = async (nombreImpresora) => {
            const conector = new ConectorPluginV3(URLPlugin);
            conector.Iniciar();
            conector.EscribirTexto("Hola mundo\nParzibyte.me");
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