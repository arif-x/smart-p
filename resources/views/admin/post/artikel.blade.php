@extends('layouts/admin')
@section('content')

<div class="page-content">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Artikel</h6>
          <div class="card-description">
            <button class="btn btn-primary" id="tambah">Tambah</button>
          </div>
          <div class="table-responsive">
            <table id="dataTableExample" class="table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Judul Artikel</th>
                  <th>Judul Artikel (En)</th>
                  <th>Kategori Artikel</th>
                  <th>Kategori Artikel (En)</th>
                  <th>Label</th>
                  <th>Label (En)</th>
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
                      <input type="hidden" name="id_artikel" id="id_artikel">

                      <div class="form-group">
                        <label for="judul_artikel" class="control-label">Judul Artikel</label>
                        <input type="text" name="judul_artikel" id="judul_artikel" class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="judul_artikel_en" class="control-label">Judul Artikel (En)</label>
                        <input type="text" name="judul_artikel_en" id="judul_artikel_en" class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="id_kategori_artikel" class="control-label">Kategori Artikel</label>
                        <select name="id_kategori_artikel" id="id_kategori_artikel" class="form-control">
                          <option value="" disabled selected>Pilih</option>
                          @foreach($kategori_artikel as $key => $value)
                          <option value="{{ $key }}">{{ $value }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group videos">
                        <label class="control-label">Video</label><input id="url_video" class="form-control mt-1" type="text" name="url_video">
                      </div>

                      <div class="form-group">
                        <label class="control-label">Thumbnail</label>
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white" type="button" style="width:100% !important">
                          <i class="fa fa-picture-o"></i> Pilih File
                        </a>
                        <input id="thumbnail" class="form-control mt-1" type="hidden" name="thumbnail" readonly>
                      </div>
                      <div id="holder" style="margin-top:15px;margin-bottom:15px;height:auto;" class="text-center">
                      </div> 
                      <div id="holders" style="margin-top:15px;margin-bottom:15px;height:auto;" class="text-center">
                        <p id="text-holder">Thumbnail Lama</p>
                        <img id="img-holder" style="margin-top:15px;margin-bottom:15px;height:auto;" src="">
                      </div> 

                      <div class="form-group">
                        <label for="label" class="control-label">Label</label>
                        <input type="text" name="label" id="label" class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="label_en" class="control-label">Label (En)</label>
                        <input type="text" name="label_en" id="label_en" class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="konten" class="control-label">Konten</label>
                        <textarea name="konten" id="konten" class="form-control"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="konten_en" class="control-label">Konten (En)</label>
                        <textarea name="konten_en" id="konten_en" class="form-control"></textarea>
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
                    <input type="hidden" name="id_artikel" id="id_artikel_delete">
                    <h4>Ingin Menghapus Data Ini?</h4>
                    <button type="submit" class="btn btn-danger w-100" id="saveDeteleBtn" value="delete">Hapus</button>
                  </div>
                </div>
              </div>
            </div>
            <script src="https://cdn.tiny.cloud/1/m1nz6lkq0ki8c21mhmdrhi8pfa5sjru7d79jblmku8iu0e3u/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
            <script type="text/javascript">
              $(document).ready(function(){
                $('#img-holder').hide();
                $('#text-holder').hide();

                $('#id_kategori_artikel').on('change', function(){
                  if($('#id_kategori_artikel').val() != '2'){
                    $('.videos').hide();
                    $('#url_video').val('-');
                  } else if($('#id_kategori_artikel').val() == '2') {
                    $('.videos').show();
                  }
                });
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
                  ajax: "{{ route('admin.artikel.index') }}",
                  columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'judul_artikel', name: 'judul_artikel'},
                  {data: 'judul_artikel_en', name: 'judul_artikel_en'},
                  {data: 'kategori_artikel', name: 'kategori_artikel'},
                  {data: 'kategori_artikel_en', name: 'kategori_artikel_en'},
                  {data: 'label', name: 'label'},
                  {data: 'label_en', name: 'label_en'},
                  {data: 'action', name: 'action'},
                  ]
                });

                $('#tambah').click(function () {
                  $('#saveBtn').val("save");
                  $('#id_artikel').val('');
                  $('#theForm').trigger("reset");
                  $('#theModalHeading').html("Tambah Data");
                  $('#img-holder').hide();
                  $('#text-holder').hide();
                  tinymce.get("konten").setContent('');
                  tinymce.get("konten_en").setContent('');
                  $('#theModal').modal('show');
                });

                $('body').on('click', '.edit-data', function () {
                  var id_artikel = $(this).data('id');
                  $.get("{{ route('admin.artikel.index') }}" +'/' + id_artikel + '/edit', function (data) {
                    $('#theModalHeading').html("Edit");
                    $('#saveBtn').val("save");
                    $('#id_artikel').val(data.id_artikel);
                    $('#judul_artikel').val(data.judul_artikel);
                    $('#judul_artikel_en').val(data.judul_artikel_en);
                    $('#label').val(data.label);
                    $('#label_en').val(data.label_en);
                    $('#url_video').val(data.url_video);
                    $('#thumbnail').val(data.thumbnail);
                    $('#id_kategori_artikel').val(data.id_kategori_artikel);
                    tinymce.get("konten").setContent(data.konten);
                    tinymce.get("konten_en").setContent(data.konten_en);
                    $('#holder').attr('src', data.thumbnail);
                    $('#img-holder').show();
                    $('#text-holder').show();
                    $('#img-holder').attr('src', data.thumbnail);
                    $('#theModal').modal('show');
                  })
                });

                $('body').on('click', '.delete-data', function () {
                  var id_artikel = $(this).data('id');
                  $.get("{{ route('admin.artikel.index') }}" +'/' + id_artikel + '/edit', function (data) {
                    $('#theModalDeleteHeading').html("Hapus");
                    $('#saveDeteleBtn').val("delete");
                    $('#id_artikel_delete').val(data.id_artikel);
                    $('#theDeleteModal').modal('show');
                  })
                });

                $('#saveBtn').click(function (e) {
                  e.preventDefault();
                  $(this).html('Simpan');

                  $.ajax({
                    data: {
                      id_artikel: $('#id_artikel').val(),
                      judul_artikel: $('#judul_artikel').val(),
                      judul_artikel_en: $('#judul_artikel_en').val(),
                      label: $('#label').val(),
                      label_en: $('#label_en').val(),
                      url_video: $('#url_video').val(),
                      thumbnail: $('#thumbnail').val(),
                      id_kategori_artikel: $('#id_kategori_artikel').val(),
                      konten: tinymce.get('konten').getContent(),
                      konten_en: tinymce.get('konten_en').getContent(),
                    },
                    url: "{{ route('admin.artikel.store') }}",
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
                  var id_artikel = $('#id_artikel_delete').val();
                  $.ajax({
                    type: "DELETE",
                    url: "{{ route('admin.artikel.store') }}"+'/'+id_artikel,
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
            <script type="text/javascript">
              tinymce.init({
                selector: '#konten',
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
                selector: '#konten_en',
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