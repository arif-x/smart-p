@extends('layouts/admin')
@section('content')

<div class="page-content">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Slider</h6>
          <div class="card-description">
            <button class="btn btn-primary" id="tambah">Tambah</button>
          </div>
          <div class="table-responsive">
            <table id="dataTableExample" class="table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Title</th>
                  <th>Gambar Slide</th>
                  <th>Action</th>
                </tr>
              </thead>  
            </table>

            <div class="modal fade" id="theModal" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="theModalHeading"></h4>
                  </div>
                  <div class="modal-body">
                    <form id="theForm" name="theForm" class="form-horizontal">
                      <input type="hidden" name="id_slide" id="id_slide">

                      <div class="form-group">
                        <label for="title" class="control-label">Judul Slider</label>
                        <input type="text" name="title" id="title" class="form-control">
                      </div>

                      <div class="form-group">
                        <label class="control-label">Gambar Slider</label>
                        <a id="lfm" data-input="gambar_slide" data-preview="holder" class="btn btn-primary text-white" type="button" style="width:100% !important">
                          <i class="fa fa-picture-o"></i> Pilih File
                        </a>
                        <input id="gambar_slide" class="form-control mt-1" type="hidden" name="gambar_slide" readonly>
                      </div>
                      <div id="holder" style="margin-top:15px;margin-bottom:15px;height:auto;" class="text-center">
                      </div> 
                      <div id="holders" style="margin-top:15px;margin-bottom:15px;height:auto;" class="text-center">
                        <p id="text-holder">Gambar Slider Lama</p>
                        <img id="img-holder" style="margin-top:15px;margin-bottom:15px;height:auto;" src="">
                      </div> 

                      <button type="submit" class="btn btn-primary w-100" id="saveBtn" value="create">Simpan</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="theDeleteModal" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="theModalDeleteHeading"></h4>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="id_slider" id="id_slider_delete">
                    <h4>Ingin Menghapus Data Ini?</h4>
                    <button type="submit" class="btn btn-danger w-100" id="saveDeteleBtn" value="delete">Hapus</button>
                  </div>
                </div>
              </div>
            </div>

            <script type="text/javascript">
              $(document).ready(function(){
                $('#img-holder').hide();
                $('#text-holder').hide();
              });
              $(function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
                var table = $('#dataTableExample').DataTable({
                  processing: true,
                  serverSide: true,
                  paging: true,
                  ajax: "{{ route('admin.slider.index') }}",
                  columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'title', name: 'title'},
                  {data: 'slides', name: 'slides'},
                  {data: 'action', name: 'action'},
                  ]
                });

                $('#tambah').click(function () {
                  $('#saveBtn').val("save");
                  $('#id_slider').val('');
                  $('#theForm').trigger("reset");
                  $('#theModalHeading').html("Tambah Data");
                  $('#img-holder').hide();
                  $('#text-holder').hide();
                  $('#theModal').modal('show');
                });

                $('body').on('click', '.edit-data', function () {
                  var id_slider = $(this).data('id');
                  $.get("{{ route('admin.slider.index') }}" +'/' + id_slider + '/edit', function (data) {
                    $('#theModalHeading').html("Edit");
                    $('#saveBtn').val("save");
                    $('#id_slide').val(data.id_slide);
                    $('#title').val(data.title);
                    $('#gambar_slide').val(data.gambar_slide);
                    $('#holder').attr('src', data.gambar_slide);
                    $('#img-holder').show();
                    $('#text-holder').show();
                    $('#img-holder').attr('src', data.gambar_slide);
                    $('#theModal').modal('show');
                  })
                });

                $('body').on('click', '.delete-data', function () {
                  var id_slider = $(this).data('id');
                  $.get("{{ route('admin.slider.index') }}" +'/' + id_slider + '/edit', function (data) {
                    $('#theModalDeleteHeading').html("Hapus");
                    $('#saveDeteleBtn').val("delete");
                    $('#id_slider_delete').val(data.id_slide);
                    $('#theDeleteModal').modal('show');
                  })
                });

                $('#saveBtn').click(function (e) {
                  e.preventDefault();
                  $(this).html('Simpan');

                  $.ajax({
                    data: $('#theForm').serialize(),
                    url: "{{ route('admin.slider.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                      $('#theForm').trigger("reset");
                      $('#theModal').modal('hide');
                      table.draw();
                    },
                    error: function (data) {
                      console.log('Error:', data);
                      $('#saveBtn').html('Simpan');
                    }
                  });
                });

                $('#saveDeteleBtn').click(function (e) {
                  var id_slider = $('#id_slider_delete').val();
                  $.ajax({
                    type: "DELETE",
                    url: "{{ route('admin.slider.store') }}"+'/'+id_slider,
                    success: function (data) {
                      table.draw();
                      $('#theDeleteModal').modal('hide');
                    },
                    error: function (data) {
                      console.log('Error:', data);
                    }
                  });
                });

              });
            </script>
            <script>
              var route_prefix = "/filemanager";
              {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js')) !!}
              $('#lfm').filemanager('image', {prefix: route_prefix});
            </script>
            <style type="text/css">
              #holders img {
                max-width: 100% !important;
                height: 100% !important;
              }
            </style>
          </div>
        </div>
      </div>
    </div>

  </div>
  @endsection