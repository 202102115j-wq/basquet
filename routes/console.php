<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('liga:info', function () {
    $this->comment('Sistema de Gestion de Liga de Basquetbol');
})->purpose('Muestra informacion del proyecto');
