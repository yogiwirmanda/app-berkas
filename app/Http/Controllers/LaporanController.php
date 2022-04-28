<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $dataLaporan = Berkas::select('berkas.*', 'p.no_rm', 'p.nama as namaPasien')
            ->join('pasien as p', 'p.id', 'berkas.id_pasien')
            ->where('berkas.status', 0)
            ->get();
        return view('laporan.index', ['berkas' => $dataLaporan]);
    }

    public function ruangan($bulan = '')
    {
        $dataRuangan = Ruangan::all();
        $dataBuild = [];

        if (strlen($bulan) == 0) {
            $bulan = Date('m');
        }

        foreach ($dataRuangan as $ruangan) {
            $dataTemp = [];
            $totalBerkas = 0;
            $totalBerkasTepat = 0;

            $dataBerkas = Berkas::selectRaw('count(id) as total')
                ->where('id_ruangan', $ruangan->id)
                ->whereMonth('tanggal_mrs', $bulan)
                ->first();

            $dataBerkasJam = Berkas::selectRaw('count(id) as total')
                ->where('id_ruangan', $ruangan->id)
                ->where('jam', '<=', 24)
                ->whereMonth('tanggal_mrs', $bulan)
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

            $dataTemp['id'] = $ruangan->id;
            $dataTemp['ruangan'] = $ruangan->nama;
            $dataTemp['total'] = $totalBerkas;
            $dataTemp['t'] = $totalBerkasTepat;
            $dataTemp['tt'] = $totalBerkasTidakTepat;
            $dataTemp['t_percent'] = \number_format($totalBerkasTepatPercent, 2);
            $dataTemp['tt_percent'] = \number_format($totalBerkasTidakTepatPercent, 2);
            $dataBuild[] = $dataTemp;
        }

        return view('laporan.ruangan', ['ruangan' => $dataBuild, 'bulan' => $bulan]);
    }
}
