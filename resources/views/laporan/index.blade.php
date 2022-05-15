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
                            <td>{{(strlen($items->tanggal_krs) > 0) ? Date('Y-m-d', strtotime($items->tanggal_krs)) : '-'}}</td>
                            <td>{{(strlen($items->tanggal_kembali) > 0) ? Date('Y-m-d', strtotime($items->tanggal_kembali)) : '-'}}</td>
                            <td>
                                @php
                                    $hourdiff = $items->jam;
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script>
    $('#table-pasien').dataTable({
        responsive : true,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf'
        ]
    });
</script>
@endsection
