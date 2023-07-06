
    <div class="container">
        <div class="columns">
            <div class="column">
                <h1 class="is-size-1">Open cash drawer</h1>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="field">
                    <div class="select is-rounded">
                        <select id="listaDeImpresoras"></select>
                    </div>
                </div>
                <div class="notification is-info">I suggest to leave the inputs untouched, but if the default values
                    do not work for you, then you can change them and test. They are based on the docs published at:
                    <a
                        href="https://gist.github.com/parzibyte/2f36655ef9d6ea8e6de73c6e09bbc735#file-documentacion-txt">https://gist.github.com/parzibyte/2f36655ef9d6ea8e6de73c6e09bbc735#file-documentacion-txt</a>
                </div>
                <div class="field">
                    <label class="label">Pin</label>
                    <div class="control">
                        <input id="pin" value="48" class="input" type="number" placeholder="Pin">
                    </div>
                </div>
                <div class="field">
                    <label class="label">On time</label>
                    <div class="control">
                        <input id="tiempoEncendido" value="60" class="input" type="number"
                            placeholder="On time">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Off time</label>
                    <div class="control">
                        <input id="tiempoApagado" value="120" class="input" type="number" placeholder="Off time">
                    </div>
                </div>
                <button id="btnImprimir" class="button is-success mt-2">Print</button>
            </div>
            <div class="column">
                <div class="notification is-warning">
                    <p>
                        When printing, the cash drawer should be opened
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script>

        const obtenerListaDeImpresoras = async () => {
            return await ConectorPluginV3.obtenerImpresoras();
        }
        const URLPlugin = "http://localhost:8000"
        const $listaDeImpresoras = document.querySelector("#listaDeImpresoras"),
            $btnImprimir = document.querySelector("#btnImprimir"),
            $pin = document.querySelector("#pin"),
            $tiempoEncendido = document.querySelector("#tiempoEncendido"),
            $tiempoApagado = document.querySelector("#tiempoApagado");

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
                abrirCajon(nombreImpresora);
            });
        }


        const abrirCajon = async (nombreImpresora) => {
            const conector = new ConectorPluginV3(URLPlugin);
            conector.Iniciar();
            conector.Pulso(parseInt($pin.value), parseInt($tiempoEncendido.value), parseInt($tiempoApagado.value));
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