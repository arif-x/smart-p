@extends('layouts/admin')
@section('content')

<div class="page-content">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Kategori Parenting</h6>
          <div class="card-description">
            <button class="btn btn-primary" id="tambah">Tambah</button>
          </div>
          <div class="table-responsive">
            <table id="dataTableExample" class="table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Jenis</th>
                  <th>Kategori Parenting</th>
                  <th>Kategori Parenting (En)</th>
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
                      <input type="hidden" name="id_kategori_parenting" id="id_kategori_parenting">

                      <div class="form-group">
                        <label for="id_jenis_parenting" class="control-label">Jenis</label>
                        <select class="form-control" id="id_jenis_parenting" name="id_jenis_parenting">
                          <option disabled selected="true">Pilih</option>
                          <option value="1">Artikel</option>
                          <option value="2">Video</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="kategori_parenting" class="control-label">Kategori Parenting</label>
                        <input type="text" class="form-control" id="kategori_parenting" name="kategori_parenting" required="">
                      </div>

                      <div class="form-group">
                        <label for="kategori_parenting_en" class="control-label">Kategori Parenting (En)</label>
                        <input type="text" class="form-control" id="kategori_parenting_en" name="kategori_parenting_en" required="">
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
                    <input type="hidden" name="id_kategori_parenting" id="id_kategori_parenting_delete">
                    <h4>Ingin Menghapus Data Ini?</h4>
                    <button type="submit" class="btn btn-danger w-100" id="saveDeteleBtn" value="delete">Hapus</button>
                  </div>
                </div>
              </div>
            </div>

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
                ajax: "{{ route('admin.kategori-parenting.index') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'jenis', name: 'jenis'},
                {data: 'kategori_parenting', name: 'kategori_parenting'},
                {data: 'kategori_parenting_en', name: 'kategori_parenting_en'},
                {data: 'action', name: 'action'},
                ]
              });

              $('#tambah').click(function () {
                $('#saveBtn').val("save");
                $('#id_kategori_parenting').val('');
                $('#theForm').trigger("reset");
                $('#theModalHeading').html("Tambah Data");
                $('#user').val(null).trigger('change');
                $('#theModal').modal('show');
              });

              $('body').on('click', '.edit-data', function () {
                var id_kategori_parenting = $(this).data('id');
                $.get("{{ route('admin.kategori-parenting.index') }}" +'/' + id_kategori_parenting + '/edit', function (data) {
                  $('#theModalHeading').html("Edit");
                  $('#saveBtn').val("save");
                  $('#id_kategori_parenting').val(data.id_kategori_parenting);
                  $('#id_jenis_parenting').val(data.id_jenis_parenting);
                  $('#kategori_parenting').val(data.kategori_parenting);
                  $('#kategori_parenting_en').val(data.kategori_parenting_en);
                  $('#theModal').modal('show');
                })
              });

              $('body').on('click', '.delete-data', function () {
                var id_kategori_parenting = $(this).data('id');
                $.get("{{ route('admin.kategori-parenting.index') }}" +'/' + id_kategori_parenting + '/edit', function (data) {
                  $('#theModalDeleteHeading').html("Hapus");
                  $('#saveDeteleBtn').val("delete");
                  $('#id_kategori_parenting_delete').val(data.id_kategori_parenting);
                  $('#theDeleteModal').modal('show');
                })
              });

              $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Simpan');

                $.ajax({
                  data: $('#theForm').serialize(),
                  url: "{{ route('admin.kategori-parenting.store') }}",
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
                var id_kategori_parenting = $('#id_kategori_parenting_delete').val();
                $.ajax({
                  type: "DELETE",
                  url: "{{ route('admin.kategori-parenting.store') }}"+'/'+id_kategori_parenting,
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
        </div>
      </div>
    </div>
  </div>

</div>
@endsection