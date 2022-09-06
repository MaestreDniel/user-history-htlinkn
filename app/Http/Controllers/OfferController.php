<?php

namespace App\Http\Controllers;

use App\Models\PromotionalCode;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Illuminate\Support\Str;

class OfferController extends Controller
{
    /**
     * The main page of the app, inside the are some example offers, and a random code is prepared
     * giving the user the ability to own the code.
     */
    public function index() 
    {
        $offers = Offer::query()->latest()->paginate(15);
        $code_generate = Str::random(16);
        $user = Auth::user()->id;

        return Inertia::render('UserHistory/Offers', [
            'offers' => $offers,
            'code' => $code_generate,
            'user_id' => $user,
        ]);
    }

    /**
     * Shows detail page with the promotional codes that belong to the user.
     */
    public function detail() 
    {
        $user = Auth::user()->id;
        $codes = PromotionalCode::query()->where('user_id', $user)->latest()->paginate(15);

        return Inertia::render('UserHistory/Detail', [
            'codes' => $codes,
        ]);
    }

    /**
     * When user clicks the button 'obtener código', code will be saved in database and a flash
     * success message will appear.
     */
    public function store_code(Request $request) 
    {
        $code_generate = PromotionalCode::create(
            $request->validate([
                'code' => 'size:16',
                'user_id' => 'required'
            ])
        );

        $code_generate->save();

        return Redirect::route('detail')->with('success', 'Tu código de promoción se ha generado correctamente');
    }

    /**
     * The user will confirm the code redeem in this page.
     */
    public function redeem_confirmation(PromotionalCode $code) 
    {
        return Inertia::render('UserHistory/Redeem', [
            'code' => $code
        ]);
    }

    /**
     * This is where the code becomes redeemed, and notifies the user with a flash message about the redemption.
     */
    public function redeem_code(Request $request, PromotionalCode $code) 
    {
        $validator = Validator::make($request->except('_method'), [
            'is_redeemed' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::route('detail')->with('error', 'Ha habido algún problema al intentar canjear el código');
        }

        $code = PromotionalCode::where('id', $code->id)->update([
            'is_redeemed' => $request->is_redeemed,
        ]);

        return Redirect::route('detail')->with('success', 'Has canjeado tu código de promoción correctamente');
    }
}
