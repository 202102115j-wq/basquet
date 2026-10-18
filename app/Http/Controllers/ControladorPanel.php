<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ControladorPanel extends Controlador
{
    public function index(): View
    {
        return view('panel');
    }
}
