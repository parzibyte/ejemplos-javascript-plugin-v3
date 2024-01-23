<div class="columns has-text-centered">
    <div class="column">
        <p>
            Orgullosamente presentado por <a href="https://parzibyte.me/blog">Parzibyte</a>.
            <strong>This site is open source. You can</strong>
            <a href="https://github.com/parzibyte/ejemplos-javascript-plugin-v3/">see the source code on GitHub</a>
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
    });
</script>
</body>

</html>