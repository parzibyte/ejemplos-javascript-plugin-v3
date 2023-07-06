
    <div class="container">

        <div class="columns">
            <div class="column">
                <h1 class="is-size-1">Define custom character</h1>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="notification is-info">
                    <strong>You cannot define more than one custom char (it is limited by the printer), but you can
                        define many contained in only one. Please check:
                        </strong>
                    <a target="_blank" href="https://www.youtube.com/watch?v=SQ3JHv-HO1Q">this video</a> and
                    <a target="_blank" href="https://www.youtube.com/watch?v=avhXdhVLrBQ">this one</a> for a possible fix
                </div>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <button class="button is-primary m-2" id="btnRellenarBlanco">Fill with white</button>
                <button class="button is-primary m-2" id="btnRellenarNegro">Fill with black</button>
                <canvas style="border: 1px solid black;" id="canvas"></canvas>
                <br>
                <div class="field">
                    <label class="label">Printer</label>
                    <div class="select is-rounded">
                        <select id="listaDeImpresoras"></select>
                    </div>
                </div>
                <div class="field">
                    <label for="" class="label">The character will be defined by using the next string:</label>
                    <textarea readonly class="textarea" id="textareaCaracterPersonalizado" cols="12"
                        rows="24"></textarea>
                </div>
                <div class="field">
                    <label for="" class="label">Which character will be replaced by the custom one?</label>
                    <div class="control">
                        <input maxlength="1" class="input" type="text" id="caracterRemplazo">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Width multiplier:</label>
                    <div class="select is-rounded">
                        <select id="multiplicadorAncho">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Height multiplier</label>
                    <div class="select is-rounded">
                        <select id="multiplicadorAlto">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label for="" class="label">Write a message and make sure it contains the replaced character</label>
                    <div class="control">
                        <input class="input" type="text" id="mensaje">
                    </div>
                </div>
                <button id="btnImprimir" class="button is-success">Print</button>
            </div>
            <div class="column">
                <div class="notification is-warning">
                    <p>
                        When printing, the result receipt should be as follows:
                    </p>
                </div>
                <img src="./img/Caracteres personalizados en impresora térmica - Reemplazar letra por símbolo.jpg"
                    alt="Definir e imprimir caracteres personalizados en impresora térmica">
            </div>
        </div>
    </div>
    <script>

        const obtenerListaDeImpresoras = async () => {
            return await ConectorPluginV3.obtenerImpresoras();
        }
        const BIT_ENCENDIDO = "1",
            BIT_APAGADO = "0";
        const arregloDeCaracter = [
            ["0", "0", "0", "0", "0", "1", "1", "1", "1", "0", "0", "0"],
            ["0", "0", "0", "0", "1", "0", "0", "0", "0", "1", "0", "0"],
            ["0", "0", "0", "1", "0", "0", "0", "1", "1", "1", "1", "0"],
            ["0", "0", "0", "1", "0", "0", "1", "0", "0", "0", "0", "1"],
            ["0", "1", "1", "1", "0", "0", "1", "0", "0", "0", "0", "1"],
            ["0", "1", "0", "1", "0", "0", "1", "0", "0", "0", "0", "1"],
            ["0", "1", "0", "1", "0", "0", "1", "0", "0", "0", "0", "1"],
            ["0", "1", "0", "1", "0", "0", "0", "1", "1", "1", "1", "0"],
            ["0", "1", "0", "1", "0", "0", "0", "0", "0", "0", "1", "0"],
            ["0", "1", "1", "1", "0", "0", "0", "0", "0", "0", "1", "0"],
            ["0", "0", "0", "1", "0", "0", "1", "1", "1", "0", "1", "0"],
            ["0", "0", "0", "1", "0", "0", "1", "0", "1", "0", "1", "0"],
            ["0", "0", "0", "1", "1", "1", "1", "0", "1", "1", "1", "0"],
            ["0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0"],
            ["0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0"],
            ["0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0"],
            ["1", "1", "1", "0", "1", "0", "1", "0", "1", "1", "1", "0"],
            ["1", "0", "0", "0", "1", "0", "1", "0", "1", "0", "0", "0"],
            ["1", "1", "1", "0", "1", "0", "1", "0", "1", "1", "1", "0"],
            ["0", "0", "1", "0", "1", "0", "1", "0", "0", "0", "1", "0"],
            ["1", "1", "1", "0", "1", "1", "1", "0", "1", "1", "1", "0"],
            ["0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0"],
            ["0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0"],
            ["0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0"]
        ];
        const URLPlugin = "http://localhost:8000"
        const $listaDeImpresoras = document.querySelector("#listaDeImpresoras"),
            $btnImprimir = document.querySelector("#btnImprimir"),
            $btnRellenarBlanco = document.querySelector("#btnRellenarBlanco"),
            $btnRellenarNegro = document.querySelector("#btnRellenarNegro"),
            $textareaCaracterPersonalizado = document.querySelector("#textareaCaracterPersonalizado"),
            $caracterRemplazo = document.querySelector("#caracterRemplazo"),
            $mensaje = document.querySelector("#mensaje"),
            $multiplicadorAncho = document.querySelector("#multiplicadorAncho"),
            $multiplicadorAlto = document.querySelector("#multiplicadorAlto"),
            $canvas = document.querySelector("#canvas");

        function getCursorPosition(canvas, event) {
            const rect = canvas.getBoundingClientRect()
            const x = event.clientX - rect.left
            const y = event.clientY - rect.top
            return [x, y];
        }

        const convertirArregloACadenaParaCaracter = arreglo => {
            return arreglo.map(fila => fila.join("")).join("\n");
        }

        const MEDIDA_CUADRO = 30;
        $canvas.width = arregloDeCaracter[0].length * MEDIDA_CUADRO;
        $canvas.height = arregloDeCaracter.length * MEDIDA_CUADRO;
        const dibujar = () => {
            const contexto = $canvas.getContext("2d");
            // Tomado de https://parzibyte.me/blog/2020/10/31/dibujar-arreglo-canvas-javascript/

            // Comenzar a dibujar
            // x e y nos van a ayudar a dibujar usando las medidas de pixeles
            let y = 0, x = 0;
            for (const fila of arregloDeCaracter) {
                x = 0;
                for (const bit of fila) {
                    // Indicamos el color que usaremos
                    if (bit === BIT_ENCENDIDO) {
                        contexto.fillStyle = "black"
                    } else {
                        contexto.fillStyle = "white"
                    }
                    // Y creamos el rectángulo en la posición X con Y, usando la misma altura y anchura
                    contexto.fillRect(x, y, MEDIDA_CUADRO, MEDIDA_CUADRO);
                    x += MEDIDA_CUADRO;
                }
                y += MEDIDA_CUADRO;
            }
            $textareaCaracterPersonalizado.textContent = convertirArregloACadenaParaCaracter(arregloDeCaracter);
        };
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
                demostrarCaracterPersonalizado(nombreImpresora);
            });


            $canvas.addEventListener("click", (evento) => {
                const [x, y] = getCursorPosition($canvas, evento);
                const indiceX = Math.floor(x / MEDIDA_CUADRO), indiceY = Math.floor(y / MEDIDA_CUADRO);
                if (indiceX < 0 || indiceY < 0) {
                    return;
                }
                if (indiceX > arregloDeCaracter[0].length - 1 || indiceY > arregloDeCaracter.length - 1) {
                    return;
                }
                if (arregloDeCaracter[indiceY][indiceX] == BIT_APAGADO) {
                    arregloDeCaracter[indiceY][indiceX] = BIT_ENCENDIDO;
                } else {
                    arregloDeCaracter[indiceY][indiceX] = BIT_APAGADO;
                }
                dibujar();
            });

            $btnRellenarBlanco.addEventListener("click", () => {
                for (let y = 0; y < arregloDeCaracter.length; y++) {
                    for (let x = 0; x < arregloDeCaracter[y].length; x++) {
                        arregloDeCaracter[y][x] = BIT_APAGADO;
                    }
                }
                dibujar();
            });

            $btnRellenarNegro.addEventListener("click", () => {
                for (let y = 0; y < arregloDeCaracter.length; y++) {
                    for (let x = 0; x < arregloDeCaracter[y].length; x++) {
                        arregloDeCaracter[y][x] = BIT_ENCENDIDO;
                    }
                }
                dibujar();
            });
        }
        const demostrarCaracterPersonalizado = async (nombreImpresora) => {
            const conector = new ConectorPluginV3(URLPlugin);
            const caracterReemplazado = $caracterRemplazo.value;
            const mensaje = $mensaje.value;
            const caracterDeReemplazo = $textareaCaracterPersonalizado.textContent;
            if (!caracterReemplazado) {
                return alert("Input the replaced character");
            }
            if (!mensaje) {
                return alert("Write a message");
            }
            const multiplicadorAlto = parseInt($multiplicadorAlto.value);
            const multiplicadorAncho = parseInt($multiplicadorAncho.value);
            conector.Iniciar()
                .EstablecerTamañoFuente(multiplicadorAncho, multiplicadorAlto)
                .HabilitarCaracteresPersonalizados()
                .DefinirCaracterPersonalizado(caracterReemplazado, caracterDeReemplazo)
                .EscribirTexto(mensaje)
                .Feed(2);
            const respuesta = await conector
                .imprimirEn(nombreImpresora);
            if (respuesta === true) {
                alert("Printed successfully");
            } else {
                alert("Error: " + respuesta);
            }
        }
        init();
        dibujar();
    </script>