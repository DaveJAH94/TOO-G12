Sistema Informático para TOO115 - Grupo 12 / año2021

<h2>ANTES DE CLONAR EL REPOSITORIO</h2>

INSTALACIÓN XAMPP Y LARAVEL:
- Descargar Xampp x64 7.4.24 (Descargar de página oficial)
- Descargar Composer (Obtener de: https://getcomposer.org/download/ )
- Descargar NODEJS (Obtener de pagina oficial: https://nodejs.org/es/ )
    (despues de instalarlo, reiniciar la computadora)
    Verificar la versión con los comandos:
        node -v
        npm -v

<h2>CLONAR EL REPOSITORIO</h2>
(Se aconseja hacerlo en la dirección de los tutoriales: "C:\xampp\htdocs\")

-Correr los siguientes comandos despues de clonar el repositorio:
composer update --no-scripts
npm install
npm run dev

- Luego iniciar el servidor php con el comando:
    php artisan serve

- Para verificar correcto funcionamiento, asegurarse que Apache esté corriendo (en xampp) y en el navegador escribir:
    localhost:8000
        (si existen problemas con el puerto, configurar el apache en el puerto 8080, y cambiar la dirección del navegador por "localhost:8080")