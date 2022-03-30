<?php

namespace App\Http\Controllers\Api\User;

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

}
