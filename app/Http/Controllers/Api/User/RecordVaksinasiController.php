<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RecordVaksinasi;
use Carbon\Carbon;

class RecordVaksinasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = RecordVaksinasi::get();
        if(empty($data)){
            return response()->json([
                'status' => false,
                'message' => 'Data Kosong'
            ], 201);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Didapat',
                'data' => $data
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
        $check = RecordVaksinasi::where('id_vaksin', $request->id_vaksin)->where('id_anak', $request->id_anak)->first();

        if(empty($check)){
            $data = RecordVaksinasi::create(
                [
                    'id_anak' => $request->id_anak,
                    'tanggal' => Carbon::now()->format('d/m/Y'),
                    'id_vaksin' => $request->id_vaksin,
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
        } else {
            $data = RecordVaksinasi::where('id_vaksin', $request->id_vaksin)->where('id_anak', $request->id_anak)->delete();
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
}
