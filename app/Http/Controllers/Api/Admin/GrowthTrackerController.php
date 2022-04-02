<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GrowthTracker;

class GrowthTrackerController extends Controller
{

    private $profile = 'profile';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = GrowthTracker::join($this->profile, 'profile.id_user', '=', 'growth_tracker.id_user')->orderBy('id_growth_tracker')->get();

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
        $data = GrowthTracker::updateOrCreate(
            ['id_growth_tracker' => $request->id_growth_tracker],
            [
                'id_user' => $request->user,
                'berat_badan' => $request->berat_badan,
                'index_masa_tumbuh' => $request->index_masa_tumbuh,
                'lingkar_kepala' => $request->lingkar_kepala,
                'lingkar_lengan_atas' => $request->lingkar_lengan_atas,
                'lipatan_kulit' => $request->lipatan_kulit,
                'tinggi_badan' => $request->tinggi_badan,
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
        $data = GrowthTracker::find($id);
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
        $data = GrowthTracker::find($id)->delete();
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
