<div class="columns has-text-centered">
    <div class="column">
        <p>
            Proudly brought to you by <a href="https://parzibyte.me/blog">Parzibyte</a>.
            <strong>Este sitio es open source, puedes</strong>
            <a href="https://github.com/parzibyte/ejemplos-javascript-plugin-v3/">ver el código fuente en GitHub</a>
        </p>
    </div>
</div>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", () => {
        const boton = document.querySelector(".navbar-burger");
        const menu = document.querySelector(".navbar-menu");
        boton.onclick = () => {
            menu.classList.toggle("is-active");
            boton.classList.toggle("is-active");
        };
        const url = "https://estadisticasusoprogramas.parzibyte.repl.co/contador/registrar_visita.php";
        const payload = {
            pagina: document.title,
            url: window.location.href,
        };
        fetch(url, {
            method: "POST",
            body: JSON.stringify(payload),
        });
    });
</script>
</body>

</html>