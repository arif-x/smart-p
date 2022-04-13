@extends('layouts/admin')
@section('content')

<div class="page-content">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Klasifikasi Tinggi Badan</h6>
          <div class="card-description">
            <button class="btn btn-primary" id="tambah">Tambah</button>
          </div>
          <div class="table-responsive">
            <table id="dataTableExample" class="table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Jenis Kelamin</th>
                  <th>Bulan</th>
                  <th>Min (Cm)</th>
                  <th>Max (Cm)</th>
                  <th>Klasifikasi</th>
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
                      <input type="hidden" name="id_klasifikasi_tinggi_badan" id="id_klasifikasi_tinggi_badan">

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="jenis_kelamin" class="control-label">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                              <option disabled selected="true">Pilih</option>
                              <option value="L">Laki-Laki</option>
                              <option value="P">Perempuan</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="bulan" class="control-label">Bulan</label>
                            <input type="number" class="form-control" id="bulan" name="bulan" required="">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="min" class="control-label">Min (cm)</label>
                            <input type="number" class="form-control" id="min" name="min" required="">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="max" class="control-label">Max (cm)</label>
                            <input type="number" class="form-control" id="max" name="max" required="">
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="klasifikasi_tinggi_badan" class="control-label">Klasifikasi</label>
                        <textarea class="form-control" name="klasifikasi_tinggi_badan" id="klasifikasi_tinggi_badan"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="klasifikasi_tinggi_badan_en" class="control-label">Klasifikasi (En)</label>
                        <textarea class="form-control" name="klasifikasi_tinggi_badan_en" id="klasifikasi_tinggi_badan_en"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="saran_klasifikasi_tinggi_badan" class="control-label">Saran</label>
                        <textarea class="form-control" name="saran_klasifikasi_tinggi_badan" id="saran_klasifikasi_tinggi_badan"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="saran_klasifikasi_tinggi_badan_en" class="control-label">Saran (En)</label>
                        <textarea class="form-control" name="saran_klasifikasi_tinggi_badan_en" id="saran_klasifikasi_tinggi_badan_en"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="hex_tinggi_badan" class="control-label">Warna (Hex)</label>
                        <input type="text" name="hex_tinggi_badan" id="hex_tinggi_badan" class="form-control">
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
                    <input type="hidden" name="id_klasifikasi_tinggi_badan" id="id_klasifikasi_tinggi_badan_delete">
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
                ajax: "{{ route('admin.klasifikasi-tinggi-badan.index') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'jenis_kelamin', name: 'jenis_kelamin'},
                {data: 'bulan', name: 'bulan'},
                {data: 'min', name: 'min'},
                {data: 'max', name: 'max'},
                {data: 'klasifikasi_tinggi_badan', name: 'klasifikasi_tinggi_badan'},
                {data: 'action', name: 'action'},
                ]
              });

              $('#tambah').click(function () {
                $('#saveBtn').val("save");
                $('#id_klasifikasi_tinggi_badan').val('');
                $('#theForm').trigger("reset");
                $('#theModalHeading').html("Tambah Data");
                $('#user').val(null).trigger('change');
                $('#theModal').modal('show');
              });

              $('body').on('click', '.edit-data', function () {
                var id_klasifikasi_tinggi_badan = $(this).data('id');
                $.get("{{ route('admin.klasifikasi-tinggi-badan.index') }}" +'/' + id_klasifikasi_tinggi_badan + '/edit', function (data) {
                  $('#theModalHeading').html("Edit");
                  $('#saveBtn').val("save");
                  $('#id_klasifikasi_tinggi_badan').val(data.id_klasifikasi_tinggi_badan);
                  $('#jenis_kelamin').val(data.jenis_kelamin);
                  $('#bulan').val(data.bulan);
                  $('#min').val(data.min);
                  $('#max').val(data.max);
                  $('#klasifikasi_tinggi_badan').val(data.klasifikasi_tinggi_badan);
                  $('#klasifikasi_tinggi_badan_en').val(data.klasifikasi_tinggi_badan_en);
                  $('#saran_klasifikasi_tinggi_badan').val(data.saran_klasifikasi_tinggi_badan);
                  $('#saran_klasifikasi_tinggi_badan_en').val(data.saran_klasifikasi_tinggi_badan_en);
                  $('#hex_tinggi_badan').val(data.hex_tinggi_badan);
                  $('#theModal').modal('show');
                })
              });

              $('body').on('click', '.delete-data', function () {
                var id_klasifikasi_tinggi_badan = $(this).data('id');
                $.get("{{ route('admin.klasifikasi-tinggi-badan.index') }}" +'/' + id_klasifikasi_tinggi_badan + '/edit', function (data) {
                  $('#theModalDeleteHeading').html("Hapus");
                  $('#saveDeteleBtn').val("delete");
                  $('#id_klasifikasi_tinggi_badan_delete').val(data.id_klasifikasi_tinggi_badan);
                  $('#theDeleteModal').modal('show');
                })
              });

              $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Simpan');

                $.ajax({
                  data: $('#theForm').serialize(),
                  url: "{{ route('admin.klasifikasi-tinggi-badan.store') }}",
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
                var id_klasifikasi_tinggi_badan = $('#id_klasifikasi_tinggi_badan_delete').val();
                $.ajax({
                  type: "DELETE",
                  url: "{{ route('admin.klasifikasi-tinggi-badan.store') }}"+'/'+id_klasifikasi_tinggi_badan,
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