<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class BerkasController extends Controller
{
    public function index()
    {
        $dataBerkas = Berkas::select(
            'berkas.*',
            'd.nama as namaDokter',
            'p.nama as namaPasien',
            'p.no_rm as noRM',
            'r.nama as namaRuangan'
        )
            ->join('dokter as d', 'd.id', 'berkas.id_dokter')
            ->join('pasien as p', 'p.id', 'berkas.id_pasien')
            ->join('ruangan as r', 'r.id', 'berkas.id_ruangan')
            ->get();
        return view('berkas.index', ['berkas' => $dataBerkas]);
    }

    public function create($id = '')
    {
        $dataPasien = Pasien::all();
        $dataDokter = Dokter::all();
        $dataRuangan = Ruangan::all();
        return view('berkas.create', ['id' => $id, 'pasien' => $dataPasien, 'dokter' => $dataDokter, 'ruangan' => $dataRuangan]);
    }

    public function edit($id = '')
    {
        $berkas = Berkas::select(
            'berkas.*',
            'd.nama as namaDokter',
            'p.nama as namaPasien',
            'p.no_rm as noRM',
            'r.nama as namaRuangan'
        )
            ->join('dokter as d', 'd.id', 'berkas.id_dokter')
            ->join('pasien as p', 'p.id', 'berkas.id_pasien')
            ->join('ruangan as r', 'r.id', 'berkas.id_ruangan')
            ->where('berkas.id', $id)
            ->first();

        return view('berkas.edit', ['id' => $id, 'noRM' => $berkas->noRM, 'namaPasien' => $berkas->namaPasien, 'namaDokter' => $berkas->namaDokter, 'namaRuangan' => $berkas->namaRuangan, 'keterangan' => $berkas->ket, 'tgl' => $berkas->tanggal_mrs]);
    }

    public function store(Request $request)
    {
        $noRm = $request->no_rm;
        $nama = $request->nama;
        $idDokter = $request->dokter;
        $idRuangan = $request->ruangan;
        $ket = $request->keterangan;
        $tgl = $request->tanggal_mrs;
        $checkPasien = Pasien::where('no_rm', $noRm)->first();

        if ($checkPasien) {
            $idPasien = $checkPasien->id;
        } else {
            $dataCreate = [];
            $dataCreate['no_rm'] = $noRm;
            $dataCreate['nama'] = $nama;
            $pasien = Pasien::create($dataCreate);
            $idPasien = $pasien->id;
        }

        $dataBerkas = [];
        $dataBerkas['id_pasien'] = $idPasien;
        $dataBerkas['id_dokter'] = $idDokter;
        $dataBerkas['tanggal_mrs'] = $tgl;
        $dataBerkas['id_ruangan'] = $idRuangan;
        $dataBerkas['ket'] = $ket;
        $create = Berkas::create($dataBerkas);

        return \redirect('berkas/index');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $noRm = $request->no_rm;
        $nama = $request->nama;
        $berkas = Berkas::find($id);

        if ($berkas) {
            $berkas->tanggal_mrs = $request->tanggal_mrs;
            $berkas->ket = $request->keterangan;
            $berkas->save();
        }

        return \redirect('berkas/index');
    }

    public function kembali(Request $request)
    {
        $id = $request->id;
        $tglKrs = Date('Y-m-d', strtotime($request->tgl_krs));
        $checkPasien = Berkas::find($id);

        $tglKembali = Date('Y-m-d');

        $date1=date_create($tglKrs);
        $date2=date_create($tglKembali);
        $diff = date_diff($date1, $date2);
        $selisih = (int) $diff->format("%a");
        if ($selisih == 2) {
            $jam = 24;
        } else {
            $jam = 36;
        }

        if ($checkPasien) {
            $checkPasien->status = 0;
            $checkPasien->tanggal_krs = $tglKrs;
            $checkPasien->tanggal_kembali = $tglKembali;
            $checkPasien->jam = $jam;
            $checkPasien->save();
        }

        return json_encode('success');
    }

    public function destroy($id)
    {
        $checkPasien = Berkas::find($id);
        $checkPasien->delete();

        return \redirect('/berkas/index');
    }

    public function checkPasienRM(Request $request)
    {
        $getRM = $request->no_rm;
        $pasien = Pasien::where('no_rm', $getRM)->first();
        $namaPasien = '';
        if ($pasien) {
            $namaPasien = $pasien->nama;
        }

        return json_encode($namaPasien);
    }
}
