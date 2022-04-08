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
        $data_konsultasi = Konsultasi::join('users', 'users.id_user', '=', 'konsultasi.id_user')->orderBy('jumlah_like', 'DESC')->select('users.email as nama_user', 'konsultasi.*')->get();

        return response()->json([
            'status' => true,
            'message' => 'Data Didapat',
            'data_kategori_konsultasi' => $data_kategori_konsultasi, 
            'data_konsultasi' => $data_konsultasi, 
        ], 200);
    }

    public function getByKategori(Request $request){
        $data_konsultasi = Konsultasi::join('users', 'users.id_user', '=', 'konsultasi.id_user')->orderBy('jumlah_like', 'DESC')->where('id_kategori_konsultasi', $request->id_kategori_konsultasi)->orderBy('tanggal_konsultasi', 'DESC')->select('users.email as nama_user', 'konsultasi.*')->get();
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
            'tanggal_konsultasi' => $request->tanggal_konsultasi,
            'pertanyaan' => $request->pertanyaan,
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
