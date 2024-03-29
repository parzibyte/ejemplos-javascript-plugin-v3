
<div class="container">
    <div class="columns">
        <div class="column">
            <h1 class="is-size-1">Acentos</h1>
        </div>
    </div>
    <div class="columns">
        <div class="column">
            <div class="select is-rounded">
                <select id="listaDeImpresoras"></select>
            </div>
            <br>
            <button id="btnImprimir" class="button is-success mt-2">Imprimir normalmente</button>
            <button id="btnImprimirSegunPaginaDeCodigos" class="button is-info mt-2">Imprimir usando página de
                códigos</button>
            <button id="btnImprimirTicket" class="button is-warning mt-2">Imprimir ticket con acentos</button>
        </div>
        <div class="column">
            <div class="notification is-warning">
                <p>
                    Al imprimir, el resultado debería ser parecido al siguiente:
                </p>
            </div>
            <img src="./img/Texto con acentos y página de códigos.jpg" alt="Ticket con acentos">
            <img src="./img/Imprimir-acentos-en-impresora-termica-con-JavaScript.jpg"
                alt="Imprimir acentos en impresora térmica con JavaScript">
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
        $btnImprimirSegunPaginaDeCodigos = document.querySelector("#btnImprimirSegunPaginaDeCodigos"),
        $btnImprimirTicket = document.querySelector("#btnImprimirTicket");

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
            imprimirAcentosConTextoNormal(nombreImpresora);
        });

        $btnImprimirSegunPaginaDeCodigos.addEventListener("click", () => {
            const nombreImpresora = $listaDeImpresoras.value;
            if (!nombreImpresora) {
                return alert("Por favor seleccione una impresora. Si no hay ninguna, asegúrese de haberla compartido como se indica en: https://parzibyte.me/blog/2017/12/11/instalar-impresora-termica-generica/")
            }
            imprimirAcentosConPaginaDeCodigos(nombreImpresora);
        });

        $btnImprimirTicket.addEventListener("click", () => {
            const nombreImpresora = $listaDeImpresoras.value;
            if (!nombreImpresora) {
                return alert("Por favor seleccione una impresora. Si no hay ninguna, asegúrese de haberla compartido como se indica en: https://parzibyte.me/blog/2017/12/11/instalar-impresora-termica-generica/")
            }
            imprimirTicketConAcentos(nombreImpresora);
        });
    }

    const imprimirTicketConAcentos = async (nombreImpresora) => {
        const conector = new ConectorPluginV3(URLPlugin);
        conector.EstablecerTamañoFuente(1, 1);
        conector.EstablecerEnfatizado(false);
        conector.EstablecerAlineacion(ConectorPluginV3.ALINEACION_CENTRO);
        conector.DescargarImagenDeInternetEImprimir("https://ssb.wiki.gallery/images/f/f7/SSBU_spirit_Cuphead.png", ConectorPluginV3.TAMAÑO_IMAGEN_NORMAL, 160);
        conector.Feed(1);
        conector.EscribirTexto("Parzibyte's blog\n");
        conector.EscribirTexto("Blog de un programador\n");
        conector.DeshabilitarElModoDeCaracteresChinos();
        // Recuerda que si tu impresora soporta acentos sin configuración adicional solo debes invocar a EscribirTExto
        conector.TextoSegunPaginaDeCodigos(2, "cp850", "Teléfono: 123456789\n");
        conector.EscribirTexto("Fecha/Hora: 2021-02-08 16:57:55\n");
        conector.EstablecerEnfatizado(true);
        conector.EscribirTexto("Cliente: ");
        conector.EstablecerEnfatizado(false);
        conector.TextoSegunPaginaDeCodigos(2, "cp850", "María José\n");
        conector.EscribirTexto("--------------------------------\n");
        conector.EscribirTexto("Audífonos HyperX\n");
        conector.EstablecerAlineacion(ConectorPluginV3.ALINEACION_DERECHA);
        conector.EscribirTexto("25 USD\n");
        conector.EscribirTexto("--------------------------------\n");
        conector.EscribirTexto("TOTAL: 25 USD\n");
        conector.EscribirTexto("--------------------------------\n");
        conector.EstablecerAlineacion(ConectorPluginV3.ALINEACION_CENTRO);
        conector.TextoSegunPaginaDeCodigos(2, "cp850", "¡Muchas gracias por su compra y feliz año nuevo 2021!");
        conector.Feed(4);
        conector.Corte(1);
        conector.CorteParcial();
        const respuesta = await conector
            .imprimirEn(nombreImpresora);
        if (respuesta === true) {
            alert("Impreso correctamente");
        } else {
            alert("Error: " + respuesta);
        }
    }

    const imprimirAcentosConPaginaDeCodigos = async (nombreImpresora) => {
        const conector = new ConectorPluginV3(URLPlugin);
        conector.Iniciar();
        conector.DeshabilitarElModoDeCaracteresChinos(); // Recuerda que tal vez no necesites invocar a este método si tu impresora no es china
        conector.TextoSegunPaginaDeCodigos(2, "cp850", "cp850 con numero 2 ¿EL VELOZ MURCIÉLAGO HINDÚ COMÍA FELIZ CARDILLO Y KIWI? ¡LA CIGÜEÑA TOCABA EL SAXOFÓN DETRÁS DEL PALENQUE DE PAJA!.");
        conector.Feed(1);
        conector.TextoSegunPaginaDeCodigos(2, "cp850", "cp850 con numero 2 ¿el veloz murciélago hindú comía feliz cardillo y kiwi? ¡la cigüeña tocaba el saxofón detrás del palenque de paja!.");
        conector.Feed(1);
        const respuesta = await conector
            .imprimirEn(nombreImpresora);
        if (respuesta === true) {
            alert("Impreso correctamente");
        } else {
            alert("Error: " + respuesta);
        }
    }
    const imprimirAcentosConTextoNormal = async (nombreImpresora) => {
        const conector = new ConectorPluginV3(URLPlugin);
        conector.Iniciar();
        conector.EscribirTexto("¡Gracias por su compra, María José!\nFeliz año nuevo");
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