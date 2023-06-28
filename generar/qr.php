
    <div class="container">
        <div class="columns">
            <div class="column">
                <h1 class="is-size-1">Imprimir QR en impresora térmica</h1>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="select is-rounded">
                    <select id="listaDeImpresoras"></select>
                </div>
                <br>
                <div class="field">
                    <label class="label">Contenido del QR</label>
                    <div class="control">
                        <input id="qr" value="Soy el contenido de un QR. Visita parzibyte.me" class="input" type="text"
                            placeholder="El contenido del QR, puede ser texto, URL, etcétera">
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
                    return alert("Por favor seleccione una impresora. Si no hay ninguna, asegúrese de haberla compartido como se indica en: https://parzibyte.me/blog/2017/12/11/instalar-impresora-termica-generica/")
                }
                imprimirQr(nombreImpresora);
            });
        }

        const imprimirQr = async (nombreImpresora) => {
            const contenido = $qr.value;
            if (!contenido) {
                return alert("Escribe el contenido del QR");
            }
            const conector = new ConectorPluginV3(URLPlugin);
            conector.Iniciar();
            conector.EscribirTexto("Veamos un QR:");
            conector.Feed(1);
            conector.ImprimirCodigoQr(contenido, 160, 2, ConectorPluginV3.TAMAÑO_IMAGEN_NORMAL);
            conector.Iniciar(); //Nota: esto solo es necesario en ocasiones, por ejemplo en mi impresora debo hacerlo siempre que acabo de imprimir una imagen
            conector.Feed(1);
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