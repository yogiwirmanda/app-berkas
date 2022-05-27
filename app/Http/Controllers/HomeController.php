<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
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
        $ruangan = Ruangan::select('nama', 'id')->where('status', 1)->get();
        $dataRuangan = [];
        $dataTotalRuangan = [];
        $total24 = [];
        $totalNo24 = [];
        foreach ($ruangan as $ruang) {
            $dataRuangan[] = $ruang->nama;
            $dataTotalRuangan[] = Berkas::where('id_ruangan', $ruang->id)->count();
            $total24[] = Berkas::where('id_ruangan', $ruang->id)->where('jam', 24)->count();
            $totalNo24[] = Berkas::where('id_ruangan', $ruang->id)->where('jam', 36)->count();
        }

        return view('home', [
            'ruangan' => json_encode($dataRuangan),
            'ruanganTotal' => json_encode($dataTotalRuangan),
            'total24' => json_encode($total24),
            'totalNo24' => json_encode($totalNo24),
        ]);
    }

    public function updateBerkas()
    {
        $berkas = Berkas::all();
        foreach ($berkas as $items) {
            $getBerkas = Berkas::find($items->id);
            $date1=date_create($getBerkas->tanggal_krs);
            $date2=date_create($getBerkas->tanggal_kembali);
            $diff = date_diff($date1, $date2);
            $selisih = (int) $diff->format("%a");
            if ($selisih <= 2) {
                $jam = 24;
            } else {
                $jam = 36;
            }
            $getBerkas->jam = $jam;
            $getBerkas->save();
        }
    }
}
