<?php

namespace App\Http\Controllers\Web\Admin\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HistoryParentingAssessment;
use DataTables;

class HistoryParentingAssessmentController extends Controller
{
    public function index(Request $request){
        $data = HistoryParentingAssessment::join('users', 'users.id_user', '=' ,'history_parenting_assessment.id_user')->join('kategori_parenting_assessment', 'kategori_parenting_assessment.id_kategori_parenting_assessment', '=', 'history_parenting_assessment.id_kategori_parenting_assessment')->orderBy('id_history_parenting_assessment', 'DESC')->select('history_parenting_assessment.*','users.email', 'kategori_parenting_assessment.kategori_parenting_assessment')->get();
        if($request->ajax()){
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_user.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-data">Reset Skor ke 0</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.data.history-parenting-assessment');
    }

    public function edit($id){
        $data = HistoryParentingAssessment::join('users', 'users.id_user', '=', 'history_parenting_assessment.id_user')->join('kategori_parenting_assessment', 'kategori_parenting_assessment.id_kategori_parenting_assessment', '=', 'history_parenting_assessment.id_kategori_parenting_assessment')->select('history_parenting_assessment.*','users.email', 'kategori_parenting_assessment.kategori_parenting_assessment')->find($id);
        return response()->json($data);
    }

    public function store(Request $request){
        $data = HistoryParentingAssessment::where('id_user', $request->id_user)->update([
            'skor' => 0
        ]);
        return response()->json($data);
    }
}
