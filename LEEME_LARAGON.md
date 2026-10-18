# Liga de Basquetbol - Parte 1 de 8: Autenticacion

Estructura de Laravel y registro, inicio y cierre de sesión, panel protegido.

Esta parte contiene el **estado acumulado del proyecto**, no solamente los nuevos archivos.
Usa siempre tu unica carpeta y repositorio local: `C:\Users\Usuario\Desktop\sofware\Liga_Basquet`.
Github: https://github.com/202102115j-wq/LIGA-.git

## Copiar esta parte a la carpeta que ya tienes

1. Extrae el ZIP y entra en `Liga_Basquet`.
2. Copia los archivos y carpetas de dentro a `C:\Users\Usuario\Desktop\sofware\Liga_Basquet` y acepta reemplazar.
3. **Conserva** `.git`, `.env`, `vendor/` y `composer.lock` que hayas generado en tu computadora. Nunca sobrescribas `.env`, ni borres datos de MySQL.
4. Si acabas de empezar desde cero, copia `.env.example` a `.env` y personaliza la conexion MySQL. No vuelvas a copiarlo en partes posteriores.

## Abrir desde la Terminal de Laragon

```powershell
cd "C:\Users\Usuario\Desktop\sofware\Liga_Basquet"
php -v
composer --version
composer install
```

La primera vez solamente:

```powershell
Copy-Item .env.example .env
php artisan key:generate
```

> Si usas la terminal **CMD** (y no PowerShell), utiliza `copy .env.example .env`.
> No vuelvas a generar APP_KEY cuando tu instalacion ya funcione.
> Laravel 12 necesita PHP 8.2 o superior, extensiones requeridas por Composer y MySQL/MariaDB.

Inicia **Start All** de Laragon. En la terminal, crea la base solo si falta:

```powershell
mysql -u root -e "CREATE DATABASE IF NOT EXISTS liga_basquet CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

Si root tiene clave, ajusta credenciales en `.env` y crea la base desde el administrador de Laragon.
En `.env` utiliza `DB_CONNECTION=mysql`, `DB_DATABASE=liga_basquet` y los valores reales de tu servidor.

```powershell
php artisan migrate
php artisan db:seed
php artisan route:list
php artisan test
php artisan serve
```

Abre `http://127.0.0.1:8000`. Para el usuario de ejemplo: `admin@liga.test` / `password123` (solo desarrollo local).
Las pruebas usan una base de datos **SQLite en memoria**; habilita `pdo_sqlite` en el PHP de Laragon si no esta activo.
Puedes ejecutar `configurar_laragon.bat` usando **CMD de Laragon** si prefieres instalar con un asistente; el archivo aplica `migrate` sin borrar tablas.
**Nunca ejecutes `migrate:fresh` al pasar de una parte a otra**: elimina la informacion existente.

## GitHub - un commit por avance real

El repositorio ya tiene el remote `origin` y el primer commit de la Parte 1.
Desde VS Code:

```powershell
cd "C:\Users\Usuario\Desktop\sofware\Liga_Basquet"
git status
git add .
git commit -m "Parte 1: autenticacion"
git push
```

No vuelvas a ejecutar `git init`, `git remote add origin` ni a borrar `.git`. Los archivos `.env`, `vendor/` y logs deben estar fuera del versionado.
En la entrega final de Classroom comprime tu carpeta local con su `.git` real si te solicitan incluir el historial; omite credenciales y otros secretos al compartir publicamente.
