	<div class="container">
		<div class="columns">
			<div class="column">
				<h1 class="is-size-1">Print barcode</h1>
			</div>
		</div>
		<div class="columns">
			<div class="notification is-info">
				In this example an EAN_13 code is printed by using
				<code> ImprimirCodigoDeBarrasEan</code>, and the plugin also supports:
				Codabar,
				Code 128,
				Code 39,
				Code 93,
				Ean,
				Ean8,
				PDF417,
				Two of Five ITF,
				UPC A and
				UPC E. Check the docs to see the full list and arguments
			</div>
		</div>
		<div class="columns">
			<div class="column">
				<div class="select is-rounded">
					<select id="listaDeImpresoras"></select>
				</div>
				<br>
				<div class="field">
					<label class="label">Write the EAN barcode content</label>
					<div class="control">
						<input id="contenido" value="5901234123457" class="input" type="text" placeholder="Here goes the barcode">
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
			</div>
			<div class="column">
				<div class="notification is-warning">
					<p>
						When printing, the result receipt should be as follows:
					</p>
				</div>
				<img src="./img/Código de barras EAN 13 con impresora térmica.jpg" alt="Código de barras EAN 13 en una impresora térmica">
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
			$contenido = document.querySelector("#contenido"),
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
				imprimirCodigoDeBarras(nombreImpresora);
			});
		}


		const imprimirCodigoDeBarras = async (nombreImpresora) => {
			const contenido = $contenido.value;
			if (!contenido) {
				return alert("Escribe el contenido del código de barras");
			}
			const conector = new ConectorPluginV3(URLPlugin);
			const algoritmo = parseInt($algoritmo.value);
			const alto = 80;
			const ancho = 184;
			conector.Iniciar();
			conector.EstablecerAlineacion(ConectorPluginV3.ALINEACION_CENTRO);
			// En la PT-210 me permite imprimir uno de 80 de alto por 400 de ancho
			conector.ImprimirCodigoDeBarrasEan(contenido, alto, ancho, algoritmo);
			conector.Iniciar(); // En mi impresora PT-210 debo invocar a "Iniciar" cada vez que imprimo una imagen
			conector.EstablecerAlineacion(ConectorPluginV3.ALINEACION_CENTRO);
			conector.Feed(1);
			conector.EscribirTexto(contenido);
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