<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParentingApi;
use App\Models\JenisParenting;
use App\Models\KategoriParenting;

class ParentingController extends Controller
{
    public function artikel(){
        $data_jenis_parenting = JenisParenting::get();
        $data_kategori_parenting = KategoriParenting::where('id_jenis_parenting', $data_jenis_parenting[0]['id_jenis_parenting'])->get();
        $data_parenting = ParentingApi::join('kategori_parenting', 'kategori_parenting.id_kategori_parenting', '=', 'parentings.id_kategori_parenting')->where('parentings.id_jenis_parenting', $data_jenis_parenting[0]['id_jenis_parenting'])->select('parentings.*', 'kategori_parenting.kategori_parenting', 'kategori_parenting.kategori_parenting_en')->get();

        return response()->json([
            'status' => true,
            'message' => 'Data Didapat',
            'data_jenis_parenting' => $data_jenis_parenting,
            'data_kategori_parenting' => $data_kategori_parenting,
            'data_parenting' => $data_parenting,
        ], 200);
    }

    public function video(){
        $data_jenis_parenting = JenisParenting::get();
        $data_kategori_parenting = KategoriParenting::where('id_jenis_parenting', $data_jenis_parenting[1]['id_jenis_parenting'])->get();

        $data_parenting = ParentingApi::join('kategori_parenting', 'kategori_parenting.id_kategori_parenting', '=', 'parentings.id_kategori_parenting')->where('parentings.id_jenis_parenting', $data_jenis_parenting[1]['id_jenis_parenting'])->select('parentings.*', 'kategori_parenting.kategori_parenting', 'kategori_parenting.kategori_parenting_en')->get();

        return response()->json([
            'status' => true,
            'message' => 'Data Didapat',
            'data_jenis_parenting' => $data_jenis_parenting,
            'data_kategori_parenting' => $data_kategori_parenting,
            'data_parenting' => $data_parenting,
        ], 200);
    }

    public function custom(Request $request){
        $data_jenis_parenting = JenisParenting::where('id_jenis_parenting', $request->id_jenis_parenting)->get();
        $data_kategori_parenting = KategoriParenting::where('id_kategori_parenting', $request->id_kategori_parenting)->get();
        $data_parenting = ParentingApi::join('kategori_parenting', 'kategori_parenting.id_kategori_parenting', '=', 'parentings.id_kategori_parenting')->where('parentings.id_jenis_parenting', $data_jenis_parenting[0]['id_jenis_parenting'])->select('parentings.*', 'kategori_parenting.kategori_parenting', 'kategori_parenting.kategori_parenting_en')->get();

        return response()->json([
            'status' => true,
            'message' => 'Data Didapat',
            'data_jenis_parenting' => $data_jenis_parenting,
            'data_kategori_parenting' => $data_kategori_parenting,
            'data_parenting' => $data_parenting,
        ], 200);
    }
}
