@echo off
setlocal
cd /d "%~dp0"

echo =============================================
echo Liga de Basquetbol - Instalacion con Laragon
echo =============================================

where php >nul 2>&1
if errorlevel 1 (
 echo ERROR: Abra Laragon, pulse Start All y entre en Menu - Terminal.
 goto :error
)
where composer >nul 2>&1
if errorlevel 1 (
 echo ERROR: Composer no esta disponible desde esta terminal.
 goto :error
)
where mysql >nul 2>&1
if errorlevel 1 (
 echo ERROR: MySQL no esta disponible. Inicie MySQL en Laragon.
 goto :error
)

php -v
call composer --version
if errorlevel 1 goto :error

echo [1/4] Instalando dependencias de Laravel...
call composer install --no-interaction
if errorlevel 1 goto :error

echo [2/4] Preparando archivo .env y APP_KEY...
if not exist ".env" copy ".env.example" ".env" >nul
if not exist ".env" goto :error
powershell -NoProfile -Command "$texto=Get-Content -LiteralPath '.env' -Raw; if($texto -notmatch '(?m)^APP_KEY=\s*\S+'){exit 2}else{exit 0}"
if errorlevel 2 (
  php artisan key:generate
  if errorlevel 1 goto :error
)

echo [3/4] Preparando base de datos (sin borrar datos)...
mysql -u root -e "CREATE DATABASE IF NOT EXISTS liga_basquet CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
if errorlevel 1 (
 echo No fue posible crear la base con root sin clave.
 echo Cree liga_basquet manualmente y ajuste las credenciales en .env.
 goto :error
)

echo [4/4] Aplicando solo las migraciones pendientes...
php artisan migrate --force
if errorlevel 1 goto :error

echo.
echo Configuracion terminada. Opcional: php artisan db:seed
 echo Comprobar rutas: php artisan route:list
 echo Ejecutar pruebas: php artisan test
 echo Iniciar servidor: php artisan serve
pause
exit /b 0

:error
 echo CONFIGURACION DETENIDA. Revise el error anterior.
pause
exit /b 1
