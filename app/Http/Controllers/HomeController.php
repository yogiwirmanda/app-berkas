<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
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
        $ruangan = Ruangan::select('nama')->where('status', 1)->get();
        $dataRuangan = [];
        foreach ($ruangan as $ruang) {
            $dataRuangan[] = $ruang->nama;
        }

        return view('home', ['ruangan' => json_encode($dataRuangan)]);
    }
}
