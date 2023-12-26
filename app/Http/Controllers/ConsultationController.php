<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\User;

class ConsultationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $consultants = User::where('role', 'OTA')->get();

        return view('consultations.index', compact('consultants'));
    }

    public function create(User $consultant)
    {
        return view('consultations.create', compact('consultant'));
    }

    public function store()
    {
        if (request()->payment_type == 'BAL') {
            User::find(auth()->user()->id)->update([
                'balance' => auth()->user()->balance - 40000,
            ]);

            $consultant = User::find(request('consultant_id'));
            $consultant->balance += 40000;
            $consultant->save();

            $isEligible = true;
            $proofNameToStore = NULL;
        } else {
            request()->validate([
                'transfer_proof' => 'required|image|max:1999',
            ]);

            if (request()->hasFile('transfer_proof')) {
                $extension = request()->file('transfer_proof')->getClientOriginalExtension();
                $proofNameToStore = 'PROOF_' . time() . '.' . $extension;
                request()->file('transfer_proof')->storeAs('public/proof/', $proofNameToStore);
            } else {
                $proofNameToStore = NULL;
            }
            $isEligible = false;
        }

        Consultation::create([
            'price' => 40000,
            'transfer_proof' => $proofNameToStore,
            'is_eligible' => $isEligible,
            'user_id' => auth()->user()->id,
            'ota_id' => request('consultant_id'),
        ]);

        return redirect()->route('chat-consultations.index')->with('success', 'Consultation Transaction success');
    }

    public function confirm(Consultation $consultation)
    {
        $consultation->update([
            'is_eligible' => true,
        ]);

        return redirect()->back()->with('success', 'Consultation confirmed');
    }
}
