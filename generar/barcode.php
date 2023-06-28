	<div class="container">
		<div class="columns">
			<div class="column">
				<h1 class="is-size-1">Imprimir código de barras</h1>
			</div>
		</div>
		<div class="columns">
			<div class="notification is-info">
				En este caso vamos a imprimir un código de barras EAN_13 con
				<code> ImprimirCodigoDeBarrasEan</code>, pero el plugin soporta:
				Codabar,
				Code 128,
				Code 39,
				Code 93,
				Ean,
				Ean8,
				PDF417,
				Two of Five ITF,
				UPC A y
				UPC E. Mira la documentación para saber más sobre los parámetros
			</div>
		</div>
		<div class="columns">
			<div class="column">
				<div class="select is-rounded">
					<select id="listaDeImpresoras"></select>
				</div>
				<br>
				<div class="field">
					<label class="label">Escribe el contenido del código de barras EAN:</label>
					<div class="control">
						<input id="contenido" value="5901234123457" class="input" type="text"
							placeholder="Aquí va el código de barras">
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
			conector.Iniciar();
			conector.EstablecerAlineacion(ConectorPluginV3.ALINEACION_CENTRO);
			// En la PT-210 me permite imprimir uno de 80 de alto por 400 de ancho
			conector.ImprimirCodigoDeBarrasEan(contenido, 80, 184, ConectorPluginV3.TAMAÑO_IMAGEN_NORMAL);
			conector.Iniciar(); // En mi impresora PT-210 debo invocar a "Iniciar" cada vez que imprimo una imagen
			conector.EstablecerAlineacion(ConectorPluginV3.ALINEACION_CENTRO);
			conector.Feed(1);
			conector.EscribirTexto(contenido);
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