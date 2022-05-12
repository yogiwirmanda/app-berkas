@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Form Edit Berkas</h3>
            </div>
            <div class="card-body">
                <form action="{{route('berkas_update')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$id}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" name="no_rm" id="no_rm"
                                        placeholder="No RM" readonly value="{{$noRM}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" name="nama" id="nama_pasien"
                                        placeholder="Nama Pasien" readonly value="{{$namaPasien}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" name="dokter" id="nama_dokter"
                                        placeholder="Nama Dokter" readonly value="{{$namaDokter}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" name="ruangan" id="ruangan"
                                        placeholder="Ruangan" readonly value="{{$namaRuangan}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group input-group-merge">
                                    <input type="date" class="form-control" name="tanggal_mrs" value="{{Date('Y-m-d', strtotime($tgl))}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group input-group-merge">
                                    <textarea name="keterangan" id="keterangan" placeholder="Keterangan"
                                        class="form-control" cols="10" rows="3">{{$keterangan}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group input-group-merge py-2">
                                    <input type="checkbox" name="rawat[]" id="RI" class="form-control checkbox" value="RI"><span>RI</span>
                                    <input type="checkbox" name="rawat[]" id="RJ" class="form-control checkbox" value="RJ"><span>RJ</span>
                                    <input type="checkbox" name="rawat[]" id="IGD" class="form-control checkbox" value="IGD"><span>IGD</span>
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
@section('script-view')
<script>
    let rawat = <?php echo json_encode($rawat) ?>;
    $.each(rawat, function(index, value){
        $('#' + value).prop('checked', true);
    });
</script>
@endsection
