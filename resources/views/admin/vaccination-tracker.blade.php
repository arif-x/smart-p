@extends('layouts/admin')
@section('content')

<div class="page-content">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Vaccination Tracker</h6>
          <div class="card-description">
            <button class="btn btn-primary" id="tambah">Tambah</button>
          </div>
          <div class="table-responsive">
            <table id="dataTableExample" class="table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>User</th>
                  <th>Jadwal Imunisasi</th>
                  <th>Tipe Imunisasi</th>
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
                      <input type="hidden" name="id_vaccination_tracker" id="id_vaccination_tracker">

                      <div class="form-group">
                        <label for="exampleInputText1">User</label>
                        <select class="form-control" id="user" name="user">
                        </select>
                      </div> 

                      <div class="form-group">
                        <label for="jadwal_imunisasi" class="control-label">Jadwal Imunisasi</label>
                        <div class="input-group date datepicker" id="jadwal_imunisasi">
                          <input type="text" name="jadwal_imunisasi" class="form-control bg-white" readonly><span class="input-group-addon"><i data-feather="calendar"></i></span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="tipe_imunisasi" class="control-label">Tipe Imunisasi</label>
                        <input type="text" class="form-control" id="tipe_imunisasi" name="tipe_imunisasi" required="">
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
                    <input type="hidden" name="id_vaccination_tracker" id="id_vaccination_tracker_delete">
                    <h4>Ingin Menghapus Data Ini?</h4>
                    <button type="submit" class="btn btn-danger w-100" id="saveDeteleBtn" value="delete">Hapus</button>
                  </div>
                </div>
              </div>
            </div>

            <script type="text/javascript">
              $(function() {
                'use strict';
                if($('#jadwal_imunisasi').length) {
                  var date = new Date();
                  var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                  $('#jadwal_imunisasi').datepicker({
                    format: "dd/mm/yyyy",
                    todayHighlight: true,
                    autoclose: true
                  });
                  $('#jadwal_imunisasi').datepicker('setDate', today);
                }
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
                  ajax: "{{ route('admin.vaccination-tracker.index') }}",
                  columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'nama', name: 'nama'},
                  {data: 'jadwal_imunisasi', name: 'jadwal_imunisasi'},
                  {data: 'tipe_imunisasi', name: 'tipe_imunisasi'},
                  {data: 'action', name: 'action'},
                  ]
                });

                $('#tambah').click(function () {
                  $('#saveBtn').val("save");
                  $('#id_vaccination_tracker').val('');
                  $('#theForm').trigger("reset");
                  $('#theModalHeading').html("Tambah Data");
                  $('#user').val(null).trigger('change');
                  $('#theModal').modal('show');
                });

                $('body').on('click', '.edit-data', function () {
                  var id_vaccination_tracker = $(this).data('id');
                  $.get("{{ route('admin.vaccination-tracker.index') }}" +'/' + id_vaccination_tracker + '/edit', function (data) {
                    $('#theModalHeading').html("Edit");
                    $('#saveBtn').val("save");
                    var user = new Option(data.nama, data.id_user, false, false);
                    $('#user').append(user).trigger('change');
                    $('#id_vaccination_tracker').val(data.id_vaccination_tracker);
                    $('#jadwal_imunisasi').datepicker('setDate', data.jadwal_imunisasi);
                    $('#tipe_imunisasi').val(data.tipe_imunisasi);
                    $('#theModal').modal('show');
                  })
                });

                $('body').on('click', '.delete-data', function () {
                  var id_vaccination_tracker = $(this).data('id');
                  $.get("{{ route('admin.vaccination-tracker.index') }}" +'/' + id_vaccination_tracker + '/edit', function (data) {
                    $('#theModalDeleteHeading').html("Hapus");
                    $('#saveDeteleBtn').val("delete");
                    $('#id_vaccination_tracker_delete').val(data.id_vaccination_tracker);
                    $('#theDeleteModal').modal('show');
                  })
                });

                $('#saveBtn').click(function (e) {
                  e.preventDefault();
                  $(this).html('Simpan');

                  $.ajax({
                    data: $('#theForm').serialize(),
                    url: "{{ route('admin.vaccination-tracker.store') }}",
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
                  var id_vaccination_tracker = $('#id_vaccination_tracker_delete').val();
                  $.ajax({
                    type: "DELETE",
                    url: "{{ route('admin.vaccination-tracker.store') }}"+'/'+id_vaccination_tracker,
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