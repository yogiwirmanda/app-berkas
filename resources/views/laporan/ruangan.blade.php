@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="mb-0">Laporan Ruangan</h3>
                <div class="row">
                    <div class="col-md-12">
                        <select name="bulan" id="bulan" class="form-control">
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
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="table-pasien" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Ruangan</th>
                            <th>Total Berkas</th>
                            <th>Tepat</th>
                            <th>Tidak Tepat</th>
                            <th>Prosentase Tepat</th>
                            <th>Prosentase Tidak Tepat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ruangan as $items)
                        <tr>
                            <td>{{$items['ruangan']}}</td>
                            <td>{{$items['total']}}</td>
                            <td>{{$items['t']}}</td>
                            <td>{{$items['tt']}}</td>
                            <td>{{$items['t_percent']}} %</td>
                            <td>{{$items['tt_percent']}} %</td>
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
    $(document).ready(function(e){
        $('#table-pasien').dataTable({
            responsive : true,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf'
            ],
        });
        $('#bulan').val({{$bulan}});
        $('#bulan').change(function(e){
            let getValue = $(this).val();
            window.location.href = '/laporan/ruangan/' + getValue;
        })
    });
</script>
@endsection
