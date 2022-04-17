<?php

namespace App\Http\Controllers\Web\Admin\Quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SoalParentingAssessment;
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
        $data = SoalParentingAssessment::join('kategori_parenting_assessment', 'kategori_parenting_assessment.id_kategori_parenting_assessment', '=', 'soal_parenting_assessment.id_kategori_parenting_assessment')->select('kategori_parenting_assessment.kategori_parenting_assessment', 'kategori_parenting_assessment.kategori_parenting_assessment_en', 'soal_parenting_assessment.*')->get();
        if($request->ajax()){
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_soal_parenting_assessment.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-data">Edit</a>';

                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_soal_parenting_assessment.'" data-original-title="Delete" class="btn btn-danger btn-sm delete-data">Delete</a>';

                return $btn;
            })
            ->addColumn('kunci', function($row){

                if($row->kunci_jawaban == 0){
                    $kunci = 'Tidak';
                } else {
                    $kunci = 'Ya';
                }

                return $kunci;
            })
            ->rawColumns(['action', 'kunci'])
            ->make(true);
        }
        return view('admin.quiz.parenting-assessment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = SoalParentingAssessment::updateOrCreate(
            ['id_soal_parenting_assessment' => $request->id_soal_parenting_assessment],
            [
                'id_kategori_parenting_assessment' => $request->id_kategori_parenting_assessment,
                'soal' => $request->soal,
                'soal_en' => $request->soal_en,
                'kunci_jawaban' => $request->kunci_jawaban,
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
        $data = SoalParentingAssessment::join('kategori_parenting_assessment', 'kategori_parenting_assessment.id_kategori_parenting_assessment', '=', 'soal_parenting_assessment.id_kategori_parenting_assessment')->select('kategori_parenting_assessment.kategori_parenting_assessment', 'kategori_parenting_assessment.kategori_parenting_assessment_en', 'soal_parenting_assessment.*')->find($id);
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
        $data = SoalParentingAssessment::find($id)->delete();
        return response()->json($data);
    }
}
