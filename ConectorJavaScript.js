const ConectorPluginV3 = (() => {

    /**
     * Una clase para interactuar con el plugin v3
     *
     * @date 2022-09-28
     * @author parzibyte
     * @see https://parzibyte.me/blog
     */

    class Operacion {
        constructor(nombre, argumentos) {
            this.nombre = nombre;
            this.argumentos = argumentos;
        }
    }

    class ConectorPlugin {

        static URL_PLUGIN_POR_DEFECTO = "http://localhost:8000";
        static Operacion = Operacion;
        static TAMAÑO_IMAGEN_NORMAL = 0;
        static TAMAÑO_IMAGEN_DOBLE_ANCHO = 1;
        static TAMAÑO_IMAGEN_DOBLE_ALTO = 2;
        static TAMAÑO_IMAGEN_DOBLE_ANCHO_Y_ALTO = 3;
        static TAMAÑO_IMAGEN_DOBLE_ANCHO_Y_ALTO = 3;
        static ALINEACION_IZQUIERDA = 0;
        static ALINEACION_CENTRO = 1;
        static ALINEACION_DERECHA = 2;
        static RECUPERACION_QR_BAJA = 0;
        static RECUPERACION_QR_MEDIA = 1;
        static RECUPERACION_QR_ALTA = 2;
        static RECUPERACION_QR_MEJOR = 3;


        constructor(ruta) {
            if (!ruta) ruta = ConectorPlugin.URL_PLUGIN_POR_DEFECTO;
            this.ruta = ruta;
            this.operaciones = [];
            return this;
        }

        CargarImagenLocalEImprimir(ruta, tamaño, maximoAncho) {
            this.operaciones.push(new ConectorPlugin.Operacion("CargarImagenLocalEImprimir", Array.from(arguments)));
            return this;
        }
        Corte(lineas) {
            this.operaciones.push(new ConectorPlugin.Operacion("Corte", Array.from(arguments)));
            return this;
        }
        CorteParcial() {
            this.operaciones.push(new ConectorPlugin.Operacion("CorteParcial", Array.from(arguments)));
            return this;
        }
        DefinirCaracterPersonalizado(caracterRemplazo, matriz) {
            this.operaciones.push(new ConectorPlugin.Operacion("DefinirCaracterPersonalizado", Array.from(arguments)));
            return this;
        }
        DescargarImagenDeInternetEImprimir(urlImagen, tamaño, maximoAncho) {
            this.operaciones.push(new ConectorPlugin.Operacion("DescargarImagenDeInternetEImprimir", Array.from(arguments)));
            return this;
        }
        DeshabilitarCaracteresPersonalizados() {
            this.operaciones.push(new ConectorPlugin.Operacion("DeshabilitarCaracteresPersonalizados", Array.from(arguments)));
            return this;
        }
        DeshabilitarElModoDeCaracteresChinos() {

            this.operaciones.push(new ConectorPlugin.Operacion("DeshabilitarElModoDeCaracteresChinos", Array.from(arguments)));
            return this;
        }
        EscribirTexto(texto) {
            this.operaciones.push(new ConectorPlugin.Operacion("EscribirTexto", Array.from(arguments)));
            return this;
        }
        EstablecerAlineacion(alineacion) {
            this.operaciones.push(new ConectorPlugin.Operacion("EstablecerAlineacion", Array.from(arguments)));
            return this;
        }
        EstablecerEnfatizado(enfatizado) {
            this.operaciones.push(new ConectorPlugin.Operacion("EstablecerEnfatizado", Array.from(arguments)));
            return this;
        }
        EstablecerFuente(fuente) {
            this.operaciones.push(new ConectorPlugin.Operacion("EstablecerFuente", Array.from(arguments)));
            return this;
        }
        EstablecerImpresionAlReves(alReves) {
            this.operaciones.push(new ConectorPlugin.Operacion("EstablecerImpresionAlReves", Array.from(arguments)));
            return this;
        }
        EstablecerImpresionBlancoYNegroInversa(invertir) {
            this.operaciones.push(new ConectorPlugin.Operacion("EstablecerImpresionBlancoYNegroInversa", Array.from(arguments)));
            return this;
        }
        EstablecerRotacionDe90Grados(rotar) {
            this.operaciones.push(new ConectorPlugin.Operacion("EstablecerRotacionDe90Grados", Array.from(arguments)));
            return this;
        }
        EstablecerSubrayado(subrayado) {
            this.operaciones.push(new ConectorPlugin.Operacion("EstablecerSubrayado", Array.from(arguments)));
            return this;
        }
        EstablecerTamañoFuente(multiplicadorAncho, multiplicadorAlto) {
            this.operaciones.push(new ConectorPlugin.Operacion("EstablecerTamañoFuente", Array.from(arguments)));
            return this;
        }
        Feed(lineas) {
            this.operaciones.push(new ConectorPlugin.Operacion("Feed", Array.from(arguments)));
            return this;
        }
        HabilitarCaracteresPersonalizados() {
            this.operaciones.push(new ConectorPlugin.Operacion("HabilitarCaracteresPersonalizados", Array.from(arguments)));
            return this;
        }
        HabilitarElModoDeCaracteresChinos() {
            this.operaciones.push(new ConectorPlugin.Operacion("HabilitarElModoDeCaracteresChinos", Array.from(arguments)));
            return this;
        }
        ImprimirCodigoDeBarrasCodabar(contenido, alto, ancho, tamañoImagen) {

            this.operaciones.push(new ConectorPlugin.Operacion("ImprimirCodigoDeBarrasCodabar", Array.from(arguments)));
            return this;
        }

        ImprimirCodigoDeBarrasCode128(contenido, alto, ancho, tamañoImagen) {
            this.operaciones.push(new ConectorPlugin.Operacion("ImprimirCodigoDeBarrasCode128", Array.from(arguments)));
            return this;
        }
        ImprimirCodigoDeBarrasCode39(contenido, incluirSumaDeVerificacion, modoAsciiCompleto, alto, ancho, tamañoImagen) {
            this.operaciones.push(new ConectorPlugin.Operacion("ImprimirCodigoDeBarrasCode39", Array.from(arguments)));
            return this;
        }

        ImprimirCodigoDeBarrasCode93(contenido, alto, ancho, tamañoImagen) {
            this.operaciones.push(new ConectorPlugin.Operacion("ImprimirCodigoDeBarrasCode93", Array.from(arguments)));
            return this;
        }

        ImprimirCodigoDeBarrasEan(contenido, alto, ancho, tamañoImagen) {
            this.operaciones.push(new ConectorPlugin.Operacion("ImprimirCodigoDeBarrasEan", Array.from(arguments)));
            return this;
        }
        ImprimirCodigoDeBarrasEan8(contenido, alto, ancho, tamañoImagen) {
            this.operaciones.push(new ConectorPlugin.Operacion("ImprimirCodigoDeBarrasEan8", Array.from(arguments)));
            return this;
        }
        ImprimirCodigoDeBarrasPdf417(contenido, nivelSeguridad, alto, ancho, tamañoImagen) {
            this.operaciones.push(new ConectorPlugin.Operacion("ImprimirCodigoDeBarrasPdf417", Array.from(arguments)));
            return this;
        }
        ImprimirCodigoDeBarrasTwoOfFiveITF(contenido, intercalado, alto, ancho, tamañoImagen) {
            this.operaciones.push(new ConectorPlugin.Operacion("ImprimirCodigoDeBarrasTwoOfFiveITF", Array.from(arguments)));
            return this;
        }
        ImprimirCodigoDeBarrasUpcA(contenido, alto, ancho, tamañoImagen) {
            this.operaciones.push(new ConectorPlugin.Operacion("ImprimirCodigoDeBarrasUpcA", Array.from(arguments)));
            return this;
        }
        ImprimirCodigoDeBarrasUpcE(contenido, alto, ancho, tamañoImagen) {
            this.operaciones.push(new ConectorPlugin.Operacion("ImprimirCodigoDeBarrasUpcE", Array.from(arguments)));
            return this;
        }
        ImprimirCodigoQr(contenido, anchoMaximo, nivelRecuperacion, tamañoImagen) {
            this.operaciones.push(new ConectorPlugin.Operacion("ImprimirCodigoQr", Array.from(arguments)));
            return this;
        }
        ImprimirImagenEnBase64(imagenCodificadaEnBase64, tamaño, maximoAncho) {
            this.operaciones.push(new ConectorPlugin.Operacion("ImprimirImagenEnBase64", Array.from(arguments)));
            return this;
        }

        Iniciar() {
            this.operaciones.push(new ConectorPlugin.Operacion("Iniciar", Array.from(arguments)));
            return this;
        }

        Pulso(pin, tiempoEncendido, tiempoApagado) {
            this.operaciones.push(new ConectorPlugin.Operacion("Pulso", Array.from(arguments)));
            return this;
        }

        TextoSegunPaginaDeCodigos(numeroPagina, pagina, texto) {
            this.operaciones.push(new ConectorPlugin.Operacion("TextoSegunPaginaDeCodigos", Array.from(arguments)));
            return this;
        }


        static async obtenerImpresoras(ruta) {
            if (ruta) ConectorPlugin.URL_PLUGIN_POR_DEFECTO = ruta;
            const response = await fetch(ConectorPlugin.URL_PLUGIN_POR_DEFECTO + "/impresoras");
            return await response.json();
        }

        async imprimirEn(nombreImpresora) {
            const payload = {
                operaciones: this.operaciones,
                nombreImpresora,
            };
            const response = await fetch(this.ruta + "/imprimir", {
                method: "POST",
                body: JSON.stringify(payload),
            });
            return await response.json();
        }
    }
    return ConectorPlugin;
})();