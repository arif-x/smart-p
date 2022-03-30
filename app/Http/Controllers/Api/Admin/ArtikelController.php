<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;
use Auth;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Artikel::get();
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
        $data = Artikel::updateOrCreate(
            ['id_artikel' => $request->id_artikel],
            [
                'judul_artikel' => $request->judul_artikel,
                'thumbnail' => $request->thumbnail,
                'label' => $request->label,
                'konten' => $request->konten,
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
        $data = Artikel::find($id);
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
        $data = Artikel::find($id)->delete();
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
