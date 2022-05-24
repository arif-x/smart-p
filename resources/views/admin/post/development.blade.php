@extends('layouts/admin')
@section('content')

<div class="page-content">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">development</h6>
          <div class="card-description">
            <button class="btn btn-primary" id="tambah">Tambah</button>
          </div>
          <div class="table-responsive">
            <table id="dataTableExample" class="table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Kategori Development</th>
                  <th>Kategori Development (En)</th>
                  <th>Untuk Usia</th>
                  <th>Untuk Usia (En)</th>
                  <th>Judul Development</th>
                  <th>Judul Development (En)</th>
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
                      <input type="hidden" name="id_development" id="id_development">

                      <div class="form-group">
                        <label for="exampleInputText1">Kategori Development</label>
                        <select class="form-control" id="id_kategori_development" name="id_kategori_development">
                        </select>
                      </div> 

                      <div class="form-group">
                        <label for="jenis">Jenis</label>
                        <select class="form-control" id="jenis" name="jenis">
                          <option disabled selected="true">Pilih</option>
                          <option value="Artikel">Artikel</option>
                          <option value="Video">Video</option>
                        </select>
                      </div> 

                      <div class="form-group">
                        <label for="untuk_usia" class="control-label">Untuk Usia</label>
                        <input type="text" name="untuk_usia" id="untuk_usia" class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="untuk_usia_en" class="control-label">Untuk Usia (En)</label>
                        <input type="text" name="untuk_usia_en" id="untuk_usia_en" class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="judul_development" class="control-label">Judul Development</label>
                        <input type="text" name="judul_development" id="judul_development" class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="judul_development_en" class="control-label">Judul Development (En)</label>
                        <input type="text" name="judul_development_en" id="judul_development_en" class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="keterangan" class="control-label">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="keterangan_en" class="control-label">Keterangan (En)</label>
                        <input type="text" name="keterangan_en" id="keterangan_en" class="form-control">
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
                        <label class="control-label">Thumbnail</label>
                        <a id="lfm" data-input="thumnile" data-preview="holder" class="btn btn-primary text-white" type="button" style="width:100% !important">
                          <i class="fa fa-picture-o"></i> Pilih File
                        </a>
                        <input id="thumnile" class="form-control mt-1" type="hidden" name="thumnile" readonly>
                      </div>
                      <div id="holder" style="margin-top:15px;margin-bottom:15px;height:auto;" class="text-center">
                      </div> 
                      <div id="holders" style="margin-top:15px;margin-bottom:15px;height:auto;" class="text-center">
                        <p id="text-holder">Thumbnail Lama</p>
                        <img id="img-holder" style="margin-top:15px;margin-bottom:15px;height:auto;" src="">
                      </div> 

                      <div class="form-group">
                        <label for="stimulus_1" class="control-label">Stimulus 1</label>
                        <textarea name="stimulus_1" id="stimulus_1" class="form-control"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="stimulus_1_en" class="control-label">Stimulus 1 (En)</label>
                        <textarea name="stimulus_1_en" id="stimulus_1_en" class="form-control"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="stimulus_2" class="control-label">Stimulus 2</label>
                        <textarea name="stimulus_2" id="stimulus_2" class="form-control"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="stimulus_2_en" class="control-label">Stimulus 2 (En)</label>
                        <textarea name="stimulus_2_en" id="stimulus_2_en" class="form-control"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="stimulus_3" class="control-label">Stimulus 3</label>
                        <textarea name="stimulus_3" id="stimulus_3" class="form-control"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="stimulus_3_en" class="control-label">Stimulus 3 (En)</label>
                        <textarea name="stimulus_3_en" id="stimulus_3_en" class="form-control"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="stimulus_4" class="control-label">Stimulus 4</label>
                        <textarea name="stimulus_4" id="stimulus_4" class="form-control"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="stimulus_4_en" class="control-label">Stimulus 4 (En)</label>
                        <textarea name="stimulus_4_en" id="stimulus_4_en" class="form-control"></textarea>
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
                    <input type="hidden" name="id_development" id="id_development_delete">
                    <h4>Ingin Menghapus Data Ini?</h4>
                    <button type="submit" class="btn btn-danger w-100" id="saveDeteleBtn" value="delete">Hapus</button>
                  </div>
                </div>
              </div>
            </div>

            <script src="https://cdn.tiny.cloud/1/m1nz6lkq0ki8c21mhmdrhi8pfa5sjru7d79jblmku8iu0e3u/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
            <script type="text/javascript">
              $('#jenis').on('change', function(){
                if($('#jenis').val() == 'Video'){
                  $('#vids').show();
                } else if($('#jenis').val() == 'Artikel') {
                  $('#vids').hide();
                  $('#url_video').val('-');
                }
              });

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
                  ajax: "{{ route('admin.development.index') }}",
                  columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'kategori_development', name: 'kategori_development'},
                  {data: 'kategori_development_en', name: 'kategori_development_en'},
                  {data: 'untuk_usia', name: 'untuk_usia'},
                  {data: 'untuk_usia_en', name: 'untuk_usia_en'},
                  {data: 'judul_development', name: 'judul_development'},
                  {data: 'judul_development_en', name: 'judul_development_en'},
                  {data: 'action', name: 'action'},
                  ]
                });

                $('#tambah').click(function () {
                  $('#saveBtn').val("save");
                  $('#theModalHeading').html("Tambah Data");
                  $('#img-holder').hide();
                  $('#text-holder').hide();
                  $('#id_kategori_development').val(null).trigger('change');
                  $('#id_development').val('');
                  $('#untuk_usia').val('');
                  $('#untuk_usia_en').val('');
                  $('#judul_development').val('');
                  $('#judul_development_en').val('');
                  $('#keterangan').val('');
                  $('#keterangan_en').val('');
                  $('#jenis').val('');
                  $('#thumnile').val('');
                  $('#url_video').val('');
                  tinymce.get("stimulus_1").setContent('');
                  tinymce.get("stimulus_1_en").setContent('');
                  tinymce.get("stimulus_2").setContent('');
                  tinymce.get("stimulus_2_en").setContent('');
                  tinymce.get("stimulus_3").setContent('');
                  tinymce.get("stimulus_3_en").setContent('');
                  tinymce.get("stimulus_4").setContent('');
                  tinymce.get("stimulus_4_en").setContent('');
                  $('#theForm').trigger("reset");
                  $('#theModal').modal('show');
                });

                $('body').on('click', '.edit-data', function () {
                  var id_development = $(this).data('id');
                  $.get("{{ route('admin.development.index') }}" +'/' + id_development + '/edit', function (data) {
                    $('#theModalHeading').html("Edit");
                    $('#saveBtn').val("save");
                    $('#id_development').val(data.id_development);
                    $('#judul_development').val(data.judul_development);
                    $('#judul_development_en').val(data.judul_development_en);
                    $('#keterangan').val(data.keterangan);
                    $('#keterangan_en').val(data.keterangan_en);
                    $('#untuk_usia').val(data.untuk_usia);
                    $('#untuk_usia_en').val(data.untuk_usia_en);
                    $('#jenis').val(data.jenis);
                    $('#thumnile').val(data.thumnile);
                    $('#url_video').val(data.url_video);
                    var kategori_development = new Option(data.kategori_development, data.id_kategori_development, false, false);
                    $('#id_kategori_development').append(kategori_development).trigger('change');
                    tinymce.get("stimulus_1").setContent(data.stimulus1);
                    tinymce.get("stimulus_1_en").setContent(data.stimulus1_en);
                    tinymce.get("stimulus_2").setContent(data.stimulus2);
                    tinymce.get("stimulus_2_en").setContent(data.stimulus2_en);
                    tinymce.get("stimulus_3").setContent(data.stimulus3);
                    tinymce.get("stimulus_3_en").setContent(data.stimulus3_en);
                    tinymce.get("stimulus_4").setContent(data.stimulus4);
                    tinymce.get("stimulus_4_en").setContent(data.stimulus4_en);
                    $('#holder').attr('src', data.thumnile);
                    $('#img-holder').show();
                    $('#text-holder').show();
                    $('#img-holder').attr('src', data.thumnile);
                    $('#theModal').modal('show');
                  })
                });

                $('body').on('click', '.delete-data', function () {
                  var id_development = $(this).data('id');
                  $.get("{{ route('admin.development.index') }}" +'/' + id_development + '/edit', function (data) {
                    $('#theModalDeleteHeading').html("Hapus");
                    $('#saveDeteleBtn').val("delete");
                    $('#id_development_delete').val(data.id_development);
                    $('#theDeleteModal').modal('show');
                  })
                });

                $('#saveBtn').click(function (e) {
                  e.preventDefault();
                  console.log($("#theForm").serialize())
                  $(this).html('Simpan');
                  $.ajax({
                    data: {
                      id_development: $('#id_development').val(),
                      untuk_usia: $('#untuk_usia').val(),
                      untuk_usia_en: $('#untuk_usia_en').val(),
                      judul_development: $('#judul_development').val(),
                      judul_development_en: $('#judul_development_en').val(),
                      keterangan: $('#keterangan').val(),
                      keterangan_en: $('#keterangan_en').val(),
                      id_kategori_development: $('#id_kategori_development').val(),
                      jenis: $('#jenis').val(),
                      thumnile: $('#thumnile').val(),
                      url_video: $('#url_video').val(),
                      stimulus_1: tinymce.get('stimulus_1').getContent(),
                      stimulus_1_en: tinymce.get('stimulus_1_en').getContent(),
                      stimulus_2: tinymce.get('stimulus_2').getContent(),
                      stimulus_2_en: tinymce.get('stimulus_2_en').getContent(),
                      stimulus_3: tinymce.get('stimulus_3').getContent(),
                      stimulus_3_en: tinymce.get('stimulus_3_en').getContent(),
                      stimulus_4: tinymce.get('stimulus_4').getContent(),
                      stimulus_4_en: tinymce.get('stimulus_4_en').getContent(),
                    },
                    url: "{{ route('admin.development.store') }}",
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
                  var id_development = $('#id_development_delete').val();
                  $.ajax({
                    type: "DELETE",
                    url: "{{ route('admin.development.store') }}"+'/'+id_development,
                    success: function (data) {
                      table.draw();
                      $('#theDeleteModal').modal('hide');
                    },
                    error: function (data) {
                      console.log('Error:', data);
                    }
                  });
                });

                $("#id_kategori_development").select2({
                  theme: 'bootstrap4',
                  ajax: { 
                    url: "{{route('data.kategori.development')}}",
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
                selector: '#stimulus_1',
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
                selector: '#stimulus_1_en',
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
            <script type="text/javascript">
              tinymce.init({
                selector: '#stimulus_2',
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
                selector: '#stimulus_2_en',
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
            <script type="text/javascript">
              tinymce.init({
                selector: '#stimulus_3',
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
                selector: '#stimulus_3_en',
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
            <script type="text/javascript">
              tinymce.init({
                selector: '#stimulus_4',
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
                selector: '#stimulus_4_en',
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
            <script>
              var route_prefix = "/filemanager";
              {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js')) !!}
              $('#lfms').filemanager('file', {prefix: route_prefix});
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