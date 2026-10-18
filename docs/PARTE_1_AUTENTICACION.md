# Parte 1 — Base y autenticación

Primera etapa: proyecto Laravel configurado para Laragon, migración de usuarios, registro, inicio de sesión, cierre de sesión y panel protegido.

## Verificación en Laragon

```bat
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

Usuario de demostración: `admin@liga.test` / `password123`.
