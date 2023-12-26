<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Checkout;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckoutController extends Controller
{
    public function index()
    {
        $checkouts = Checkout::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        return view('checkout.index', compact('checkouts'));
    }

    public function create(Booking $booking)
    {
        $day = intval(round((strtotime($booking->check_out) - strtotime($booking->check_in)) / (60 * 60 * 24)));
        return view('checkout.create', compact('booking', 'day'));
    }

    public function store()
    {
        $booking = Booking::find(request('booking_id'));
        $day = intval(round((strtotime($booking->check_out) - strtotime($booking->check_in)) / (60 * 60 * 24)));
        $totalPayment = $booking->room->price * $booking->quantity * $day;
        $healthProtocolFee = $booking->quantity * $booking->room->accomodation->health_protocol_fee + request('addition');

        if (request()->payment_type == 'BAL') {
            User::find(auth()->user()->id)->update([
                'balance' => auth()->user()->balance - $totalPayment - $healthProtocolFee,
            ]);
            $proofNameToStore = NULL;
            $isSuccess = true;
        } else {
            request()->validate([
                'transfer_proof' => 'required|image|max:1999|mimes:jpg,png,jpeg',
            ]);

            if (request()->hasFile('transfer_proof')) {
                $extension = request()->file('transfer_proof')->getClientOriginalExtension();
                $proofNameToStore = 'PROOF_' . time() . '.' . $extension;
                request()->file('transfer_proof')->storeAs('public/proof/', $proofNameToStore);
            } else {
                $proofNameToStore = NULL;
            }
            $isSuccess = false;
        }

        Checkout::create([
            'booking_id' => $booking->id,
            'payment_type' => request('payment_type'),
            'is_success' => $isSuccess,
            'total_payment' => $totalPayment + $healthProtocolFee,
            'user_id' => auth()->user()->id,
            'transfer_proof' => $proofNameToStore,
            'rating' => false
        ]);

        return redirect()->route('checkouts.index')->with('success', 'Checkout Success');
    }

    public function history()
    {
        $historys = Checkout::where('user_id', Auth::user()->id)->get();

        return view('checkout.history', compact('historys'));
    }
}
