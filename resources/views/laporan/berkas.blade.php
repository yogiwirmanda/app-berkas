@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="mb-0">Laporan Berkas Belum Kembali (Total {{$dataTotal}})</h3>
                <div class="row">
                    <div class="col-md-12 d-flex">
                        <select name="bulan" id="bulan" class="form-control mx-2">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        <select name="ruangan" id="ruangan" class="form-control">
                            @foreach($ruangan as $items)
                            <option value="{{$items->id}}">{{$items->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="table-pasien" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No RM</th>
                            <th>Nama Pasien</th>
                            <th>Ruangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($berkas as $key => $items)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$items->no_rm}}</td>
                            <td>{{$items->namaPasien}}</td>
                            <td>{{$items->namaRuangan}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script-view')
<script>
    $(document).ready(function(e){
        $('#table-pasien').dataTable({
            responsive : true,
        });
        $('#bulan').val({{$bulan}});
        $('#bulan').change(function(e){
            let getRuangan = $('#ruangan').val();
            let getValue = $(this).val();
            window.location.href = '/laporan/berkas/' + getRuangan + '/' + getValue;
        })
        $('#ruangan').change(function(e){
            let getRuangan = $(this).val();
            let getValue = $('#bulan').val();
            window.location.href = '/laporan/berkas/' + getRuangan + '/' + getValue;
        })
    })
</script>
@endsection
