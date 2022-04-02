@extends('layouts/admin')
@section('content')

<div class="page-content">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Nutrition Tracker</h6>
          <div class="card-description">
            <button class="btn btn-primary" id="tambah">Tambah</button>
          </div>
          <div class="table-responsive">
            <table id="dataTableExample" class="table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>anak</th>
                  <th>Menu Makanan Sehat</th>
                  <th>Kandungan Nutrisi</th>
                  <th>Manfaat</th>
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
                      <input type="hidden" name="id_nutrition_tracker" id="id_nutrition_tracker">

                      <div class="form-group">
                        <label for="exampleInputText1">anak</label>
                        <select class="form-control" id="anak" name="anak">
                        </select>
                      </div> 

                      <div class="form-group">
                        <label for="menu_makanan_sehat" class="control-label">Menu Makanan Sehat</label>
                        <input type="text" class="form-control" id="menu_makanan_sehat" name="menu_makanan_sehat" required="">
                      </div>

                      <div class="form-group">
                        <label for="kandungan_nutrisi" class="control-label">Kandungan Nutrisi</label>
                        <input type="text" class="form-control" id="kandungan_nutrisi" name="kandungan_nutrisi" required="">
                      </div>

                      <div class="form-group">
                        <label for="manfaat" class="control-label">Manfaat</label>
                        <input type="text" class="form-control" id="manfaat" name="manfaat" required="">
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
                    <input type="hidden" name="id_nutrition_tracker" id="id_nutrition_tracker_delete">
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
                ajax: "{{ route('admin.nutrition-tracker.index') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nama', name: 'nama'},
                {data: 'menu_makanan_sehat', name: 'menu_makanan_sehat'},
                {data: 'kandungan_nutrisi', name: 'kandungan_nutrisi'},
                {data: 'manfaat_makanan_sehat', name: 'manfaat_makanan_sehat'},
                {data: 'action', name: 'action'},
                ]
              });

              $('#tambah').click(function () {
                $('#saveBtn').val("save");
                $('#id_nutrition_tracker').val('');
                $('#theForm').trigger("reset");
                $('#theModalHeading').html("Tambah Data");
                $('#anak').val(null).trigger('change');
                $('#theModal').modal('show');
              });

              $('body').on('click', '.edit-data', function () {
                var id_nutrition_tracker = $(this).data('id');
                $.get("{{ route('admin.nutrition-tracker.index') }}" +'/' + id_nutrition_tracker + '/edit', function (data) {
                  $('#theModalHeading').html("Edit");
                  $('#saveBtn').val("save");
                  var anak = new Option(data.nama, data.id_anak, false, false);
                  $('#anak').append(anak).trigger('change');
                  $('#id_nutrition_tracker').val(data.id_nutrition_tracker);
                  $('#menu_makanan_sehat').val(data.menu_makanan_sehat);
                  $('#kandungan_nutrisi').val(data.kandungan_nutrisi);
                  $('#manfaat').val(data.manfaat_makanan_sehat);
                  $('#theModal').modal('show');
                })
              });

              $('body').on('click', '.delete-data', function () {
                var id_nutrition_tracker = $(this).data('id');
                $.get("{{ route('admin.nutrition-tracker.index') }}" +'/' + id_nutrition_tracker + '/edit', function (data) {
                  $('#theModalDeleteHeading').html("Hapus");
                  $('#saveDeteleBtn').val("delete");
                  $('#id_nutrition_tracker_delete').val(data.id_nutrition_tracker);
                  $('#theDeleteModal').modal('show');
                })
              });

              $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Simpan');

                $.ajax({
                  data: $('#theForm').serialize(),
                  url: "{{ route('admin.nutrition-tracker.store') }}",
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
                var id_nutrition_tracker = $('#id_nutrition_tracker_delete').val();
                $.ajax({
                  type: "DELETE",
                  url: "{{ route('admin.nutrition-tracker.store') }}"+'/'+id_nutrition_tracker,
                  success: function (data) {
                    table.draw();
                    $('#theDeleteModal').modal('hide');
                  },
                  error: function (data) {
                    console.log('Error:', data);
                  }
                });
              });

              $("#anak").select2({
                theme: 'bootstrap4',
                ajax: { 
                  url: "{{route('admin.get-anak-data')}}",
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