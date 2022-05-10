@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="mb-0">Daftar Dokter</h3>
                <a class="btn btn-primary" href="/dokter/create">Tambah Dokter</a>
            </div>
            <div class="card-body">
                <table id="table-dokter" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Dokter</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pasien as $items)
                        <tr>
                            <td>{{$items->nama}}</td>
                            <td>
                                <a href="/dokter/create/{{$items->id}}" class="btn btn-success">Edit</a>
                                <a href="/dokter/destroy/{{$items->id}}" class="btn btn-danger">Hapus</a>
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
    $('#table-dokter').dataTable({
        responsive : true,
    });
</script>
@endsection
