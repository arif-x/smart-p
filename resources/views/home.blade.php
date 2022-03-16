@extends('layouts/admin')
@section('content')

<div class="page-content">

  <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
      <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">
      <div class="input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex" id="dashboardDate">
        <span class="input-group-addon bg-transparent"><i data-feather="calendar" class=" text-primary"></i></span>
        <input type="text" class="form-control">
      </div>
      <button type="button" class="btn btn-outline-info btn-icon-text mr-2 d-none d-md-block">
        <i class="btn-icon-prepend" data-feather="download"></i>
        Import
      </button>
      <button type="button" class="btn btn-outline-primary btn-icon-text mr-2 mb-2 mb-md-0">
        <i class="btn-icon-prepend" data-feather="printer"></i>
        Print
      </button>
      <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
        <i class="btn-icon-prepend" data-feather="download-cloud"></i>
        Download Report
      </button>
    </div>
  </div>

  <div class="row">
    <div class="col-12 col-xl-12 stretch-card">
      <div class="row flex-grow">



        <div class="row">   

          <div class="col-md-12" style="margin-bottom: 30px">          

          </div>
          <br />
          <div style="width: 100%">
            <div class="">
              <table class="table stripe table-responsive row-border order-column data-table" style="width: 100% !important">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Column Name</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>

              <div class="modal fade bd-example-modal-lg" id="ajaxModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content modal-long">
                    <div class="modal-header">
                      <h4 class="modal-title" id="modelHeading"></h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="theForm" name="theForm" class="form-horizontal">
                        <input type="hidden" name="the_id" id="the_id" value="">

                        <div class="row">
                          <div class="col-md-12">

                            <div class="form-group">
                              <label for="nama" class="col-sm-12 control-label">Nama</label>
                              <div class="col-sm-12">
                                <input type="text" class="form-control" id="nama" name="nama" value="" disabled>
                              </div>
                            </div>

                          </div>
                        </div>
                        <div class="col-md-12">
                         <button type="submit" class="btn btn-primary" id="saveBtn" value="create" style="width: 100%">Simpan
                         </button>
                       </div>
                     </form>
                   </div>
                 </div>
               </div>
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
          var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "route('the-route.index')",
            columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'column_name', name: 'column_name'},
            {data: 'option', name: 'option', searchable: false},
            ]
          });
        });
      </script>



    </div>
  </div>
</div> <!-- row -->

</div>
@endsection