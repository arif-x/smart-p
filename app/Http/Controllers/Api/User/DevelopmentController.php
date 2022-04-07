<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriDevelopment;
use App\Models\Development;

class DevelopmentController extends Controller
{
    public function index(){
        $data_kategori_development = KategoriDevelopment::get();
        $data_development = Development::get();

        return response()->json([
            'status' => true,
            'message' => 'Data Didapat',
            'data_kategori_development' => $data_kategori_development,
            'data_development' => $data_development
        ], 200);
    }
}
