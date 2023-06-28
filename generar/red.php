    <div class="container">
        <div class="columns">
            <div class="column">
                <h1 class="is-size-1">Imprimir en red</h1>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="field">
                    <label class="label">Escribe la URL remota:</label>
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
                        <button id="btnObtenerImpresoras" class="button is-info mx-2">Obtener lista de
                            impresoras</button>
                    </div>
                </div>
                <br>
                <div class="field">
                    <label class="label">Escribe un mensaje:</label>
                    <div class="control">
                        <input id="mensaje" value="Hola mundo desde parzibyte.me" class="input" type="text" placeholder="Un mensaje de prueba">
                    </div>
                </div>
                <br>
                <button id="btnImprimir" class="button is-success mt-2">Imprimir</button>
            </div>
            <div class="column">
                <div class="notification is-warning">
                    <p>
                        Al imprimir, el resultado debería ser parecido al siguiente:
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
                alert("Error obteniendo impresoras: " + impresoras);
            }
        };
        const init = async () => {

            $btnImprimir.addEventListener("click", () => {
                const nombreImpresora = $listaDeImpresoras.value;
                if (!nombreImpresora) {
                    return alert("Por favor seleccione una impresora. Si no hay ninguna, asegúrese de haberla compartido como se indica en: https://parzibyte.me/blog/2017/12/11/instalar-impresora-termica-generica/")
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
                return alert("Escribe un mensaje");
            }

            if (!url) {
                return alert("Escribe la URL");
            }
            const conector = new ConectorPluginV3(URLPlugin);
            conector.Iniciar();
            conector.EscribirTexto(mensaje);
            conector.Feed(1);
            const respuesta = await conector
                .imprimirEnImpresoraRemota(nombreImpresora, url + "/imprimir");
            if (respuesta === true) {
                alert("Impreso correctamente");
            } else {
                alert("Error: " + respuesta);
            }
        }
        init();
    </script>