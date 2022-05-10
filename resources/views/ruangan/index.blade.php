@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="mb-0">Daftar Ruangan</h3>
                <a class="btn btn-primary" href="/ruangan/create">Tambah Ruangan</a>
            </div>
            <div class="card-body">
                <table id="table-ruangan" class="table table-bordered table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>Nama Ruangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ruangan as $items)
                        <tr>
                            <td>{{$items->nama}}</td>
                            <td>
                                <a href="/ruangan/create/{{$items->id}}" class="btn btn-success">Edit</a>
                                <a href="/ruangan/destroy/{{$items->id}}" class="btn btn-danger">Hapus</a>
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
    $('#table-ruangan').dataTable({
        responsive : true,
    });
</script>
@endsection
