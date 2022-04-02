<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consultation;

class ConsultationController extends Controller
{

    private $profile = 'profile';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Consultation::join($this->profile, 'profile.id_user', '=', 'consultation.id_user')->orderBy('id_consultation')->get();

        if(empty($data)){
            return response()->json([
                'status' => false,
                'message' => 'Data Kosong'
            ], 201);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Didapat',
                'data' => [$data]
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Consultation::updateOrCreate(
            ['id_consultation' => $request->id_consultation],
            [
                'id_user' => $request->user,
                'guru_paud' => $request->guru_paud,
                'psikolog' => $request->psikolog,
            ]
        );   

        if(!($data)){
            return response()->json([
                'status' => false,
                'message' => 'Data Gagal Dibuat/Diedit'
            ], 201);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Dibuat/Diedit',
                'data' => [$data]
            ], 200);
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Consultation::find($id);
        if(empty($data)){
            return response()->json([
                'status' => false,
                'message' => 'Data Gagal Didapat'
            ], 201);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Didapat',
                'data' => [$data]
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Consultation::find($id)->delete();
        if(!($data)){
            return response()->json([
                'status' => false,
                'message' => 'Data Gagal Dihapus'
            ], 201);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Dihapus',
                'data' => [$data]
            ], 200);
        }
    }
}
