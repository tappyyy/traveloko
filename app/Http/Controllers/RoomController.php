<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Rating;
use App\Models\Recommendation;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{

    public function index()
    {
        $qty = $_GET['qty'];
        $check_in = date('d-m-Y', $_GET['check_in']);
        $check_out = date('d-m-Y', $_GET['check_out']);
        $accomodation = Accomodation::find($_GET['accomodation_id']);
        $rooms = Room::where('accomodation_id', $_GET['accomodation_id'])->get();
        $ratings = Rating::where('accomodation_id', $_GET['accomodation_id'])->get();
        $recommendation = Recommendation::select(DB::raw('count(*) as total'))->where('accomodation_id', $_GET['accomodation_id'])->groupBy('accomodation_id')->first();
        return view('rooms.index', compact('rooms', 'accomodation', 'qty', 'check_in', 'check_out', 'ratings', 'recommendation'));
    }

    public function indexCreate()
    {
        return view('rooms.create');
    }

    //Accomodation Id harus di lempar"
    public function create(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'accomodation_id' => 'required|integer',
            'type' => 'required|string',
            'photo' => 'image|max:10240',
            'description' => 'required|string',
            'slot' => 'required|integer',
            'price' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return redirect(route('viewHome'))->withErrors($validator)->withInput();
        }

        $path = $request->file('room_photo')->store('images/public');

        Room::create([
            'accomodation_id' => $request->accomodation_id,
            'type' => $request->type,
            'photo' => $path,
            'description' => $request->description,
            'slot' => $request->slot,
            'price' => $request->price
        ]);
        return redirect('/rooms');
    }


    public function show()
    {
        $accomodation = Accomodation::find($_GET['accomodation_id']);
        $rooms = Room::where('accomodation_id', $_GET['accomodation_id'])->get();
        return view('rooms.show', compact('rooms', 'accomodation'));
    }

    public function edit($id)
    {
        $rooms = Room::find($id);
        return view('edit_room', compact('rooms'));
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'accomodation_id' => 'required|integer',
            'type' => 'required|string',
            'photo' => 'image|max:10240',
            'description' => 'required|string',
            'slot' => 'required|integer',
            'price' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect('/room/show_room');
        }

        $room = Room::find($id);
        Storage::delete($room->room_photo);

        $room->accomodation_id = $request->accomodation_id;
        $room->type = $request->type;
        $room->description = $request->description;
        $room->slot = $request->slot;
        $room->price = $request->price;
        if ($request->has('room_photo')) {
            $path = $request->file('room_photo')->store('images');
            $room->room_photo = $path;
        } else {
            $path = $room->path;
        }

        $room->save();
        return redirect('/room/show_room');
    }

    public function delete($id)
    {
        $room = Room::find($id);
        Storage::delete($room->room_photo);
        $room->delete();

        return redirect()->back();
    }
}
