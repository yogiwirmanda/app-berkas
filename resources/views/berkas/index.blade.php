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
                <table id="table-pasien" class="table table-bordered table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No RM</th>
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
                            <td>{{$items->noRM}}</td>
                            <td>{{$items->namaPasien}}</td>
                            <td>{{$items->namaDokter}}</td>
                            <td>{{$items->namaRuangan}}</td>
                            <td>{{$items->tanggal_mrs}}</td>
                            <td>{{($items->status == 1) ? 'Keluar' : 'Kembali'}}</td>
                            <td>
                                @if($items->status == 1)
                                    @if (Auth::id() == 2)
                                        <a href="/berkas/kembali/{{$items->id}}" data-id="{{$items->id}}" class="btn btn-primary btn-kembali">Kembali</a>
                                    @else
                                        <a href="/berkas/edit/{{$items->id}}" class="btn btn-primary">Edit</a>
                                    @endif
                                    <a href="/berkas/destroy/{{$items->id}}" class="btn btn-danger">Hapus</a>
                                @else
                                    <a href="/berkas/destroy/{{$items->id}}" class="btn btn-danger">Hapus</a>
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
<div class="modal fade" id="modalKembali" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tanggal KRS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input type="hidden" name="id_berkas" id="id_berkas" class="form-control">
          <input type="date" name="tgl_krs" id="tgl_krs" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary btn-save-kembali">Simpan</button>
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

    $(document).on('click', '.btn-kembali', function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $('#id_berkas').val(id);
        $('#modalKembali').modal();
    });

    $('.btn-save-kembali').click(function(e) {
        e.preventDefault();
        let id = $('#id_berkas').val();
        let krs = $('#tgl_krs').val();
        $.ajax({
            url : '/berkas/kembali',
            dataType : 'json',
            data : {id:id, tgl_krs:krs},
            success : function(response){
                $('#modalKembali').modal('hide');
                window.location.reload();
            }
        })
    });
</script>
@endsection
