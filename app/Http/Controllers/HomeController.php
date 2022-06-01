<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\Ruangan;
use Carbon\Carbon;
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
            $dataTotalRuangan[] = Berkas::where('id_ruangan', $ruang->id)->whereMonth('created_at', 5)->count();
            $total24[] = Berkas::where('id_ruangan', $ruang->id)->where('jam', 24)->whereMonth('created_at', 5)->count();
            $totalNo24[] = Berkas::where('id_ruangan', $ruang->id)->where('jam', 36)->whereMonth('created_at', 5)->count();

            $totalBerkas = 0;
            $totalBerkasTepat = 0;

            $dataBerkas = Berkas::selectRaw('count(id) as total')
                ->where('id_ruangan', $ruang->id)
                ->whereMonth('tanggal_mrs', 5)
                ->first();

            $dataBerkasJam = Berkas::selectRaw('count(id) as total')
                ->where('id_ruangan', $ruang->id)
                ->where('jam', '<=', 24)
                ->whereMonth('tanggal_mrs', 5)
                ->first();

            if ($dataBerkas) {
                $totalBerkas = (int) $dataBerkas->total;
            }
            if ($dataBerkasJam) {
                $totalBerkasTepat = (int) $dataBerkasJam->total;
            }

            $totalBerkasTidakTepat = 0;
            $totalBerkasTepatPercent = 0;
            $totalBerkasTidakTepatPercent = 0;

            if ($totalBerkas > 0) {
                $totalBerkasTidakTepat = (int) ($totalBerkas - $totalBerkasTepat);
                $totalBerkasTepatPercent = ($totalBerkasTepat / $totalBerkas) * 100;
                $totalBerkasTidakTepatPercent = ($totalBerkasTidakTepat / $totalBerkas) * 100;
            }

            $percentTepat[] = \number_format($totalBerkasTepatPercent, 2);
            $percentTidakTepat[] = \number_format($totalBerkasTidakTepatPercent, 2);
        }

        $dayEnd = Date('d', strtotime(Carbon::now()->endOfMonth()));
        $monthNow = 5;
        $yearNow = Date('Y');

        $labelHari = [];
        $totalHari = [];
        for ($i = 1; $i<=$dayEnd;$i++) {
            $labelHari[] = $i;
            $totalHari[] = Berkas::where('tanggal_kembali', $yearNow.'-'.$monthNow.'-'.$i)->count();
        }

        return view('home', [
            'ruangan' => json_encode($dataRuangan),
            'ruanganTotal' => json_encode($dataTotalRuangan),
            'total24' => json_encode($total24),
            'totalNo24' => json_encode($totalNo24),
            'percentTepat' => json_encode($percentTepat),
            'percentTidakTepat' => json_encode($percentTidakTepat),
            'labelHari' => json_encode($labelHari),
            'totalHari' => json_encode($totalHari),
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
