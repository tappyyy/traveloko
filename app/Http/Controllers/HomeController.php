<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use App\Models\City;
use App\Models\Recommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('dashboard');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cities = City::all();
        $accomodations = Recommendation::select('accomodation_id', DB::raw('count(*) as total'))->groupBy('accomodation_id')
            ->orderBy('total', 'desc')->take(4)->get();

        return view('home', compact('cities', 'accomodations'));
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function covidinfo()
    {
        return view('covid.index');
    }

    public function covidnews()
    {
        return view('covid.news');
    }

    public function term()
    {
        return view('term');
    }

    public function about()
    {
        return view('about');
    }
}
