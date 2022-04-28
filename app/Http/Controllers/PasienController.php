<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        $dataPasien = Pasien::where('status', 1)->get();
        return view('pasien.index', ['pasien' => $dataPasien]);
    }

    public function create($id = '')
    {
        $dataPasien = [];
        if (strlen($id) > 0) {
            $dataPasien = Pasien::find($id);
        }
        return view('pasien.create', ['id' => $id, 'dataPasien' => $dataPasien]);
    }

    public function store(Request $request)
    {
        $noRm = $request->no_rm;
        $nama = $request->nama;
        $checkPasien = Pasien::where('no_rm', $noRm)->first();

        if (!$checkPasien) {
            $dataCreate = [];
            $dataCreate['no_rm'] = $noRm;
            $dataCreate['nama'] = $nama;
            $pasien = Pasien::create($dataCreate);
        }

        return \redirect('pasien/index');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $noRm = $request->no_rm;
        $nama = $request->nama;
        $checkPasien = Pasien::find($id);

        if ($checkPasien) {
            $checkPasien->no_rm = $noRm;
            $checkPasien->nama = $nama;
            $checkPasien->save();
        }

        return \redirect('pasien/index');
    }

    public function destroy($id)
    {
        $checkPasien = Pasien::find($id);
        $checkPasien->status = 0;
        $checkPasien->save();

        return \redirect('/pasien/index');
    }
}
