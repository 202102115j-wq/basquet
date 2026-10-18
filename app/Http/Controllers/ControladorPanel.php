<?php
namespace App\Http\Controllers;
use App\Models\Equipo;
use Illuminate\View\View;
class ControladorPanel extends Controlador
{
    public function index(): View
    {
        return view('panel', ['equipos' => Equipo::count()]);
    }
}
