@extends('layouts/admin')
@section('content')

<div class="page-content">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Nutrition</h6>
          <div class="card-description">
            <button class="btn btn-primary" id="tambah">Tambah</button>
          </div>
          <div class="table-responsive">
            <table id="dataTableExample" class="table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Kategori Nutrition</th>
                  <th>Kategori Nutrition (En)</th>
                  <th>Judul Nutrition</th>
                  <th>Judul Nutrition (En)</th>
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
                      <input type="hidden" name="id_nutrition" id="id_nutrition">

                      <div class="form-group">
                        <label for="judul_nutrition" class="control-label">Judul Nutrition</label>
                        <input type="text" name="judul_nutrition" id="judul_nutrition" class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="judul_nutrition_en" class="control-label">Judul Nutrition (En)</label>
                        <input type="text" name="judul_nutrition_en" id="judul_nutrition_en" class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputText1">Kategori Nutrition</label>
                        <select class="form-control" id="id_kategori_nutrition" name="id_kategori_nutrition">
                        </select>
                      </div> 

                      <div class="form-group">
                        <label class="control-label">Thumbnail</label>
                        <a id="lfm" data-input="img_nutrition" data-preview="holder" class="btn btn-primary text-white" type="button" style="width:100% !important">
                          <i class="fa fa-picture-o"></i> Pilih File
                        </a>
                        <input id="img_nutrition" class="form-control mt-1" type="hidden" name="img_nutrition" readonly>
                      </div>
                      <div id="holder" style="margin-top:15px;margin-bottom:15px;height:auto;" class="text-center">
                      </div> 
                      <div id="holders" style="margin-top:15px;margin-bottom:15px;height:auto;" class="text-center">
                        <p id="text-holder">Thumbnail Lama</p>
                        <img id="img-holder" style="margin-top:15px;margin-bottom:15px;height:auto;" src="">
                      </div> 

                      <div class="form-group">
                        <label for="konten_nutrition" class="control-label">Konten Nutrition</label>
                        <textarea name="konten_nutrition" id="konten_nutrition" class="form-control"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="konten_nutrition_en" class="control-label">Konten Nutrition (En)</label>
                        <textarea name="konten_nutrition_en" id="konten_nutrition_en" class="form-control"></textarea>
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
                    <input type="hidden" name="id_nutrition" id="id_nutrition_delete">
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
                  ajax: "{{ route('admin.nutrition.index') }}",
                  columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'kategori_nutrition', name: 'kategori_nutrition'},
                  {data: 'kategori_nutrition_en', name: 'kategori_nutrition_en'},
                  {data: 'judul_nutrition', name: 'judul_nutrition'},
                  {data: 'judul_nutrition_en', name: 'judul_nutrition_en'},
                  {data: 'action', name: 'action'},
                  ]
                });

                $('#tambah').click(function () {
                  $('#saveBtn').val("save");
                  $('#id_nutrition').val('');
                  $('#theForm').trigger("reset");
                  $('#theModalHeading').html("Tambah Data");
                  $('#img-holder').hide();
                  $('#text-holder').hide();
                  $('#id_kategori_nutrition').val(null).trigger('change');
                  tinymce.get("konten_nutrition").setContent('');
                  tinymce.get("konten_nutrition_en").setContent('');
                  $('#theModal').modal('show');
                });

                $('body').on('click', '.edit-data', function () {
                  var id_nutrition = $(this).data('id');
                  $.get("{{ route('admin.nutrition.index') }}" +'/' + id_nutrition + '/edit', function (data) {
                    $('#theModalHeading').html("Edit");
                    $('#saveBtn').val("save");
                    $('#id_nutrition').val(data.id_nutrition);
                    $('#judul_nutrition').val(data.judul_nutrition);
                    $('#judul_nutrition_en').val(data.judul_nutrition_en);
                    $('#img_nutrition').val(data.img_nutrition);
                    var kategori_nutrition = new Option(data.kategori_nutrition, data.id_kategori_nutrition, false, false);
                    $('#id_kategori_nutrition').append(kategori_nutrition).trigger('change');
                    tinymce.get("konten_nutrition").setContent(data.konten_nutrition);
                    tinymce.get("konten_nutrition_en").setContent(data.konten_nutrition_en);
                    $('#holder').attr('src', data.img_nutrition);
                    $('#img-holder').show();
                    $('#text-holder').show();
                    $('#img-holder').attr('src', data.img_nutrition);
                    $('#theModal').modal('show');
                  })
                });

                $('body').on('click', '.delete-data', function () {
                  var id_nutrition = $(this).data('id');
                  $.get("{{ route('admin.nutrition.index') }}" +'/' + id_nutrition + '/edit', function (data) {
                    $('#theModalDeleteHeading').html("Hapus");
                    $('#saveDeteleBtn').val("delete");
                    $('#id_nutrition_delete').val(data.id_nutrition);
                    $('#theDeleteModal').modal('show');
                  })
                });

                $('#saveBtn').click(function (e) {
                  e.preventDefault();
                  console.log($("#theForm").serialize())
                  $(this).html('Simpan');
                  $.ajax({
                    data: {
                      id_nutrition: $('#id_nutrition').val(),
                      judul_nutrition: $('#judul_nutrition').val(),
                      judul_nutrition_en: $('#judul_nutrition_en').val(),
                      id_kategori_nutrition: $('#id_kategori_nutrition').val(),
                      img_nutrition: $('#img_nutrition').val(),
                      konten_nutrition: tinymce.get('konten_nutrition').getContent(),
                      konten_nutrition_en: tinymce.get('konten_nutrition_en').getContent(),
                    },
                    url: "{{ route('admin.nutrition.store') }}",
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
                  var id_nutrition = $('#id_nutrition_delete').val();
                  $.ajax({
                    type: "DELETE",
                    url: "{{ route('admin.nutrition.store') }}"+'/'+id_nutrition,
                    success: function (data) {
                      table.draw();
                      $('#theDeleteModal').modal('hide');
                    },
                    error: function (data) {
                      console.log('Error:', data);
                    }
                  });
                });

                $("#id_kategori_nutrition").select2({
                  theme: 'bootstrap4',
                  ajax: { 
                    url: "{{route('data.kategori.nutrition')}}",
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
                selector: '#konten_nutrition',
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
                selector: '#konten_nutrition_en',
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
          </div>
        </div>
      </div>
    </div>

  </div>
  @endsection