<?php

namespace App\Http\Controllers;

use App\Models\CodigoPromocional;
use App\Models\Oferta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Str;

class OfertaController extends Controller
{
    public function index() 
    {
        $oferta = Oferta::query()->latest()->paginate(15);
        $codigo_generado = Str::random(16);
        $usuario = Auth::user()->id;

        return Inertia::render('UserHistory/Ofertas', [
            'ofertas' => $oferta,
            'codigo' => $codigo_generado,
            'user_id' => $usuario,
        ]);
    }

    public function detail() 
    {
        $usuario = Auth::user()->id;
        $codigo = CodigoPromocional::query()->where('user_id', $usuario)->latest()->paginate(15);

        return Inertia::render('UserHistory/Detalle', [
            'codigos' => $codigo,
        ]);
    }

    public function store(Request $request) 
    {
        $codigo_generado = CodigoPromocional::create(
            $request->validate([
                'codigo' => 'size:16',
                'user_id' => 'required'
            ])
        );

        $codigo_generado->save();
    }

    public function canjear_codigo(Request $request) {
        
    }
}
