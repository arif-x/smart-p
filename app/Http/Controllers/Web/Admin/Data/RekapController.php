<?php

namespace App\Http\Controllers\Web\Admin\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anak;
use App\Models\RecordPerkembangan;
use DataTables;
use DB;

class RekapController extends Controller
{
    public function index(Request $request){
        $data = DB::select(DB::raw('select * from `anak` left join `record_perkembangan` on `record_perkembangan`.`id_anak` = `anak`.`id_anak` or `anak`.`id_anak` is null GROUP BY `anak`.`id_anak` ORDER BY `record_perkembangan`.`id_anak` DESC'));
        if($request->ajax()){
            return Datatables::of($data)->addIndexColumn()->make(true);
        }
        return view('admin.data.rekap');
        // echo json_encode($data);
    }
}
