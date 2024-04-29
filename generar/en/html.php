<div class="container-fluid">
    <label class="form-label" for="impresoras">Select a printer</label>
    <br>
    <select class="custom-select" name="" id="impresoras"></select>
    <br>
    <br>
    <label for="contenido">Input HTML to print:</label>
    <br>
    <div id="summernote">

        <div style="text-align: center;">
            <img style="max-height: 200px;" src="<?php printf("data:%s;base64,%s", mime_content_type("parzibyte.png"), base64_encode(file_get_contents("parzibyte.png"))) ?>">
            <p>I am the header</p>
            <p>
                Sale receipt #103 (Pending)</p>
            <p><strong>Branch:</strong> Principal</p>
            <p><strong>Customer: </strong> Parzibyte</p>
            <p>Apr 26, 2024, 9:23:16 AM</p>
        </div>
        <div>
            <h4>Items</h4>
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th>Qty.</th>
                        <th>Item</th>
                        <th>Discount %</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Computer Mouse</td>
                        <td>0%</td>
                        <td style="text-align: right;">$200.00</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Acer nitro computer</td>
                        <td>0%</td>
                        <td style="text-align: right;">$1,400.00</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Android phone</td>
                        <td>0%</td>
                        <td style="text-align: right;">$200.00</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="text-align: right; font-size: large;">
            <p>
            <p>Item count: <strong>4</strong></p>
            <strong>Total: </strong> $1,800.00
            </p>
        </div>

        <div style="text-align: right; font-size: large;">
            <p>
                <strong>Paid: </strong> $0.00
                <br>
                <strong>Remaining: </strong> $1,800.00
            </p>
        </div>
        <div style="text-align: center;">
            <p>And I am the footer</p>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-auto">
            <label for="ancho" class="form-label">Webpage width in millimeters</label>
            <input value="380" type="number" id="ancho" class="form-control" placeholder="Width">
        </div>
        <div class="col-auto">
            <label for="maximoAncho" class="form-label">Image max width when printing</label>
            <input value="380" type="number" id="maximoAncho" class="form-control" placeholder="Max width">
        </div>
        <div class="col-auto">
            <label for="serial" class="form-label">Serial (optional)</label>
            <input value="" type="text" id="serial" class="form-control" placeholder="Serial">
        </div>
    </div>
    <br>
    <button id="imprimir" class="btn btn-success">Print</button>
    <script>
        $(document).ready(() => {
            $("#summernote").summernote();
        });
        document.addEventListener("DOMContentLoaded", async () => {
            const $impresoras = document.querySelector("#impresoras"),
                $contenido = document.querySelector("#contenido"),
                $ancho = document.querySelector("#ancho"),
                $maximoAncho = document.querySelector("#maximoAncho"),
                $serial = document.querySelector("#serial");

            const $imprimir = document.querySelector("#imprimir");
            const imprimir = async () => {
                const htmlDelEditor = $("#summernote").summernote("code"); // Podría venir de cualquier lugar
                const html = `<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        table {
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 5px;
        }

        th {
            font-weight: bold;
        }
    </style>
</head>
<body>
${htmlDelEditor}
</body>
</html>`;
                const ancho = parseInt($ancho.value),
                    maximoAncho = parseInt($maximoAncho.value),
                    algoritmo = 1;

                const respuestaHttp = await fetch("http://localhost:8000/imprimir", {
                    method: "POST",
                    body: JSON.stringify({
                        nombreImpresora: $impresoras.value,
                        serial: $serial.value,
                        operaciones: [{
                                nombre: "Iniciar",
                                argumentos: []
                            },
                            {
                                nombre: "GenerarImagenAPartirDeHtmlEImprimir",
                                "argumentos": [html, ancho, maximoAncho, algoritmo]
                            }
                        ]
                    })
                });
                if (respuestaHttp.status === 200) {
                    alert("Impreso correctamente")
                } else {
                    const mensajeDeError = await respuestaHttp.text();
                    alert("Error: " + mensajeDeError)
                }
            }
            $imprimir.onclick = () => {
                imprimir();
            }
            const refrescarListaDeImpresoras = async () => {
                const respuestaHttp = await fetch("http://localhost:8000/impresoras");
                const impresoras = await respuestaHttp.json();
                for (const impresora of impresoras) {
                    const opcion = Object.assign(document.createElement("option"), {
                        value: impresora,
                        text: impresora,
                    });
                    $impresoras.appendChild(opcion);
                }
            }
            refrescarListaDeImpresoras();
        })
    </script>

</div>