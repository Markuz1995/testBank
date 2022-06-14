## Configuración inicial
- Se debe crear una base de datos llamada bank
- configurar los datos mostrados en las variables de entorno archivo .env
```php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bank
DB_USERNAME=root
DB_PASSWORD=
```
- Se luego se debe correr las migraciones para que se generen las tablas en la base de datos.
- Correr el siguiente comando en la consola a nivel raiz del proyecto
```php
php artisan migrate
```

- Luego se deben ejecutar los seeders para que genere usuarios por defecto 
```php
php artisan db:seed
```

- Este comando genera datos de pruebas para usuarios usando estas credenciales
```php
 cedula: 1234567891  "Incrementando el ultimo valor en 1"
 contrase: 1234      "Contraseña de 4 digitos que despues sera encryptada"
```