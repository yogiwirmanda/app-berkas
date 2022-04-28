@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Form Berkas</h3>
            </div>
            <div class="card-body">
                <form action="{{route('berkas_save')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group input-group-merge">
                                    <select name="no_rm" id="no_rm" class="form-control selectize">
                                        @foreach($pasien as $data)
                                        <option value="{{$data->id}}">{{$data->no_rm}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" name="nama" id="nama_pasien"
                                        placeholder="Nama Pasien">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group input-group-merge">
                                    <select name="dokter" id="dokter" class="form-control select2">
                                        @foreach($dokter as $data)
                                        <option value="{{$data->id}}">{{$data->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group input-group-merge">
                                    <select name="ruangan" id="ruangan" class="form-control select2">
                                        @foreach($ruangan as $data)
                                        <option value="{{$data->id}}">{{$data->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group input-group-merge">
                                    <input type="date" class="form-control" name="tanggal_mrs" value="{{Date('Y-m-d')}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group input-group-merge">
                                    <textarea name="keterangan" id="keterangan" placeholder="Keterangan"
                                        class="form-control" cols="10" rows="3"></textarea>
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
    $('.select2').select2();
    $("#no_rm").selectize({
        create: true
    });

    $('#no_rm').change(function (e) {
        let getValue = $(this).text();
        $.ajax({
            url: '/check/rm',
            dataType: 'json',
            data: {
                no_rm: getValue
            },
            success: function (response) {
                $('#nama_pasien').val(response);
            }
        })
    })

</script>
@endsection
