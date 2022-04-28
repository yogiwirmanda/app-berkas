@extends('layouts.main')
@section('content')
@php
$noRm = '';
$nama = '';
$urlForm = route('pasien_save');
if (!is_array($dataPasien)){
$noRm = $dataPasien->no_rm;
$nama = $dataPasien->nama;
$urlForm = route('pasien_update');
}
@endphp
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Form Pasien</h3>
            </div>
            <div class="card-body">
                <form action="{{$urlForm}}" method="POST">
                    @csrf
                    @if(strlen($id) > 0)
                    <input type="hidden" name="id" value="{{$id}}">
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" name="no_rm" id="no_rm" class="form-control" value="{{$noRm}}"
                                        placeholder="No RM">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="nama" id="nama_pasien"
                                        value="{{$nama}}" placeholder="Nama Pasien">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
