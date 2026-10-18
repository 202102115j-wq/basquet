# Verificar que la Parte 1 funciona en Laragon

Tras iniciar MySQL en Laragon y abrir la terminal dentro del proyecto:

```powershell
composer install
php artisan --version
php artisan route:list
php artisan migrate
php artisan test
php artisan serve
```

- Si falla `php -v`, abre la terminal desde el menu de Laragon y utiliza PHP 8.2 o superior.
- Si falla `composer install`, comprueba internet y las extensiones PHP que Composer indique.
- Si las pruebas informan que falta `could not find driver`, activa `extension=pdo_sqlite` y `extension=sqlite3` para el PHP de Laragon y reinicia la terminal.
- Las pruebas de PHPUnit utilizan SQLite en memoria, no borran tu base MySQL.
- Si ya hay datos no uses `migrate:fresh`, solo `php artisan migrate`.
- Revisa la pestana **Actions** de GitHub despues de `git push` para comprobar las pruebas automaticas del repositorio.
