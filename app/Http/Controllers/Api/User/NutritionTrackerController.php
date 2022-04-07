<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\KategoriNutrition;
Use App\Models\Nutrition;


class NutritionTrackerController extends Controller
{
    public function index(){
        $data_kategori_nutrition = KategoriNutrition::get();
        $data_nutrition = Nutrition::get();

        return response()->json([
            'status' => true,
            'message' => 'Data Didapat',
            'data_kategori_nutrition' => $data_kategori_nutrition,
            'data_nutrition' => $data_nutrition
        ], 200);
    }

    public function getByKategori(Request $request){
        $data_nutrition = Nutrition::where('id_kategori_nutrition', $request->id_kategori_nutrition)->get();

        return response()->json([
            'status' => true,
            'message' => 'Data Didapat',
            'data_nutrition' => $data_nutrition,
        ], 200);
    }
}
