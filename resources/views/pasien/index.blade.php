@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="mb-0">Daftar Pasien</h3>
                <a class="btn btn-primary" href="/pasien/create">Tambah Pasien</a>
            </div>
            <div class="card-body">
                <table id="table-pasien" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No RM</th>
                            <th>Nama Pasien</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pasien as $items)
                        <tr>
                            <td>{{$items->no_rm}}</td>
                            <td>{{$items->nama}}</td>
                            <td>
                                <a href="/pasien/create/{{$items->id}}" class="btn btn-success">Edit</a>
                                <a href="/pasien/destroy/{{$items->id}}" class="btn btn-danger">Hapus</a>
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
