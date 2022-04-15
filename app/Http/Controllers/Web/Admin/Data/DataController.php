<?php

namespace App\Http\Controllers\Web\Admin\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriParenting;
use App\Models\KategoriNutrition;
use App\Models\JenisParenting;
use App\Models\KategoriParentingAssessment;
use App\Models\KategoriDevelopment;

class DataController extends Controller
{
    public function kategoriNutrition(Request $request){

        $search = $request->search;

        if($search == ''){
            $data = KategoriNutrition::orderby('kategori_nutrition','asc')->select('id_kategori_nutrition','kategori_nutrition')->limit(5)->get();
        } else {
            $data = KategoriNutrition::orderby('kategori_nutrition','asc')->select('id_kategori_nutrition','kategori_nutrition')->where('kategori_nutrition', 'like', '%' .$search . '%')->get();
        }

        $response = array();
        foreach($data as $datas){
            $response[] = array(
                "id"=>$datas->id_kategori_nutrition,
                "text"=>$datas->kategori_nutrition
            );
        }

        return response()->json($response);
    }

    public function kategoriParenting(Request $request){

        $search = $request->search;

        if($search == ''){
            $data = KategoriParenting::orderby('kategori_parenting','asc')->select('id_kategori_parenting','kategori_parenting')->limit(5)->get();
        } else {
            $data = KategoriParenting::orderby('kategori_parenting','asc')->select('id_kategori_parenting','kategori_parenting')->where('kategori_parenting', 'like', '%' .$search . '%')->get();
        }

        $response = array();
        foreach($data as $datas){
            $response[] = array(
                "id"=>$datas->id_kategori_parenting,
                "text"=>$datas->kategori_parenting
            );
        }

        return response()->json($response);
    }

    public function jenisParenting(Request $request){

        $search = $request->search;

        if($search == ''){
            $data = JenisParenting::orderby('jenis_parenting','asc')->select('id_jenis_parenting','jenis_parenting')->limit(5)->get();
        } else {
            $data = JenisParenting::orderby('jenis_parenting','asc')->select('id_jenis_parenting','jenis_parenting')->where('jenis_parenting', 'like', '%' .$search . '%')->get();
        }

        $response = array();
        foreach($data as $datas){
            $response[] = array(
                "id"=>$datas->id_jenis_parenting,
                "text"=>$datas->jenis_parenting
            );
        }

        return response()->json($response);
    }

    public function kategoriParentingAssessment(Request $request){

        $search = $request->search;

        if($search == ''){
            $data = KategoriParentingAssessment::orderby('kategori_parenting_assessment','asc')->select('id_kategori_parenting_assessment','kategori_parenting_assessment')->limit(5)->get();
        } else {
            $data = KategoriParentingAssessment::orderby('kategori_parenting_assessment','asc')->select('id_kategori_parenting_assessment','kategori_parenting_assessment')->where('kategori_parenting_assessment', 'like', '%' .$search . '%')->get();
        }

        $response = array();
        foreach($data as $datas){
            $response[] = array(
                "id"=>$datas->id_kategori_parenting_assessment,
                "text"=>$datas->kategori_parenting_assessment
            );
        }

        return response()->json($response);
    }

    public function kategoriDevelopment(Request $request){

        $search = $request->search;

        if($search == ''){
            $data = KategoriDevelopment::orderby('kategori_development','asc')->select('id_kategori_development','kategori_development')->limit(5)->get();
        } else {
            $data = KategoriDevelopment::orderby('kategori_development','asc')->select('id_kategori_development','kategori_development')->where('kategori_development', 'like', '%' .$search . '%')->get();
        }

        $response = array();
        foreach($data as $datas){
            $response[] = array(
                "id"=>$datas->id_kategori_development,
                "text"=>$datas->kategori_development
            );
        }

        return response()->json($response);
    }
}
