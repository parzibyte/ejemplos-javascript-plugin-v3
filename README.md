# Nuevo: prueba el diseñador de tickets

Acabo de crear un diseñador de recibos para impresoras térmicas en donde podrás diseñar tickets ESC POS, importar, exportar, generar el código para varios lenguajes de programación y revisar una guía paso a paso para descargar, instalar y usar el plugin. Pruébalo en: https://parzibyte.me/apps/ticket-designer/#/first-steps

# Aviso sobre la API
Estos ejemplos están obsoletos. Se recomienda
usar el nuevo sitio para la documentación centralizada donde
encontrarás ejemplos, área de pruebas y documentación completa:

Español: https://parzibyte.me/http-esc-pos-desktop-docs/es/
Inglés: https://parzibyte.me/http-esc-pos-desktop-docs/

# Imprimir en impresora térmica desde JavaScript

Ejemplos para usar el plugin gratuito e imprimir recibos en impresoras térmicas desde JavaScript sin pedir confirmación del usuario.

Presentación: https://parzibyte.me/blog/2019/08/01/imprimir-ticket-impresora-termica-javascript-plugin/

Navega por los ejemplos: https://parzibyte.github.io/ejemplos-javascript-plugin-v3/

# Documentación para generar HTML
No modifiques los archivos HTML, debes modificar los archivos PHP dentro de la carpeta `generar` y `generar/en`

Una vez que hayas modificado lo necesario, genera los archivos HTML invocando al script `generar/_generar.php`. El HTML generado será colocado en la carpeta raíz del proyecto

Suponiendo que tienes el proyecto en http://localhost/ejemplos-javascript-plugin-v3/ debes navegar a http://localhost/ejemplos-javascript-plugin-v3/generar/_generar.php para generar los archivos estáticos.