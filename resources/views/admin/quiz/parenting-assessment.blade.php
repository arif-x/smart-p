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
                  <th>Kategori Parenting Assessment</th>
                  <th>Kategori Parenting Assessment (En)</th>
                  <th>Soal</th>
                  <th>Soal (En)</th>
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
                      <input type="hidden" name="id_soal_parenting_assessment" id="id_soal_parenting_assessment">

                      <div class="form-group">
                        <label for="exampleInputText1">Kategori Parenting Assessment</label>
                        <select class="form-control" id="id_kategori_parenting_assessment" name="id_kategori_parenting_assessment">
                        </select>
                      </div> 

                      <div class="form-group">
                        <label for="soal" class="control-label">Soal</label>
                        <input type="text" class="form-control" id="soal" name="soal" required="">
                      </div>

                      <div class="form-group">
                        <label for="soal_en" class="control-label">Soal (En)</label>
                        <input type="text" class="form-control" id="soal_en" name="soal_en" required="">
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
                    <input type="hidden" name="id_soal_parenting_assessment" id="id_soal_parenting_assessment_delete">
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
                ajax: "{{ route('admin.parenting-assessment.index') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'kategori_parenting_assessment', name: 'kategori_parenting_assessment'},
                {data: 'kategori_parenting_assessment_en', name: 'kategori_parenting_assessment_en'},
                {data: 'soal', name: 'soal'},
                {data: 'soal_en', name: 'soal_en'},
                {data: 'action', name: 'action'},
                ]
              });

              $('#tambah').click(function () {
                $('#saveBtn').val("save");
                $('#id_soal_parenting_assessment').val('');
                $('#theForm').trigger("reset");
                $('#theModalHeading').html("Tambah Data");
                $('#user').val(null).trigger('change');
                $('#theModal').modal('show');
              });

              $('body').on('click', '.edit-data', function () {
                var id_soal_parenting_assessment = $(this).data('id');
                $.get("{{ route('admin.parenting-assessment.index') }}" +'/' + id_soal_parenting_assessment + '/edit', function (data) {
                  $('#theModalHeading').html("Edit");
                  $('#saveBtn').val("save");
                  $('#id_soal_parenting_assessment').val(data.id_soal_parenting_assessment);
                  var kategori_parenting_assessment = new Option(data.kategori_parenting_assessment, data.id_kategori_parenting_assessment, false, false);
                  $('#id_kategori_parenting_assessment').append(kategori_parenting_assessment).trigger('change');
                  $('#soal').val(data.soal);
                  $('#soal_en').val(data.soal_en);
                  $('#theModal').modal('show');
                })
              });

              $('body').on('click', '.delete-data', function () {
                var id_soal_parenting_assessment = $(this).data('id');
                $.get("{{ route('admin.parenting-assessment.index') }}" +'/' + id_soal_parenting_assessment + '/edit', function (data) {
                  $('#theModalDeleteHeading').html("Hapus");
                  $('#saveDeteleBtn').val("delete");
                  $('#id_soal_parenting_assessment_delete').val(data.id_soal_parenting_assessment);
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
                var id_soal_parenting_assessment = $('#id_soal_parenting_assessment_delete').val();
                $.ajax({
                  type: "DELETE",
                  url: "{{ route('admin.parenting-assessment.store') }}"+'/'+id_soal_parenting_assessment,
                  success: function (data) {
                    table.draw();
                    $('#theDeleteModal').modal('hide');
                  },
                  error: function (data) {
                    console.log('Error:', data);
                  }
                });
              });

              $("#id_kategori_parenting_assessment").select2({
                theme: 'bootstrap4',
                ajax: { 
                  url: "{{route('data.kategori.parenting-assessment')}}",
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