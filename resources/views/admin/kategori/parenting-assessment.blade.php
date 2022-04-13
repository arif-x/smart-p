@extends('layouts/admin')
@section('content')

<div class="page-content">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Kategori Parenting Assessment</h6>
          <div class="card-description">
            <button class="btn btn-primary" id="tambah">Tambah</button>
          </div>
          <div class="table-responsive">
            <table id="dataTableExample" class="table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Kategori Parenting Assessment</th>
                  <th>Kategori Parenting Assessment (En)</th>
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
                      <input type="hidden" name="id_kategori_parenting_assessment" id="id_kategori_parenting_assessment">

                      <div class="form-group">
                        <label for="kategori_parenting_assessment" class="control-label">Kategori Parenting Assessment</label>
                        <input type="text" class="form-control" id="kategori_parenting_assessment" name="kategori_parenting_assessment" required="">
                      </div>

                      <div class="form-group">
                        <label for="kategori_parenting_assessment_en" class="control-label">Kategori Parenting Assessment (En)</label>
                        <input type="text" class="form-control" id="kategori_parenting_assessment_en" name="kategori_parenting_assessment_en" required="">
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
                    <input type="hidden" name="id_kategori_parenting_assessment" id="id_kategori_parenting_assessment_delete">
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
                ajax: "{{ route('admin.kategori-parenting-assessment.index') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'kategori_parenting_assessment', name: 'kategori_parenting_assessment'},
                {data: 'kategori_parenting_assessment_en', name: 'kategori_parenting_assessment_en'},
                {data: 'action', name: 'action'},
                ]
              });

              $('#tambah').click(function () {
                $('#saveBtn').val("save");
                $('#id_kategori_parenting_assessment').val('');
                $('#theForm').trigger("reset");
                $('#theModalHeading').html("Tambah Data");
                $('#user').val(null).trigger('change');
                $('#theModal').modal('show');
              });

              $('body').on('click', '.edit-data', function () {
                var id_kategori_parenting_assessment = $(this).data('id');
                $.get("{{ route('admin.kategori-parenting-assessment.index') }}" +'/' + id_kategori_parenting_assessment + '/edit', function (data) {
                  $('#theModalHeading').html("Edit");
                  $('#saveBtn').val("save");
                  $('#id_kategori_parenting_assessment').val(data.id_kategori_parenting_assessment);
                  $('#kategori_parenting_assessment').val(data.kategori_parenting_assessment);
                  $('#kategori_parenting_assessment_en').val(data.kategori_parenting_assessment_en);
                  $('#theModal').modal('show');
                })
              });

              $('body').on('click', '.delete-data', function () {
                var id_kategori_parenting_assessment = $(this).data('id');
                $.get("{{ route('admin.kategori-parenting-assessment.index') }}" +'/' + id_kategori_parenting_assessment + '/edit', function (data) {
                  $('#theModalDeleteHeading').html("Hapus");
                  $('#saveDeteleBtn').val("delete");
                  $('#id_kategori_parenting_assessment_delete').val(data.id_kategori_parenting_assessment);
                  $('#theDeleteModal').modal('show');
                })
              });

              $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Simpan');

                $.ajax({
                  data: $('#theForm').serialize(),
                  url: "{{ route('admin.kategori-parenting-assessment.store') }}",
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
                var id_kategori_parenting_assessment = $('#id_kategori_parenting_assessment_delete').val();
                $.ajax({
                  type: "DELETE",
                  url: "{{ route('admin.kategori-parenting-assessment.store') }}"+'/'+id_kategori_parenting_assessment,
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