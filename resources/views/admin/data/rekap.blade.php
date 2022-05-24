@extends('layouts/admin')
@section('content')

<div class="page-content">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Rekap Anak</h6>
<!--           <div class="card-description">
            <button class="btn btn-primary" id="tambah">Tambah</button>
          </div> -->
          <div class="table-responsive">
            <table id="dataTableExample" class="table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Anak</th>
                  <th>Jenis Kelamin</th>
                  <th>Tanggal Lahir</th>
                  <th>Tinggi Badan Terakhir</th>
                  <th>Berat Badan Terakhir</th>
                  <th>Lingkar Kepala Terakhir</th>
                </tr>
              </thead>  
            </table>


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
                ajax: "{{ route('admin.rekap.index') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nama_anak', name: 'nama_anak'},
                {data: 'jenis_kelamin', name: 'jenis_kelamin'},
                {data: 'tanggal_lahir', name: 'tanggal_lahir'},
                {data: 'tinggi_badan_perkembangan', name: 'tinggi_badan_perkembangan'},
                {data: 'berat_badan_perkembangan', name: 'berat_badan_perkembangan'},
                {data: 'lingkar_kepala_perkembangan', name: 'lingkar_kepala_perkembangan'},
                ]
              });

            });
          </script>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection