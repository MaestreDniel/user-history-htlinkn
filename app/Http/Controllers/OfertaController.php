<?php

namespace App\Http\Controllers;

use App\Models\CodigoPromocional;
use App\Models\Oferta;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OfertaController extends Controller
{
    public function index() 
    {
        $oferta = Oferta::query()->latest()->paginate(15);

        return Inertia::render('UserHistory/Ofertas', [
            'ofertas' => $oferta,
        ]);
    }

    public function detail() 
    {
        $codigo = CodigoPromocional::query()->latest()->paginate(15);

        return Inertia::render('UserHistory/Detalle', [
            'codigos' => $codigo,
        ]);
    }
}
