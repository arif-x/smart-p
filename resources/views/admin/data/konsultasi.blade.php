@extends('layouts/admin')
@section('content')

<div class="page-content">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Konsultasi</h6>
          <div class="table-responsive">
            <table id="dataTableExample" class="table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Kategori</th>
                  <th>Pertanyaan</th>
                  <th>Terjawab</th>
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
                      <input type="hidden" name="id_konsultasi" id="id_konsultasi">

                      <div class="form-group">
                        <label for="pertanyaan" class="control-label">Pertanyaan</label>
                        <textarea name="pertanyaan" id="pertanyaan" class="form-control"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="jawaban_konsultasi" class="control-label">Jawaban</label>
                        <textarea name="jawaban_konsultasi" id="jawaban_konsultasi" class="form-control"></textarea>
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
                    <input type="hidden" name="id_konsultasi" id="id_konsultasi_delete">
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
                ajax: "{{ route('admin.konsultasi.index') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'kategori_konsultasi', name: 'kategori_konsultasi'},
                {data: 'pertanyaan', name: 'pertanyaan'},
                {data: 'check', name: 'check'},
                {data: 'action', name: 'action'},
                ]
              });

              $('body').on('click', '.edit-data', function () {
                var id_konsultasi = $(this).data('id');
                $.get("{{ route('admin.konsultasi.index') }}" +'/' + id_konsultasi + '/edit', function (data) {
                  $('#theModalHeading').html("Jawab Pertanyaan Konsultasi");
                  $('#saveBtn').val("save");
                  $('#id_konsultasi').val(data.id_konsultasi);
                  tinymce.get("jawaban_konsultasi").setContent(data.jawaban_konsultasi);
                  tinymce.get("pertanyaan").setContent(data.pertanyaan);
                  $('#theModal').modal('show');
                })
              });

              // $('body').on('click', '.delete-data', function () {
              //   var id_konsultasi = $(this).data('id');
              //   $.get("{{ route('admin.konsultasi.index') }}" +'/' + id_konsultasi + '/edit', function (data) {
              //     $('#theModalDeleteHeading').html("Hapus");
              //     $('#saveDeteleBtn').val("delete");
              //     $('#id_konsultasi_delete').val(data.id_konsultasi);
              //     $('#theDeleteModal').modal('show');
              //   })
              // });

              $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Simpan');

                $.ajax({
                  data: {
                    id_konsultasi: $('#id_konsultasi').val(),
                    jawaban_konsultasi: tinymce.get('jawaban_konsultasi').getContent(),
                  },
                  url: "{{ route('admin.konsultasi.store') }}",
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

              // $('#saveDeteleBtn').click(function (e) {
              //   var id_konsultasi = $('#id_konsultasi_delete').val();
              //   $.ajax({
              //     type: "DELETE",
              //     url: "{{ route('admin.konsultasi.store') }}"+'/'+id_konsultasi,
              //     success: function (data) {
              //       table.draw();
              //       $('#theDeleteModal').modal('hide');
              //     },
              //     error: function (data) {
              //       console.log('Error:', data);
              //     }
              //   });
              // });

            });
          </script>
          <script type="text/javascript">
            tinymce.init({
              selector: '#jawaban_konsultasi',
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
              selector: '#pertanyaan',
              readonly: 1,
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