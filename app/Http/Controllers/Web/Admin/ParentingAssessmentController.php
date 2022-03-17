<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\ParentingAssessment;

class ParentingAssessmentController extends Controller
{
    private $profile = 'profile';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $data = ParentingAssessment::join($this->profile, 'profile.id_user', '=', 'parenting_assessment.id_user')->orderBy('id_parenting_assessment')->get();
        if($request->ajax()){
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_parenting_assessment.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-data">Edit</a>';

                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_parenting_assessment.'" data-original-title="Delete" class="btn btn-danger btn-sm delete-data">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.parenting-assessment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        ParentingAssessment::updateOrCreate(
            ['id_parenting_assessment' => $request->id_parenting_assessment],
            [
                'id_user' => $request->user,
                'pengukuran_pengetahuan_parenting' => $request->pengukuran_pengetahuan_parenting,
                'pengukuran_parenting_self_efficacy' => $request->pengukuran_parenting_self_efficacy,
                'pengukuran_keterampilan_mengasuh_anak' => $request->pengukuran_keterampilan_mengasuh_anak,
            ]
        );        

        return response()->json(['success'=>'Disimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $data = ParentingAssessment::join($this->profile, 'profile.id_user', '=', 'parenting_assessment.id_user')->find($id);
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        ParentingAssessment::find($id)->delete();
        return response()->json(['success'=>'Dihapus']);
    }
}
