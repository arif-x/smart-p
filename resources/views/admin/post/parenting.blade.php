@extends('layouts/admin')
@section('content')

<div class="page-content">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Parenting</h6>
          <div class="card-description">
            <button class="btn btn-primary" id="tambah">Tambah</button>
          </div>
          <div class="table-responsive">
            <table id="dataTableExample" class="table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Jenis Parenting</th>
                  <th>Jenis Parenting (En)</th>
                  <th>Kategori Parenting</th>
                  <th>Kategori Parenting (En)</th>
                  <th>Judul Parenting</th>
                  <th>Judul Parenting (En)</th>
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
                      <input type="hidden" name="id_parenting" id="id_parenting">

                      <div class="form-group">
                        <label for="exampleInputText1">Jenis Parenting</label>
                        <select class="form-control" id="id_jenis_parenting" name="id_jenis_parenting">
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputText1">Kategori Parenting</label>
                        <select class="form-control" id="id_kategori_parenting" name="id_kategori_parenting">
                        </select>
                      </div> 

                      <div class="form-group">
                        <label for="judul_parenting" class="control-label">Judul Parenting</label>
                        <input type="text" name="judul_parenting" id="judul_parenting" class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="judul_parenting_en" class="control-label">Judul Parenting (En)</label>
                        <input type="text" name="judul_parenting_en" id="judul_parenting_en" class="form-control">
                      </div>

                      <div class="form-group">
                        <label class="control-label">Thumbnail</label>
                        <a id="lfm" data-input="thumnile_parenting" data-preview="holder" class="btn btn-primary text-white" type="button" style="width:100% !important">
                          <i class="fa fa-picture-o"></i> Pilih File
                        </a>
                        <input id="thumnile_parenting" class="form-control mt-1" type="hidden" name="thumnile_parenting" readonly>
                      </div>
                      <div id="holder" style="margin-top:15px;margin-bottom:15px;height:auto;" class="text-center">
                      </div> 
                      <div id="holders" style="margin-top:15px;margin-bottom:15px;height:auto;" class="text-center">
                        <p id="text-holder">Thumbnail Lama</p>
                        <img id="img-holder" style="margin-top:15px;margin-bottom:15px;height:auto;" src="">
                      </div> 

                      <div class="form-group" id="vids">
                        <label class="control-label">Video</label>
                        <a id="lfms" data-input="url_video" data-preview="holderV" class="btn btn-primary text-white" type="button" style="width:100% !important">
                          <i class="fa fa-video-o"></i> Pilih File
                        </a>
                        <input id="url_video" class="form-control mt-1" type="text" name="url_video" readonly>
                      </div>
                      <div id="holderV" style="margin-top:15px;margin-bottom:15px;height:auto;" class="text-center">
                      </div> 

                      <div class="form-group">
                        <label for="konten_parenting" class="control-label">Konten Parenting</label>
                        <textarea name="konten_parenting" id="konten_parenting" class="form-control"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="konten_parenting_en" class="control-label">Konten Parenting (En)</label>
                        <textarea name="konten_parenting_en" id="konten_parenting_en" class="form-control"></textarea>
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
                    <input type="hidden" name="id_parenting" id="id_parenting_delete">
                    <h4>Ingin Menghapus Data Ini?</h4>
                    <button type="submit" class="btn btn-danger w-100" id="saveDeteleBtn" value="delete">Hapus</button>
                  </div>
                </div>
              </div>
            </div>

            <script src="https://cdn.tiny.cloud/1/m1nz6lkq0ki8c21mhmdrhi8pfa5sjru7d79jblmku8iu0e3u/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
            <script type="text/javascript">
              $(document).ready(function(){
                $('#id_jenis_parenting').on('change', function(){
                  if($('#id_jenis_parenting').val() == 'Video'){
                    $('#vids').show();
                  } else if($('#id_jenis_parenting').val() == 'Artikel') {
                    $('#vids').hide();
                    $('#url_video').val('-');
                  }
                });

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
                  ajax: "{{ route('admin.parenting.index') }}",
                  columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'jenis_parenting', name: 'jenis_parenting'},
                  {data: 'jenis_parenting_en', name: 'jenis_parenting_en'},
                  {data: 'kategori_parenting', name: 'kategori_parenting'},
                  {data: 'kategori_parenting_en', name: 'kategori_parenting_en'},
                  {data: 'judul_parenting', name: 'judul_parenting'},
                  {data: 'judul_parenting_en', name: 'judul_parenting_en'},
                  {data: 'action', name: 'action'},
                  ]
                });

                $('#tambah').click(function () {
                  $('#saveBtn').val("save");
                  $('#id_parenting').val('');
                  $('#theForm').trigger("reset");
                  $('#theModalHeading').html("Tambah Data");
                  $('#img-holder').hide();
                  $('#text-holder').hide();
                  $('#id_jenis_parenting').val(null).trigger('change');
                  $('#id_kategori_parenting').val(null).trigger('change');
                  tinymce.get("konten_parenting").setContent('');
                  tinymce.get("konten_parenting_en").setContent('');
                  $('#theModal').modal('show');
                });

                $('body').on('click', '.edit-data', function () {
                  var id_parenting = $(this).data('id');
                  $.get("{{ route('admin.parenting.index') }}" +'/' + id_parenting + '/edit', function (data) {
                    $('#theModalHeading').html("Edit");
                    $('#saveBtn').val("save");
                    $('#id_parenting').val(data.id_parenting);
                    $('#judul_parenting').val(data.judul_parenting);
                    $('#judul_parenting_en').val(data.judul_parenting_en);
                    $('#thumnile_parenting').val(data.thumnile_parenting);
                    var jenis_parenting = new Option(data.jenis_parenting, data.id_jenis_parenting, false, false);
                    $('#id_jenis_parenting').append(jenis_parenting).trigger('change');
                    var kategori_parenting = new Option(data.kategori_parenting, data.id_kategori_parenting, false, false);
                    $('#id_kategori_parenting').append(kategori_parenting).trigger('change');
                    tinymce.get("konten_parenting").setContent(data.konten_parenting);
                    tinymce.get("konten_parenting_en").setContent(data.konten_parenting_en);
                    $('#holder').attr('src', data.thumnile_parenting);
                    $('#img-holder').show();
                    $('#text-holder').show();
                    $('#img-holder').attr('src', data.thumnile_parenting);
                    $('#theModal').modal('show');
                  })
                });

                $('body').on('click', '.delete-data', function () {
                  var id_parenting = $(this).data('id');
                  $.get("{{ route('admin.parenting.index') }}" +'/' + id_parenting + '/edit', function (data) {
                    $('#theModalDeleteHeading').html("Hapus");
                    $('#saveDeteleBtn').val("delete");
                    $('#id_parenting_delete').val(data.id_parenting);
                    $('#theDeleteModal').modal('show');
                  })
                });

                $('#saveBtn').click(function (e) {
                  e.preventDefault();
                  console.log($("#theForm").serialize())
                  $(this).html('Simpan');
                  $.ajax({
                    data: {
                      id_parenting: $('#id_parenting').val(),
                      judul_parenting: $('#judul_parenting').val(),
                      judul_parenting_en: $('#judul_parenting_en').val(),
                      id_kategori_parenting: $('#id_kategori_parenting').val(),
                      id_jenis_parenting: $('#id_jenis_parenting').val(),
                      thumnile_parenting: $('#thumnile_parenting').val(),
                      konten_parenting: tinymce.get('konten_parenting').getContent(),
                      konten_parenting_en: tinymce.get('konten_parenting_en').getContent(),
                    },
                    url: "{{ route('admin.parenting.store') }}",
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
                  var id_parenting = $('#id_parenting_delete').val();
                  $.ajax({
                    type: "DELETE",
                    url: "{{ route('admin.parenting.store') }}"+'/'+id_parenting,
                    success: function (data) {
                      table.draw();
                      $('#theDeleteModal').modal('hide');
                    },
                    error: function (data) {
                      console.log('Error:', data);
                    }
                  });
                });

                $("#id_jenis_parenting").select2({
                  theme: 'bootstrap4',
                  ajax: { 
                    url: "{{route('data.jenis.parenting')}}",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                      return {
                        search: params.term
                      };
                    },
                    processResults: function (response) {
                      return {
                        results: response
                      };
                    },
                    cache: true
                  }

                });

                $("#id_kategori_parenting").select2({
                  theme: 'bootstrap4',
                  ajax: { 
                    url: "{{route('data.kategori.parenting')}}",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                      return {
                        search: params.term
                      };
                    },
                    processResults: function (response) {
                      return {
                        results: response
                      };
                    },
                    cache: true
                  }

                });

              });
            </script>
            <script type="text/javascript">
              tinymce.init({
                selector: '#konten_parenting',
                height: 500,
                menubar: false,
                plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
              });
              tinymce.init({
                selector: '#konten_parenting_en',
                height: 500,
                menubar: false,
                plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
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
            <script>
              var route_prefix = "/filemanager";
              {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js')) !!}
              $('#lfms').filemanager('file', {prefix: route_prefix});
            </script>
          </div>
        </div>
      </div>
    </div>

  </div>
  @endsection