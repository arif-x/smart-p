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
                  <th>User</th>
                  <th>Modul Pengasuhan Anak</th>
                  <th>Video Tutorial Teknik Stimulasi</th>
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
                        <label for="exampleInputText1">User</label>
                        <select class="form-control" id="user" name="user">
                        </select>
                      </div> 

                      <div class="form-group">
                        <label for="modul_pengasuhan_anak" class="control-label">Modul Pengasuhan Anak</label>
                        <input type="text" class="form-control" id="modul_pengasuhan_anak" name="modul_pengasuhan_anak" required="">
                      </div>

                      <div class="form-group">
                        <label for="video_tutorial_teknik_stimulasi" class="control-label">Video Tutorial Teknik Stimulasi</label>
                        <input type="text" class="form-control" id="video_tutorial_teknik_stimulasi" name="video_tutorial_teknik_stimulasi" required="">
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
                ajax: "{{ route('admin.parenting.index') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nama', name: 'nama'},
                {data: 'modul_pengasuhan_anak', name: 'modul_pengasuhan_anak'},
                {data: 'video_tutorial_teknik_stimulasi', name: 'video_tutorial_teknik_stimulasi'},
                {data: 'action', name: 'action'},
                ]
              });

              $('#tambah').click(function () {
                $('#saveBtn').val("save");
                $('#id_parenting').val('');
                $('#theForm').trigger("reset");
                $('#theModalHeading').html("Tambah Data");
                $('#user').val(null).trigger('change');
                $('#theModal').modal('show');
              });

              $('body').on('click', '.edit-data', function () {
                var id_parenting = $(this).data('id');
                $.get("{{ route('admin.parenting.index') }}" +'/' + id_parenting + '/edit', function (data) {
                  $('#theModalHeading').html("Edit");
                  $('#saveBtn').val("save");
                  var user = new Option(data.nama, data.id_user, false, false);
                  $('#user').append(user).trigger('change');
                  $('#id_parenting').val(data.id_parenting);
                  $('#modul_pengasuhan_anak').val(data.modul_pengasuhan_anak);
                  $('#video_tutorial_teknik_stimulasi').val(data.video_tutorial_teknik_stimulasi);
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
                $(this).html('Simpan');

                $.ajax({
                  data: $('#theForm').serialize(),
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

              $("#user").select2({
                theme: 'bootstrap4',
                ajax: { 
                  url: "{{route('admin.get-user-data')}}",
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
        </div>
      </div>
    </div>
  </div>

</div>
@endsection