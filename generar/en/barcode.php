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
						<input id="contenido" value="5901234123457" class="input" type="text"
							placeholder="Here goes the barcode">
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
				<img src="./img/Código de barras EAN 13 con impresora térmica.jpg"
					alt="Código de barras EAN 13 en una impresora térmica">
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
			$contenido = document.querySelector("#contenido");

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
				imprimirCodigoDeBarras(nombreImpresora);
			});
		}


		const imprimirCodigoDeBarras = async (nombreImpresora) => {
			const contenido = $contenido.value;
			if (!contenido) {
				return alert("Write the barcode content");
			}
			const conector = new ConectorPluginV3(URLPlugin);
			conector.Iniciar();
			conector.EstablecerAlineacion(ConectorPluginV3.ALINEACION_CENTRO);
			// On my PT-210 I am able to print a 80x400 barcode
			conector.ImprimirCodigoDeBarrasEan(contenido, 80, 184, ConectorPluginV3.TAMAÑO_IMAGEN_NORMAL);
			conector.Iniciar(); // On my PT-210 I must call Iniciar after I print an image
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