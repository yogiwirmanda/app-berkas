@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="mb-0">Laporan 2x24</h3>
            </div>
            <div class="card-body">
                <table id="table-pasien" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No RM</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal KRS</th>
                            <th>Tanggal Kembali</th>
                            <th>Kembali 2x24</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($berkas as $items)
                        <tr>
                            <td>{{$items->no_rm}}</td>
                            <td>{{$items->namaPasien}}</td>
                            <td>{{$items->tanggal_krs}}</td>
                            <td>{{$items->tanggal_kembali}}</td>
                            <td>
                                @php
                                    $tglMrs = $items->tanggal_mrs;
                                    $tglKembali = $items->tanggal_kembali;
                                    $hourdiff = round((strtotime($tglKembali) - strtotime($tglMrs))/3600, 1);
                                    $in24 = 'Tidak';
                                    if ($hourdiff <= 24 && $hourdiff > 0){
                                        $in24 = 'Ya';
                                    }
                                @endphp
                                {{$in24}}
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
    $('#table-pasien').dataTable({
        responsive : true,
    });
</script>
@endsection
