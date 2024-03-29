
    <div class="container">
        <div class="columns">
            <div class="column">
                <h1 class="is-size-1">Probar licencia</h1>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="notification is-primary">
                    <strong>Nota:</strong> si tienes problemas con la licencia por favor mira el siguiente vídeo:
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
                    <label class="label">Escribe un mensaje:</label>
                    <div class="control">
                        <input id="mensaje" value="Hola mundo desde parzibyte.me" class="input" type="text"
                            placeholder="Un mensaje de prueba">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Licencia</label>
                    <div class="control">
                        <input id="licencia" value="" class="input" type="text"
                            placeholder="Tu licencia sin espacios extra">
                    </div>
                </div>
                <button id="btnImprimir" class="button is-success mt-2">Imprimir</button>
            </div>
            <div class="column">
                <div class="notification is-warning">
                    <p>
                        Al imprimir, el resultado debería ser parecido al siguiente:
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
                    return alert("Por favor seleccione una impresora. Si no hay ninguna, asegúrese de haberla compartido como se indica en: https://parzibyte.me/blog/2017/12/11/instalar-impresora-termica-generica/")
                }
                imprimir(nombreImpresora);
            });
        }

        const imprimir = async (nombreImpresora) => {
            const mensaje = $mensaje.value;
            const licencia = $licencia.value;
            if (!mensaje) {
                return alert("Escribe un mensaje");
            }
            const conector = new ConectorPluginV3(URLPlugin, licencia);
            conector.Iniciar();
            conector.EscribirTexto(mensaje);
            conector.Feed(3);
            const respuesta = await conector
                .imprimirEn(nombreImpresora);
            if (respuesta === true) {
                alert("Impreso correctamente");
            } else {
                alert("Error: " + respuesta);
            }
        }
        init();
    </script>