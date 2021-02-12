<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function updateIconUser(Request $request) {

      $this -> deleteIconUser();

      $request -> validate([
        'icon' => 'required|file'
      ]);

      $image = $request -> file('icon');

      $ext = $image -> getClientOriginalExtension();
      $name = rand(100000, 9999999) . '_' . time();
      $FileImg = $name . '.' . $ext;

      $file = $image -> storeAs('icon', $FileImg, 'public');

      $user = Auth::user();
      $user -> icon = $FileImg;
      $user -> save();

      return redirect() -> back();

    }

    public function clearIconUser() {

      $this -> deleteIconUser();

      $user = Auth::user();
      $user -> icon = null;
      $user -> save();

      return redirect() -> back();

    }

    private function deleteIconUser() {

      $user = Auth::user();

      try {

        $fileName = $user -> icon;

        $file = storage_path('app/public/icon/' . $fileName);
        $res = File::delete($file);

      } catch(\Exception $e) {}

    }
}
