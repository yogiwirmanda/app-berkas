<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        $dataDokter = Dokter::where('status', 1)->get();
        return view('dokter.index', ['pasien' => $dataDokter]);
    }

    public function create($id = '')
    {
        $dataDokter = [];
        if (strlen($id) > 0) {
            $dataDokter = Dokter::find($id);
        }
        return view('dokter.create', ['id' => $id, 'dataDokter' => $dataDokter]);
    }

    public function store(Request $request)
    {
        $nama = $request->nama;
        $checkPasien = Dokter::where('nama', $nama)->first();

        if (!$checkPasien) {
            $dataCreate = [];
            $dataCreate['nama'] = $nama;
            $dokter = Dokter::create($dataCreate);
        }

        return \redirect('dokter/index');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $nama = $request->nama;
        $checkDokter = Dokter::find($id);

        if ($checkDokter) {
            $checkDokter->nama = $nama;
            $checkDokter->save();
        }

        return \redirect('dokter/index');
    }

    public function destroy($id)
    {
        $checkDokter = Dokter::find($id);
        $checkDokter->status = 0;
        $checkDokter->save();

        return \redirect('/dokter/index');
    }
}
