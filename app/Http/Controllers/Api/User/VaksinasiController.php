<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vaksinasi;
use Auth;

class VaksinasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Vaksinasi::where('id_user', Auth::user()->id_user)->get();
        if(empty($data)){
            return response()->json([
                'Success' => 'Data kosong'
            ], 201);
        } else {
            return response()->json([
                'Success' => 'Data didapat',
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
        $data = Anak::updateOrCreate(
            ['id_anak' => $request->id_anak],
            [
                'id_user' => Auth::user()->id_user,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nama_anak' => $request->nama_anak,
                'nama_panggilan' => $request->nama_panggilan
            ]
        );

        if(!($data)){
            return response()->json([
                'Error' => 'Data nggak ditambah/edit'
            ], 201);
        } else {
            return response()->json([
                'Success' => 'Data ditambah/edit',
                'data' => $data
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
        $data = Vaksinasi::find($id);
        if(empty($data)){
            return response()->json([
                'Error' => 'Data nggak ada'
            ], 201);
        } else {
            return response()->json([
                'Success' => 'Data ada',
                'data' => $data
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
        $data = Vaksinasi::find($id)->delete();
        if(!($data)){
            return response()->json([
                'Error' => 'Data nggak ada'
            ], 201);
        } else {
            return response()->json([
                'Success' => 'Data dihapus',
                'data' => $data
            ], 200);
        }
    }
}
