<?php

namespace App\Http\Controllers;

use App\Models\ChatConsultation;
use App\Models\Consultation;

class ChatConsultationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $consultations = Consultation::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        return view('chat-consultations.index', compact('consultations'));
    }

    public function otaIndex()
    {
        $consultations = Consultation::where('ota_id', auth()->user()->id)->orderBy('id', 'desc')->get();

        return view('chat-consultations.index', compact('consultations'));
    }

    public function store()
    {
        $consultation = Consultation::find(request('consultation_id'));

        if (strtotime($consultation->end_time) <= time()) {
            return redirect()->back()->with('error', 'Consultation has been ended');
        }

        request()->validate([
            'message' => 'required|string',
        ]);


        if (auth()->user()->id == $consultation->user_id) {
            $receiverId = $consultation->ota_id;
        } else $receiverId = $consultation->user_id;

        ChatConsultation::create([
            'consultation_id' => $consultation->id,
            'receiver_id' => $receiverId,
            'sender_id' => auth()->user()->id,
            'message' => request('message'),
        ]);

        return redirect()->back();
    }

    public function show(Consultation $consultation)
    {

        if ($consultation->start_time == null && $consultation->is_eligible == 1) {
            $consultation->update([
                'start_time' => date('d-m-Y H:i'),
                'end_time' => date('d-m-Y H:i', strtotime('+1 hour')),
            ]);
        }

        $chatConsultations = ChatConsultation::where('consultation_id', $consultation->id)->get();
        return view('chat-consultations.show', compact('chatConsultations', 'consultation'));
    }
}
