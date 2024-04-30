<div class="container">
    <div class="columns">
        <div class="column">
            <h1 class="is-size-1">Imprimir página web</h1>
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
                <label class="label">URL de la página</label>
                <div class="control">
                    <input id="url" value="https://parzibyte.github.io/ejemplos-javascript-plugin-v3/ticket_estatico.html" class="input" type="text" placeholder="https://sitio.com">
                </div>
            </div>
            <div class="field">
                <label class="label">Ancho de página</label>
                <div class="control">
                    <input id="anchoPagina" value="380" class="input" type="number" placeholder="Ancho de página web">
                </div>
            </div>
            <div class="field">
                <label class="label">Máximo ancho de imagen</label>
                <div class="control">
                    <input id="maximoAncho" value="380" class="input" type="number" placeholder="Máximo ancho">
                </div>
            </div>
            <div class="field">
                <label class="label">Algoritmo</label>
                <div class="select is-rounded">
                    <select id="algoritmo">
                        <option value="0">Rasterización</option>
                        <option value="1">Columnas</option>
                        <option value="2">NV Graphics</option>
                    </select>
                </div>
            </div>
            <button id="btnImprimir" class="button is-success mt-2">Imprimir</button>
            <div class="notification is-info mt-2">La página web no debería cargar estilos, imágenes o scripts externos, pero puede tenerlos incrustados. Es decir,
                no hagas:
                <pre>&lt;script type="text/javascript" src="script.js"&gt;&lt;/script&gt;</pre>
                Mejor haz:
                <pre>&lt;script type="text/javascript"&gt;
    // Aquí el código JS
&lt;/script&gt;</pre>

                Y haz lo mismo para los estilos CSS e imágenes

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
            alert("Impreso correctamente");
        } else {
            alert("Error: " + respuesta);
        }
    }
    init();
</script>