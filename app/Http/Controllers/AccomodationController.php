<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accomodation;
use App\Models\City;
use Illuminate\Support\Facades\Storage;

class AccomodationController extends Controller
{
    public function index()
    {
        $check_in = strtotime($_GET['check_in']);
        $check_out = strtotime($_GET['check_out']);
        $qty = $_GET['qty'];

        if ($check_in == null) {
            return back()->with('error', 'Please select your check-in date');
        }
        if ($check_out == null) {
            return back()->with('error', 'Please select your check-out date');
        }
        if ($qty == null || $qty == 0) {
            return back()->with('error', 'Please select your reserved room quantity');
        }
        if ($check_in >= $check_out) {
            return back()->with('error', 'Check in cannot be more than Check out');
        }

        if ($_GET['place'] != null && $_GET['city_id'] != null) {
            $accomodations = Accomodation::where([['name', 'LIKE', '%' . $_GET['place'] . '%'], ['city_id', $_GET['city_id']]])->get();
            $city = City::find($_GET['city_id']);
        } else if ($_GET['place'] != null) {
            $accomodations = Accomodation::where('name', 'LIKE', '%' . $_GET['place'] . '%')->get();
            $city = null;
        } else if ($_GET['city_id'] != null) {
            $accomodations = Accomodation::where('city_id', $_GET['city_id'])->get();
            $city = City::find($_GET['city_id']);
        } else {
            return back()->with('error', 'Please input either city or place');
        }

        if ($accomodations->count() == 0) {
            return back()->with('error', 'No accomodations found');
        }

        return view('accomodation.index', compact('accomodations', 'city', 'check_in', 'check_out'));
    }

    public function indexCreate()
    {
        return view('accomodation.create');
    }

    public function show(Request $request)
    {

        $accomodations = Accomodation::all();
        return view('accomodation.show', compact('accomodations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'category' => 'required',
            'photo' => 'image|max:10240',
            'city' => 'required|max:255',
            'address' => 'required',
        ]);
        $path = null;

        if ($request->photo) {
            $path = $request->file('photo')->store('images');
        }
        Accomodation::create([
            'name' => $request->name,
            'category_id' => $request->category,
            'photo' => $path,
            'city' => $request->city,
            'address' => $request->address
        ]);


        return redirect('/');
    }

    public function delete($id)
    {
        $accomodation = Accomodation::find($id);
        Storage::delete($accomodation->photo);
        $accomodation->delete();

        return redirect()->back();
    }
}
