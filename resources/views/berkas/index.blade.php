@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="mb-0">Daftar Berkas</h3>
                @if (Auth::id() != 2)
                    <a class="btn btn-primary" href="/berkas/create">Tambah Berkas</a>
                @endif
            </div>
            <div class="card-body">
                <table id="table-pasien" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>Nama Dokter</th>
                            <th>Nama Ruangan</th>
                            <th>Tanggal Mrs</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($berkas as $key => $items)
                        <tr class="{{($items->status == 1) ? 'bg-danger text-white' : '' }}">
                            <td>{{$key + 1}}</td>
                            <td>{{$items->namaPasien}}</td>
                            <td>{{$items->namaDokter}}</td>
                            <td>{{$items->namaRuangan}}</td>
                            <td>{{$items->tanggal_mrs}}</td>
                            <td>{{($items->status == 1) ? 'Keluar' : 'Kembali'}}</td>
                            <td>
                                @if($items->status == 1)
                                    @if (Auth::id() == 2)
                                        <a href="/berkas/kembali/{{$items->id}}" class="btn btn-primary">Kembali</a>
                                    @else
                                        <a href="/berkas/edit/{{$items->id}}" class="btn btn-primary">Edit</a>
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
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
    $('#table-pasien').dataTable();

</script>
@endsection
