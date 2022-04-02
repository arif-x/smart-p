<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GetUserData;

class GetUserDataController extends Controller{

    public function getUser(Request $request){

        $search = $request->search;

        if($search == ''){
            $data = GetUserData::orderby('nama_anak','asc')->select('id_user','nama_anak')->limit(5)->get();
        } else {
            $data = GetUserData::orderby('nama_anak','asc')->select('id_user','nama_anak')->where('nama_anak', 'like', '%' .$search . '%')->get();
        }

        $response = array();
        foreach($data as $datas){
            $response[] = array(
                "id"=>$datas->id_anak,
                "text"=>$datas->nama_anak
            );
        }

        return response()->json($response);
    }
}
