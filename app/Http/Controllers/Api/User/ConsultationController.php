<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konsultasi;
use App\Models\KategoriKonsultasi;

class ConsultationController extends Controller
{
    public function index(){
        $data_kategori_konsultasi = KategoriKonsultasi::get();
        $data_konsultasi = Konsultasi::orderBy('jumlah_like', 'DESC')->get();

        return response()->json([
            'status' => true,
            'message' => 'Data Didapat',
            'data_kategori_konsultasi' => $data_kategori_konsultasi, 
            'data_konsultasi' => $data_konsultasi, 
        ], 200);
    }

    public function getByKategori(Request $request){
        $data_konsultasi = Konsultasi::where('id_kategori_konsultasi', $request->id_kategori_konsultasi)->orderBy('tanggal_konsultasi', 'DESC')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data Didapat',
            'data_konsultasi' => $data_konsultasi, 
        ], 200);
    }

    public function store(Request $request){
        $data = Konsultasi::create([
            'id_kategori_konsultasi' => $request->id_kategori_konsultasi,
            'id_user' => $request->id_user,
            'nama_user' => $request->nama_user,
            'tanggal_konsultasi' => $request->tanggal_konsultasi,
            'jawaban_konsultasi' => $request->jawaban_konsultasi,
            'jawaban_konsultasi_en' => $request->jawaban_konsultasi_en,
            'jumlah_like' => $request->jumlah_like
        ]);

        if(!$data){
            return response()->json([
                'status' => false, 
                'message' => 'Data Tidak Bisa Dibuat',
            ], 200);
        } else {
            return response()->json([
                'status' => true, 
                'message' => 'Data Dibuat',
                'data' => $data,
            ], 200);
        }
    }
}
