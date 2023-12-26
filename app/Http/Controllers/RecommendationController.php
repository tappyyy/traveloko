<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use App\Models\Recommendation;
use Illuminate\Support\Collection;

class RecommendationController extends Controller
{
    public function index()
    {
        $recommendations = Recommendation::where('ota_id', auth()->user()->id)->get();
        return view('recommendations.index', compact('recommendations'));
    }

    public function search()
    {
        $key = $_GET['key'];
        if ($key != NULL) {
            $accomodations = Accomodation::where('name', 'LIKE', '%' . $_GET['key'] . '%')->get();
        } else {
            $accomodations = new Collection();
        }

        return view('recommendations.search', compact('accomodations', 'key'));
    }

    public function create(Accomodation $accomodation)
    {
        return view('recommendations.create', $accomodation);
    }

    public function store()
    {
        request()->validate([
            'comment' => 'required|string',
        ]);

        Recommendation::create([
            'accomodation_id' => request('accomodation_id'),
            'ota_id' => auth()->user()->id,
            'comment' => request('comment'),
        ]);

        return redirect()->route('recommendations.index')->with('success', 'Recommendation added');
    }

    public function delete(Accomodation $accomodation)
    {
        $accomodation->delete();
        return redirect()->back()->with('success', 'Delete success');
    }
}
