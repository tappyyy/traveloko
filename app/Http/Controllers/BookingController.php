<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use PDO;

class BookingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $bookings = Booking::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $qty = $_GET['qty'];
        $check_in = $_GET['check_in'];
        $check_out = $_GET['check_out'];
        $room = Room::find($_GET['room_id']);
        return view('bookings.create', compact('room', 'qty', 'check_in', 'check_out'));
    }

    public function store()
    {
        if (auth()->user()->role == 'OTA') {

            request()->validate([
                'user_id' => 'required|integer',
            ]);

            $userId = request('user_id');
        } else {
            $userId = auth()->user()->id;
        }

        Booking::create([
            'user_id' => $userId,
            'room_id' => request('room_id'),
            'quantity' => request('quantity'),
            'check_in' => request('check_in'),
            'check_out' => request('check_out'),
            'packet' => request('packet'),
        ]);

        if (auth()->user()->role == 'OTA') {
            return redirect()->route('bookings.index')->with('success', 'Booking created');
        } else {
            return redirect()->route('bookings.index')->with('success', 'Booking created');
        }
    }

}
