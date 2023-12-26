<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Consultation;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $checkouts = Checkout::where('payment_type', 'LIKE', 'BNK')->where('is_success', '0')->get();

        $otas = Consultation::where('is_eligible', '0')->get();
        return view('admin.index', compact('checkouts', 'otas'));
    }

    public function accept($id)
    {
        Checkout::find($id)->update([
            'is_success' => '1'
        ]);
        return back()->with('success', 'Checkout Confirmed');
    }

    public function decline($id)
    {
        Checkout::find($id)->update([
            'is_success' => '3'
        ]);
        return back()->with('success', 'Checkout declined');
    }

    public function otaaccept($id)
    {
        Consultation::find($id)->update([
            'is_eligible' => '1'
        ]);
        return back()->with('success', 'Consultation Confirmed');
    }

    public function otadecline($id)
    {
        Consultation::find($id)->update([
            'is_eligible' => '3'
        ]);
        return
            back()->with('success', 'Consultation declined');
    }
}
