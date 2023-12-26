<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function index(Checkout $checkout)
    {
        if (auth()->user()->id == $checkout->user_id) {

            return view('ratings.index', compact('checkout'));
        } else abort(404);
    }

    public function store(Request $request)
    {
        $request->validate([
            'star' => 'required|numeric',
            'comment' => 'required|min:1',
            'accomodation_id' => 'required'
        ]);

        Rating::create([
            'star' => $request->star,
            'comment' => $request->comment,
            'accomodation_id' => $request->accomodation_id,
            'user_id' => Auth::user()->id
        ]);

        Checkout::find(request('checkout_id'))->update([
            'rating' => 1,
        ]);

        return redirect()->route('checkouts.index')->with('success', 'Rating Created');
    }
}
