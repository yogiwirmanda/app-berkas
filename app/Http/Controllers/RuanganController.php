<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $dataRuangan = Ruangan::all();
        return view('ruangan.index', ['ruangan' => $dataRuangan]);
    }

    public function create($id = '')
    {
        $dataRuangan = [];
        if (strlen($id) > 0) {
            $dataRuangan = Ruangan::find($id);
        }
        return view('ruangan.create', ['id' => $id, 'dataRuangan' => $dataRuangan]);
    }

    public function store(Request $request)
    {
        $nama = $request->nama;
        $checkRuangan = Ruangan::where('nama', $nama)->first();

        if (!$checkRuangan) {
            $dataCreate = [];
            $dataCreate['nama'] = $nama;
            $ruangan = Ruangan::create($dataCreate);
        }

        return \redirect('ruangan/index');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $nama = $request->nama;
        $checkRuangan = Ruangan::find($id);

        if ($checkRuangan) {
            $checkRuangan->nama = $nama;
            $checkRuangan->save();
        }

        return \redirect('ruangan/index');
    }

    public function destroy($id)
    {
        $checkRuangan = Ruangan::find($id);
        $checkRuangan->status = 0;
        $checkRuangan->save();

        return \redirect('/ruangan/index');
    }
}
