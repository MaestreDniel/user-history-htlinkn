<?php

namespace App\Http\Controllers;

use App\Models\CodigoPromocional;
use App\Models\Oferta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Illuminate\Support\Str;

class OfertaController extends Controller
{
    /**
     * La página principal de la aplicación, en la que se muestran las ofertas de ejemplo,
     * y prepara un código de promoción aleatorio que el usuario podría adquirir.
     */
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

    /**
     * Muestra la página de detalle con los códigos de promoción que pertenecen al usuario,
     * no debe mostrar los que han adquirido otras personas.
     */
    public function detalle() 
    {
        $usuario = Auth::user()->id;
        $codigo = CodigoPromocional::query()->where('user_id', $usuario)->latest()->paginate(15);

        return Inertia::render('UserHistory/Detalle', [
            'codigos' => $codigo,
        ]);
    }

    /**
     * Cuando el usuario pulsa el botón de 'obtener código', este se guarda en la base de datos 
     * y se notifica el éxito de la operación.
     */
    public function almacena_codigo(Request $request) 
    {
        $codigo_generado = CodigoPromocional::create(
            $request->validate([
                'codigo' => 'size:16',
                'user_id' => 'required'
            ])
        );

        $codigo_generado->save();

        return Redirect::route('detalle')->with('success', 'Tu código de promoción se ha generado correctamente');
    }

    /**
     * Es un apartado donde se debe confirmar el canjeo.
     */
    public function confirma_canjeo(CodigoPromocional $codigo) 
    {
        return Inertia::render('UserHistory/Canjeo', [
            'codigo' => $codigo
        ]);
    }

    /**
     * Hace efectivo el canjeo del código promocional. Este controlador marca como canjeado el código
     * promocional que se había solicitado anteriormente y notifica al usuario si la operación tuvo éxito.
     */
    public function canjear_codigo(Request $request, CodigoPromocional $codigo) 
    {
        $validator = Validator::make($request->except('_method'), [
            'is_canjeado' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::route('detalle')->with('error', 'Ha habido algún problema al intentar canjear el código');
        }

        $codigo = CodigoPromocional::where('id', $codigo->id)->update([
            'is_canjeado' => $request->is_canjeado,
        ]);

        return Redirect::route('detalle')->with('success', 'Has canjeado tu código de promoción correctamente');
    }
}
