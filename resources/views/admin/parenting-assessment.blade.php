@extends('layouts/admin')
@section('content')

<div class="page-content">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Parenting Assessment</h6>
          <div class="card-description">
            <button class="btn btn-primary" id="tambah">Tambah</button>
          </div>
          <div class="table-responsive">
            <table id="dataTableExample" class="table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>User</th>
                  <th>Pengukuran Pengetahun Parenting</th>
                  <th>Pengukuran Parenting Self Efficacy</th>
                  <th>Pengukuran Keterampilan Mengasuh Anak</th>
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
                      <input type="hidden" name="id_parenting_assessment" id="id_parenting_assessment">

                      <div class="form-group">
                        <label for="exampleInputText1">User</label>
                        <select class="form-control" id="user" name="user">
                        </select>
                      </div> 

                      <div class="form-group">
                        <label for="pengukuran_pengetahuan_parenting" class="control-label">Pengukuran Pengetahun Parenting</label>
                        <input type="text" class="form-control" id="pengukuran_pengetahuan_parenting" name="pengukuran_pengetahuan_parenting" required="">
                      </div>

                      <div class="form-group">
                        <label for="pengukuran_parenting_self_efficacy" class="control-label">Pengukuran Parenting Self Efficacy</label>
                        <input type="text" class="form-control" id="pengukuran_parenting_self_efficacy" name="pengukuran_parenting_self_efficacy" required="">
                      </div>

                      <div class="form-group">
                        <label for="pengukuran_keterampilan_mengasuh_anak" class="control-label">Pengukuran Keterampilan Mengasuh Anak</label>
                        <input type="text" class="form-control" id="pengukuran_keterampilan_mengasuh_anak" name="pengukuran_keterampilan_mengasuh_anak" required="">
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
                    <input type="hidden" name="id_parenting_assessment" id="id_parenting_assessment_delete">
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
                ajax: "{{ route('admin.parenting-assessment.index') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nama', name: 'nama'},
                {data: 'pengukuran_pengetahuan_parenting', name: 'pengukuran_pengetahuan_parenting'},
                {data: 'pengukuran_parenting_self_efficacy', name: 'pengukuran_parenting_self_efficacy'},
                {data: 'pengukuran_keterampilan_mengasuh_anak', name: 'pengukuran_keterampilan_mengasuh_anak'},
                {data: 'action', name: 'action'},
                ]
              });

              $('#tambah').click(function () {
                $('#saveBtn').val("save");
                $('#id_parenting_assessment').val('');
                $('#theForm').trigger("reset");
                $('#theModalHeading').html("Tambah Data");
                $('#user').val(null).trigger('change');
                $('#theModal').modal('show');
              });

              $('body').on('click', '.edit-data', function () {
                var id_parenting_assessment = $(this).data('id');
                $.get("{{ route('admin.parenting-assessment.index') }}" +'/' + id_parenting_assessment + '/edit', function (data) {
                  $('#theModalHeading').html("Edit");
                  $('#saveBtn').val("save");
                  var user = new Option(data.nama, data.id_user, false, false);
                  $('#user').append(user).trigger('change');
                  $('#id_parenting_assessment').val(data.id_parenting_assessment);
                  $('#pengukuran_pengetahuan_parenting').val(data.pengukuran_pengetahuan_parenting);
                  $('#index_masa_tumbuh').val(data.index_masa_tumbuh);
                  $('#pengukuran_parenting_self_efficacy').val(data.pengukuran_parenting_self_efficacy);
                  $('#pengukuran_keterampilan_mengasuh_anak').val(data.pengukuran_keterampilan_mengasuh_anak);
                  $('#theModal').modal('show');
                })
              });

              $('body').on('click', '.delete-data', function () {
                var id_parenting_assessment = $(this).data('id');
                $.get("{{ route('admin.parenting-assessment.index') }}" +'/' + id_parenting_assessment + '/edit', function (data) {
                  $('#theModalDeleteHeading').html("Hapus");
                  $('#saveDeteleBtn').val("delete");
                  $('#id_parenting_assessment_delete').val(data.id_parenting_assessment);
                  $('#theDeleteModal').modal('show');
                })
              });

              $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Simpan');

                $.ajax({
                  data: $('#theForm').serialize(),
                  url: "{{ route('admin.parenting-assessment.store') }}",
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
                var id_parenting_assessment = $('#id_parenting_assessment_delete').val();
                $.ajax({
                  type: "DELETE",
                  url: "{{ route('admin.parenting-assessment.store') }}"+'/'+id_parenting_assessment,
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