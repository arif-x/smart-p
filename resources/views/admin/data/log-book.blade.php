@extends('layouts/admin')
@section('content')

<div class="page-content">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Logbook</h6>
          <a href="#" class="btn btn-primary add-data mb-4">Tambah Logbook</a>
          <div class="table-responsive">
            <table id="dataTableExample" class="table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Tanggal</th>
                  <th>Hari Ke</th>
                  <th>Tanggal</th>
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
                      <input type="hidden" name="id_log_book" id="id_log_book">

                      <div class="form-group">
                        <label for="tanggal" class="control-label">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control"></input>
                      </div>

                      <div class="form-group">
                        <label for="hari_ke" class="control-label">Hari Ke</label>
                        <input type="number" name="hari_ke" id="hari_ke" class="form-control"></input>
                      </div>

                      <div class="form-group">
                        <label for="log_book" class="control-label">Logbook</label>
                        <textarea name="log_book" id="log_book" class="form-control"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="feedback" class="control-label">Feedback</label>
                        <textarea name="feedback" id="feedback" class="form-control"></textarea>
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
                    <input type="hidden" name="id_log_book" id="id_log_book_delete">
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
                ajax: "{{ route('admin.logbook.index') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'tanggal', name: 'tanggal'},
                {data: 'hari_ke', name: 'hari_ke'},
                {data: 'action', name: 'action'},
                ]
              });

              $('body').on('click', '.add-data', function () {
                  $('#theModalHeading').html("Tambah Logbook");
                  $('#saveBtn').val("save");
                  $('#id_log_book').val('');
                  $('#tanggal').val('');
                  $('#hari_ke').val('');
                  tinymce.get("log_book").setContent('');
                  tinymce.get("feedback").setContent('');
                  $('#theModal').modal('show');
              });

              $('body').on('click', '.edit-data', function () {
                var id_log_book = $(this).data('id');
                $.get("{{ route('admin.logbook.index') }}" +'/' + id_log_book + '/edit', function (data) {
                  $('#theModalHeading').html("Edit Logbook");
                  $('#saveBtn').val("save");
                  $('#id_log_book').val(data.id_log_book);
                  $('#tanggal').val(data.tanggal);
                  $('#hari_ke').val(data.hari_ke);
                  tinymce.get("log_book").setContent(data.log_book);
                  tinymce.get("feedback").setContent(data.feedback);
                  $('#theModal').modal('show');
                })
              });

              $('body').on('click', '.delete-data', function () {
                var id_log_book = $(this).data('id');
                $.get("{{ route('admin.logbook.index') }}" +'/' + id_log_book + '/edit', function (data) {
                  $('#theModalDeleteHeading').html("Hapus");
                  $('#saveDeteleBtn').val("delete");
                  $('#id_log_book_delete').val(data.id_log_book);
                  $('#theDeleteModal').modal('show');
                })
              });

              $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Simpan');

                $.ajax({
                  data: {
                    id_log_book: $('#id_log_book').val(),
                    tanggal: $('#tanggal').val(),
                    hari_ke: $('#hari_ke').val(),
                    log_book: tinymce.get('log_book').getContent(),
                    feedback: tinymce.get('feedback').getContent(),
                  },
                  url: "{{ route('admin.logbook.store') }}",
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
                var id_log_book = $('#id_log_book_delete').val();
                $.ajax({
                  type: "DELETE",
                  url: "{{ route('admin.logbook.store') }}"+'/'+id_log_book,
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
              selector: '#feedback',
              height: 300,
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
              selector: '#log_book',
              height: 300,
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