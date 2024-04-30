<div class="container">
    <div class="columns">
        <div class="column">
            <h1 class="is-size-1">Imágenes</h1>
        </div>
    </div>
    <div class="columns">
        <div class="column">
            <div class="select is-rounded">
                <select id="listaDeImpresoras"></select>
            </div>
            <br>
            <div class="field">
                <label class="label">URL de una imagen (puede ser incluso una IP o localhost):</label>
                <div class="control">
                    <input id="url" value="https://parzibyte.github.io/ejemplos-javascript-plugin-v3/generar/parzibyte.png" class="input" type="text" placeholder="https://laimagen">
                </div>
            </div>
            <div class="field">
                <label class="label">Imagen en base64</label>
                <div class="control">
                    <input id="base64" value="<?php printf("data:%s;base64,%s", mime_content_type("parzibyte.png"), base64_encode(file_get_contents("parzibyte.png"))) ?>" class="input" type="text" placeholder="data:image/...">
                </div>
            </div>
            <div class="field">
                <label class="label">Ruta local:</label>
                <div class="control">
                    <input id="local" type="text" class="input" placeholder="C:\Users\parzibyte\Desktop\krool.png">
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
        </div>
        <div class="column">
            <div class="notification is-warning">
                <p>
                    Al imprimir, el resultado debería ser parecido al siguiente:
                </p>
            </div>
            <img src="./img/Imprimir imágenes en impresora térmica - de URL, base64 y local.jpg" alt="Ticket con acentos">
        </div>
    </div>
</div>
<script>
    const obtenerListaDeImpresoras = async () => {
        return await ConectorPluginV3.obtenerImpresoras();
    }
    const URLPlugin = "http://localhost:8000"
    const $listaDeImpresoras = document.querySelector("#listaDeImpresoras"),
        $url = document.querySelector("#url"),
        $base64 = document.querySelector("#base64"),
        $local = document.querySelector("#local"),
        $btnImprimir = document.querySelector("#btnImprimir"),
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
            imprimirImagenes(nombreImpresora);
        });
    }


    const imprimirImagenes = async (nombreImpresora) => {
        const conector = new ConectorPluginV3(URLPlugin);
        conector.Iniciar();
        const url = $url.value;
        const base64 = $base64.value;
        const local = $local.value;
        const algoritmo = parseInt($algoritmo.value);
        if (url) {
            conector.EscribirTexto("Imagen de URL: " + url);
            conector.Feed(1);
            conector.DescargarImagenDeInternetEImprimir(url, 160, algoritmo)
            conector.Iniciar(); //Nota: esto solo es necesario en ocasiones, por ejemplo en mi impresora debo hacerlo siempre que acabo de imprimir una imagen
            conector.Feed(1);
        }
        if (base64) {
            conector.EscribirTexto("Imagen en base64: ");
            conector.Feed(1);
            conector.ImprimirImagenEnBase64(base64, 160, algoritmo);
            conector.Iniciar(); //Nota: esto solo es necesario en ocasiones, por ejemplo en mi impresora debo hacerlo siempre que acabo de imprimir una imagen
            conector.Feed(1);
        }

        if (local) {
            conector.EscribirTexto(`Imagen local: ` + local);
            conector.Feed(1);
            conector.CargarImagenLocalEImprimir(local, 160, algoritmo);
            conector.Iniciar(); //Nota: esto solo es necesario en ocasiones, por ejemplo en mi impresora debo hacerlo siempre que acabo de imprimir una imagen
            conector.Feed(1);
        }
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