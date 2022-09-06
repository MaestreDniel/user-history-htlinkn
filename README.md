## Prueba de User History
### Instrucciones para configurar el entorno local

- Clonar este repositorio
- En la consola/terminal, situarse en la carpeta principal del proyecto "user-history-htlinkn"
- Ejecutar ```composer update``` y ```npm install```
- Crear una base de datos local tipo SQL y ajustar las credenciales del .env, por ejemplo:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=user-history-htlinkn
DB_USERNAME=root
DB_PASSWORD=
```
- Ejecutar las migraciones y seeders: ```php artisan migrate``` y ```php artisan db:seed```
- Lanzar los servidores para back y front: ```php artisan serve``` y ```npm run dev```
- Ya se puede registrar el usuario para probar la aplicación