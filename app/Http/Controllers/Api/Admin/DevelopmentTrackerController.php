<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DevelopementTracker;

class DevelopementTrackerController extends Controller
{

    private $profile = 'profile';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DevelopementTracker::join($this->profile, 'profile.id_user', '=', 'development_tracker.id_user')->orderBy('id_development_tracker')->get();

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
        $data = DevelopmentTracker::updateOrCreate(
            ['id_development_tracker' => $request->id_development_tracker],
            [
                'id_user' => $request->user,
                'delay' => $request->delay,
                'stimulasi' => $request->stimulasi,
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
        $data = DevelopementTracker::find($id);
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
        $data = DevelopementTracker::find($id)->delete();
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
