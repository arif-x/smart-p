@extends('layouts/admin')
@section('content')

<div class="page-content">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Growth Tracker</h6>
          <div class="card-description">
            <button class="btn btn-primary" id="tambah">Tambah</button>
          </div>
          <div class="table-responsive">
            <table id="dataTableExample" class="table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>User</th>
                  <th>Berat Badan</th>
                  <th>Index Masa Tumbuh</th>
                  <th>Lingkar Kepala</th>
                  <th>Lingkar Lengan Atas</th>
                  <th>Lipatan Kulit</th>
                  <th>Tinggi Badan</th>
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
                      <input type="hidden" name="id_growth_tracker" id="id_growth_tracker">

                      <div class="form-group">
                        <label for="exampleInputText1">User</label>
                        <select class="form-control" id="user" name="user">
                        </select>
                      </div> 

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="berat_badan" class="control-label">Berat Badan</label>
                            <input type="number" class="form-control" id="berat_badan" name="berat_badan" required="">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="index_masa_tumbuh" class="control-label">Index Masa Tumbuh</label>
                            <input type="number" class="form-control" id="index_masa_tumbuh" name="index_masa_tumbuh" required="">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="lingkar_kepala" class="control-label">Lingkar Kepala</label>
                            <input type="number" class="form-control" id="lingkar_kepala" name="lingkar_kepala" required="">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="lingkar_lengan_atas" class="control-label">Lingkar Lengan Atas</label>
                            <input type="number" class="form-control" id="lingkar_lengan_atas" name="lingkar_lengan_atas" required="">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="lipatan_kulit" class="control-label">Lipatan Kulit</label>
                            <input type="number" class="form-control" id="lipatan_kulit" name="lipatan_kulit" required="">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="tinggi_badan" class="control-label">Tinggi Badan</label>
                            <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan" required="">
                          </div>
                        </div>
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
                    <input type="hidden" name="id_growth_tracker" id="id_growth_tracker_delete">
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
                ajax: "{{ route('admin.growth-tracker.index') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nama', name: 'nama'},
                {data: 'berat_badan', name: 'berat_badan'},
                {data: 'index_masa_tumbuh', name: 'index_masa_tumbuh'},
                {data: 'lingkar_kepala', name: 'lingkar_kepala'},
                {data: 'lingkar_lengan_atas', name: 'lingkar_lengan_atas'},
                {data: 'lipatan_kulit', name: 'lipatan_kulit'},
                {data: 'tinggi_badan', name: 'tinggi_badan'},
                {data: 'action', name: 'action'},
                ]
              });

              $('#tambah').click(function () {
                $('#saveBtn').val("save");
                $('#id_growth_tracker').val('');
                $('#theForm').trigger("reset");
                $('#theModalHeading').html("Tambah Data");
                $('#user').val(null).trigger('change');
                $('#theModal').modal('show');
              });

              $('body').on('click', '.edit-data', function () {
                var id_growth_tracker = $(this).data('id');
                $.get("{{ route('admin.growth-tracker.index') }}" +'/' + id_growth_tracker + '/edit', function (data) {
                  $('#theModalHeading').html("Edit");
                  $('#saveBtn').val("save");
                  var user = new Option(data.nama, data.id_user, false, false);
                  $('#user').append(user).trigger('change');
                  $('#id_growth_tracker').val(data.id_growth_tracker);
                  $('#berat_badan').val(data.berat_badan);
                  $('#index_masa_tumbuh').val(data.index_masa_tumbuh);
                  $('#lingkar_kepala').val(data.lingkar_kepala);
                  $('#lingkar_lengan_atas').val(data.lingkar_lengan_atas);
                  $('#lipatan_kulit').val(data.lipatan_kulit);
                  $('#tinggi_badan').val(data.tinggi_badan);
                  $('#theModal').modal('show');
                })
              });

              $('body').on('click', '.delete-data', function () {
                var id_growth_tracker = $(this).data('id');
                $.get("{{ route('admin.growth-tracker.index') }}" +'/' + id_growth_tracker + '/edit', function (data) {
                  $('#theModalDeleteHeading').html("Hapus");
                  $('#saveDeteleBtn').val("delete");
                  $('#id_growth_tracker_delete').val(data.id_growth_tracker);
                  $('#theDeleteModal').modal('show');
                })
              });

              $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Simpan');

                $.ajax({
                  data: $('#theForm').serialize(),
                  url: "{{ route('admin.growth-tracker.store') }}",
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
                var id_growth_tracker = $('#id_growth_tracker_delete').val();
                $.ajax({
                  type: "DELETE",
                  url: "{{ route('admin.growth-tracker.store') }}"+'/'+id_growth_tracker,
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