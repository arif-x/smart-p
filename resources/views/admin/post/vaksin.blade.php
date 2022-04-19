@extends('layouts/admin')
@section('content')

<div class="page-content">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Nama Vaksin</h6>
          <div class="card-description">
            <button class="btn btn-primary" id="tambah">Tambah</button>
          </div>
          <div class="table-responsive">
            <table id="dataTableExample" class="table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Vaksin</th>
                  <th>Nama Vaksin (En)</th>
                  <th>Jadwal Vaksin</th>
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
                      <input type="hidden" name="id_vaksin" id="id_vaksin">

                      <div class="form-group">
                        <label for="nama_vaksin" class="control-label">Nama Vaksin</label>
                        <input type="text" class="form-control" id="nama_vaksin" name="nama_vaksin" required="">
                      </div>

                      <div class="form-group">
                        <label for="nama_vaksin_en" class="control-label">Nama Vaksin (En)</label>
                        <input type="text" class="form-control" id="nama_vaksin_en" name="nama_vaksin_en" required="">
                      </div>

                      <div class="form-group">
                        <label for="jadwal_vaksin" class="control-label">Jadwal Vaksin</label>
                        <input type="number" class="form-control" id="jadwal_vaksin" name="jadwal_vaksin" required="">
                      </div>

                      <div class="form-group">
                        <label for="keterangan_vaksin" class="control-label">Keterangan Vaksin</label>
                        <input type="text" class="form-control" id="keterangan_vaksin" name="keterangan_vaksin" required="">
                      </div>

                      <div class="form-group">
                        <label for="keterangan_vaksin_en" class="control-label">Keterangan Vaksin (En)</label>
                        <input type="text" class="form-control" id="keterangan_vaksin_en" name="keterangan_vaksin_en" required="">
                      </div>

                      <div class="form-group">
                        <label for="detail_vaksin" class="control-label">Detail Vaksin</label>
                        <textarea name="detail_vaksin" id="detail_vaksin" class="form-control"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="detail_vaksin_en" class="control-label">Detail Vaksin (En)</label>
                        <textarea name="detail_vaksin_en" id="detail_vaksin_en" class="form-control"></textarea>
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
                    <input type="hidden" name="id_vaksin" id="id_vaksin_delete">
                    <h4>Ingin Menghapus Data Ini?</h4>
                    <button type="submit" class="btn btn-danger w-100" id="saveDeteleBtn" value="delete">Hapus</button>
                  </div>
                </div>
              </div>
            </div>

            <script src="https://cdn.tiny.cloud/1/m1nz6lkq0ki8c21mhmdrhi8pfa5sjru7d79jblmku8iu0e3u/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
            <script type="text/javascript">
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
                ajax: "{{ route('admin.vaksin.index') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nama_vaksin', name: 'nama_vaksin'},
                {data: 'nama_vaksin_en', name: 'nama_vaksin_en'},
                {data: 'jadwal_vaksin', name: 'jadwal_vaksin'},
                {data: 'action', name: 'action'},
                ]
              });

              $('#tambah').click(function () {
                $('#saveBtn').val("save");
                $('#id_vaksin').val('');
                $('#theForm').trigger("reset");
                $('#theModalHeading').html("Tambah Data");
                $('#user').val(null).trigger('change');
                tinymce.get("detail_vaksin").setContent('');
                tinymce.get("detail_vaksin_en").setContent('');
                $('#theModal').modal('show');
              });

              $('body').on('click', '.edit-data', function () {
                var id_vaksin = $(this).data('id');
                $.get("{{ route('admin.vaksin.index') }}" +'/' + id_vaksin + '/edit', function (data) {
                  $('#theModalHeading').html("Edit");
                  $('#saveBtn').val("save");
                  $('#id_vaksin').val(data.id_vaksin);
                  $('#nama_vaksin').val(data.nama_vaksin);
                  $('#nama_vaksin_en').val(data.nama_vaksin_en);
                  $('#jadwal_vaksin').val(data.jadwal_vaksin);
                  $('#keterangan_vaksin').val(data.keterangan_vaksin);
                  $('#keterangan_vaksin_en').val(data.keterangan_vaksin_en);
                  tinymce.get("detail_vaksin").setContent(data.detail_vaksin);
                  tinymce.get("detail_vaksin_en").setContent(data.detail_vaksin_en);
                  $('#theModal').modal('show');
                })
              });

              $('body').on('click', '.delete-data', function () {
                var id_vaksin = $(this).data('id');
                $.get("{{ route('admin.vaksin.index') }}" +'/' + id_vaksin + '/edit', function (data) {
                  $('#theModalDeleteHeading').html("Hapus");
                  $('#saveDeteleBtn').val("delete");
                  $('#id_vaksin_delete').val(data.id_vaksin);
                  $('#theDeleteModal').modal('show');
                })
              });

              $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Simpan');

                $.ajax({
                  data: {
                    id_vaksin: $('#id_vaksin').val(),
                    nama_vaksin: $('#nama_vaksin').val(),
                    nama_vaksin_en: $('#nama_vaksin_en').val(),
                    jadwal_vaksin: $('#jadwal_vaksin').val(),
                    keterangan_vaksin: $('#keterangan_vaksin').val(),
                    keterangan_vaksin_en: $('#keterangan_vaksin_en').val(),
                    detail_vaksin: tinymce.get('detail_vaksin').getContent(),
                    detail_vaksin_en: tinymce.get('detail_vaksin_en').getContent(),
                  },
                  url: "{{ route('admin.vaksin.store') }}",
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
                var id_vaksin = $('#id_vaksin_delete').val();
                $.ajax({
                  type: "DELETE",
                  url: "{{ route('admin.vaksin.store') }}"+'/'+id_vaksin,
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
                selector: '#detail_vaksin',
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
                selector: '#detail_vaksin_en',
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
        </div>
      </div>
    </div>
  </div>

</div>
@endsection