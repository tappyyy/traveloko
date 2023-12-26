<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $profile = Auth::user();
        return view('user.index', compact('profile'));
    }

    public function update(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|numeric',
            'password' => 'required'
        ]);

        $profile = User::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'password' => Hash::make($request->password)
        ]);

        $profile = User::find($id);

        return view('user.index', compact('profile'));
    }
}
