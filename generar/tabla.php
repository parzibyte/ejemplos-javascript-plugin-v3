	<div class="container">
		<div class="columns">
			<div class="column">
				<h1 class="is-size-1">Imprimir tabla</h1>
			</div>
		</div>
		<div class="columns">
			<div class="column">
				<div class="select is-rounded">
					<select id="listaDeImpresoras"></select>
				</div>
				<div class="field">
					<label class="label">Separador</label>
					<div class="control">
						<input id="separador" value="|" class="input" type="text" maxlength="1"
							placeholder="El separador de columnas">
					</div>
				</div>
				<div class="field">
					<label class="label">Relleno</label>
					<div class="control">
						<input id="relleno" value=" " class="input" type="text" maxlength="1"
							placeholder="El relleno de las celdas">
					</div>
				</div>
				<div class="field">
					<label class="label">Máxima longitud para el nombre</label>
					<div class="control">
						<input id="maximaLongitudNombre" value="19" class="input" type="number">
					</div>
				</div>
				<div class="field">
					<label class="label">Máxima longitud para la cantidad</label>
					<div class="control">
						<input id="maximaLongitudCantidad" value="5" class="input" type="number">
					</div>
				</div>
				<div class="field">
					<label class="label">Máxima longitud para el precio</label>
					<div class="control">
						<input id="maximaLongitudPrecio" value="5" class="input" type="number">
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
				<img src="./img/Tabla.jpg" alt="Tabla impresa con impresora térmica">
			</div>
		</div>
		<div class="columns has-text-centered">
			<div class="column">
				<p>
					<a href="https://parzibyte.me/blog">Proudly brought to you by Parzibyte</a>
				</p>
			</div>
		</div>
	</div>
	<script>
		// Las siguientes 3 funciones fueron tomadas de: https://parzibyte.me/blog/2023/02/28/javascript-tabular-datos-limite-longitud-separador-relleno/
		// No tienen que ver con el plugin, solo son funciones de JS creadas por mí para tabular datos y enviarlos
		// a cualquier lugar
		const separarCadenaEnArregloSiSuperaLongitud = (cadena, maximaLongitud) => {
			const resultado = [];
			let indice = 0;
			while (indice < cadena.length) {
				const pedazo = cadena.substring(indice, indice + maximaLongitud);
				indice += maximaLongitud;
				resultado.push(pedazo);
			}
			return resultado;
		}
		const dividirCadenasYEncontrarMayorConteoDeBloques = (contenidosConMaximaLongitud) => {
			let mayorConteoDeCadenasSeparadas = 0;
			const cadenasSeparadas = [];
			for (const contenido of contenidosConMaximaLongitud) {
				const separadas = separarCadenaEnArregloSiSuperaLongitud(contenido.contenido, contenido.maximaLongitud);
				cadenasSeparadas.push({ separadas, maximaLongitud: contenido.maximaLongitud });
				if (separadas.length > mayorConteoDeCadenasSeparadas) {
					mayorConteoDeCadenasSeparadas = separadas.length;
				}
			}
			return [cadenasSeparadas, mayorConteoDeCadenasSeparadas];
		}
		const tabularDatos = (cadenas, relleno, separadorColumnas) => {
			const [arreglosDeContenidosConMaximaLongitudSeparadas, mayorConteoDeBloques] = dividirCadenasYEncontrarMayorConteoDeBloques(cadenas)
			let indice = 0;
			const lineas = [];
			while (indice < mayorConteoDeBloques) {
				let linea = "";
				for (const contenidos of arreglosDeContenidosConMaximaLongitudSeparadas) {
					let cadena = "";
					if (indice < contenidos.separadas.length) {
						cadena = contenidos.separadas[indice];
					}
					if (cadena.length < contenidos.maximaLongitud) {
						cadena = cadena + relleno.repeat(contenidos.maximaLongitud - cadena.length);
					}
					linea += cadena + separadorColumnas;
				}
				lineas.push(linea);
				indice++;
			}
			return lineas;
		}


		const obtenerListaDeImpresoras = async () => {
			return await ConectorPluginV3.obtenerImpresoras();
		}
		const URLPlugin = "http://localhost:8000"
		const $listaDeImpresoras = document.querySelector("#listaDeImpresoras"),
			$btnImprimir = document.querySelector("#btnImprimir"),
			$separador = document.querySelector("#separador"),
			$relleno = document.querySelector("#relleno"),
			$maximaLongitudNombre = document.querySelector("#maximaLongitudNombre"),
			$maximaLongitudCantidad = document.querySelector("#maximaLongitudCantidad"),
			$maximaLongitudPrecio = document.querySelector("#maximaLongitudPrecio");

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
				imprimirTabla(nombreImpresora);
			});
		}


		const imprimirTabla = async (nombreImpresora) => {
			const maximaLongitudNombre = parseInt($maximaLongitudNombre.value),
				maximaLongitudCantidad = parseInt($maximaLongitudCantidad.value),
				maximaLongitudPrecio = parseInt($maximaLongitudPrecio.value),
				relleno = $relleno.value,
				separadorColumnas = $separador.value;
			const obtenerLineaSeparadora = () => {
				const lineasSeparador = tabularDatos(
					[
						{ contenido: "-", maximaLongitud: maximaLongitudNombre },
						{ contenido: "-", maximaLongitud: maximaLongitudCantidad },
						{ contenido: "-", maximaLongitud: maximaLongitudPrecio },
					],
					"-",
					"+",
				);
				let separadorDeLineas = "";
				if (lineasSeparador.length > 0) {
					separadorDeLineas = lineasSeparador[0]
				}
				return separadorDeLineas;
			}
			// Simple lista de ejemplo. Obviamente tú puedes traerla de cualquier otro lado,
			// definir otras propiedades, etcétera
			const listaDeProductos = [
				{
					nombre: "Impresora térmica 58mm",
					cantidad: 10,
					precio: 600,
				},
				{
					nombre: "The Legend of Zelda: Tears of the kingdom",
					cantidad: 1,
					precio: 1600,
				},
				{
					nombre: "Resident Evil 4: remake",
					cantidad: 1,
					precio: 1200,
				},
			];
			// Comenzar a diseñar la tabla
			let tabla = obtenerLineaSeparadora() + "\n";


			const lineasEncabezado = tabularDatos([
				{ contenido: "Nombre", maximaLongitud: maximaLongitudNombre },
				{ contenido: "Cantidad", maximaLongitud: maximaLongitudCantidad },
				{ contenido: "Precio", maximaLongitud: maximaLongitudPrecio },
			],
				relleno,
				separadorColumnas,
			);

			for (const linea of lineasEncabezado) {
				tabla += linea + "\n";
			}
			tabla += obtenerLineaSeparadora() + "\n";
			for (const producto of listaDeProductos) {
				const lineas = tabularDatos(
					[
						{ contenido: producto.nombre, maximaLongitud: maximaLongitudNombre },
						{ contenido: producto.cantidad.toString(), maximaLongitud: maximaLongitudCantidad },
						{ contenido: producto.precio.toString(), maximaLongitud: maximaLongitudPrecio },
					],
					relleno,
					separadorColumnas
				);
				for (const linea of lineas) {
					tabla += linea + "\n";
				}
				tabla += obtenerLineaSeparadora() + "\n";
			}
			console.log(tabla);



			const conector = new ConectorPluginV3(URLPlugin);
			conector
				.Iniciar()
				.EscribirTexto("A continuación vemos una tabla: ")
				.Feed(1)
				.EscribirTexto(tabla)
				.Feed(2);
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