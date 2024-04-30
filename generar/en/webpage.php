<div class="container">
    <div class="columns">
        <div class="column">
            <h1 class="is-size-1">Print webpage</h1>
        </div>
    </div>
    <div class="columns">
        <div class="column">
            <div class="field">
                <div class="select is-rounded">
                    <select id="listaDeImpresoras"></select>
                </div>
            </div>

            <div class="field">
                <label class="label">Webpage URL</label>
                <div class="control">
                    <input id="url" value="https://parzibyte.github.io/ejemplos-javascript-plugin-v3/ticket_estatico.html" class="input" type="text" placeholder="https://sitio.com">
                </div>
            </div>
            <div class="field">
                <label class="label">Webpage width</label>
                <div class="control">
                    <input id="anchoPagina" value="380" class="input" type="number" placeholder="Ancho de página web">
                </div>
            </div>
            <div class="field">
                <label class="label">Image width</label>
                <div class="control">
                    <input id="maximoAncho" value="380" class="input" type="number" placeholder="Máximo ancho">
                </div>
            </div>
            <div class="field">
                <label class="label">Image printing algorithm</label>
                <div class="select is-rounded">
                    <select id="algoritmo">
                        <option value="0">Raster bit image</option>
                        <option value="1">Bit image column format</option>
                        <option value="2">NV Graphics</option>
                    </select>
                </div>
            </div>
            <button id="btnImprimir" class="button is-success mt-2">Print</button>
            <div class="notification is-info mt-2">The webpage shouldn't load external images, scripts
                nor styles, but have them inline. Don't:
                <pre>&lt;script type="text/javascript" src="script.js"&gt;&lt;/script&gt;</pre>
                Do this:
                <pre>&lt;script type="text/javascript"&gt;
    // Here goes the JS code
&lt;/script&gt;</pre>
                The same applies for CSS styles and images
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
        $url = document.querySelector("#url"),
        $anchoPagina = document.querySelector("#anchoPagina"),
        $maximoAncho = document.querySelector("#maximoAncho"),
        $algoritmo = document.querySelector("#algoritmo");

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
            imprimirPaginaWeb(nombreImpresora);
        });
    }


    const imprimirPaginaWeb = async (nombreImpresora) => {
        const conector = new ConectorPluginV3(URLPlugin);
        conector.Iniciar();
        const url = $url.value,
            anchoPagina = parseInt($anchoPagina.value),
            maximoAncho = parseInt($maximoAncho.value),
            algoritmo = parseInt($algoritmo.value);
        conector.GenerarImagenAPartirDePaginaWebEImprimir(url, anchoPagina, maximoAncho, algoritmo);
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