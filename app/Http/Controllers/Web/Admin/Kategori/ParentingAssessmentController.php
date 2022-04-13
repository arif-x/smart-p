<?php

namespace App\Http\Controllers\Web\Admin\Kategori;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriParentingAssessment;
use DataTables;

class ParentingAssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = KategoriParentingAssessment::orderBy('id_kategori_parenting_assessment')->get();
        if($request->ajax()){
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_kategori_parenting_assessment.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-data">Edit</a>';

                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_kategori_parenting_assessment.'" data-original-title="Delete" class="btn btn-danger btn-sm delete-data">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.kategori.parenting-assessment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = KategoriParentingAssessment::updateOrCreate(
            ['id_kategori_parenting_assessment' => $request->id_kategori_parenting_assessment],
            [
                'kategori_parenting_assessment' => $request->kategori_parenting_assessment,
                'kategori_parenting_assessment_en' => $request->kategori_parenting_assessment_en,
            ]
        );

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = KategoriParentingAssessment::find($id);
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = KategoriParentingAssessment::find($id)->delete();
        return response()->json($data);
    }
}
