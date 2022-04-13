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
                  <th>Jenis Parenting</th>
                  <th>Jenis Parenting (En)</th>
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
                      <input type="hidden" name="id_jenis_parenting" id="id_jenis_parenting">

                      <div class="form-group">
                        <label for="jenis_parenting" class="control-label">Jenis Parenting</label>
                        <input type="text" class="form-control" id="jenis_parenting" name="jenis_parenting" required="">
                      </div>

                      <div class="form-group">
                        <label for="jenis_parenting_en" class="control-label">Jenis Parenting (En)</label>
                        <input type="text" class="form-control" id="jenis_parenting_en" name="jenis_parenting_en" required="">
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
                    <input type="hidden" name="id_jenis_parenting" id="id_jenis_parenting_delete">
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
                ajax: "{{ route('admin.jenis-parenting.index') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'jenis_parenting', name: 'jenis_parenting'},
                {data: 'jenis_parenting_en', name: 'jenis_parenting_en'},
                {data: 'action', name: 'action'},
                ]
              });

              $('#tambah').click(function () {
                $('#saveBtn').val("save");
                $('#id_jenis_parenting').val('');
                $('#theForm').trigger("reset");
                $('#theModalHeading').html("Tambah Data");
                $('#user').val(null).trigger('change');
                $('#theModal').modal('show');
              });

              $('body').on('click', '.edit-data', function () {
                var id_jenis_parenting = $(this).data('id');
                $.get("{{ route('admin.jenis-parenting.index') }}" +'/' + id_jenis_parenting + '/edit', function (data) {
                  $('#theModalHeading').html("Edit");
                  $('#saveBtn').val("save");
                  var user = new Option(data.nama, data.id_user, false, false);
                  $('#user').append(user).trigger('change');
                  $('#id_jenis_parenting').val(data.id_jenis_parenting);
                  $('#jenis_parenting').val(data.jenis_parenting);
                  $('#jenis_parenting_en').val(data.jenis_parenting_en);
                  $('#theModal').modal('show');
                })
              });

              $('body').on('click', '.delete-data', function () {
                var id_jenis_parenting = $(this).data('id');
                $.get("{{ route('admin.jenis-parenting.index') }}" +'/' + id_jenis_parenting + '/edit', function (data) {
                  $('#theModalDeleteHeading').html("Hapus");
                  $('#saveDeteleBtn').val("delete");
                  $('#id_jenis_parenting_delete').val(data.id_jenis_parenting);
                  $('#theDeleteModal').modal('show');
                })
              });

              $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Simpan');

                $.ajax({
                  data: $('#theForm').serialize(),
                  url: "{{ route('admin.jenis-parenting.store') }}",
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
                var id_jenis_parenting = $('#id_jenis_parenting_delete').val();
                $.ajax({
                  type: "DELETE",
                  url: "{{ route('admin.jenis-parenting.store') }}"+'/'+id_jenis_parenting,
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