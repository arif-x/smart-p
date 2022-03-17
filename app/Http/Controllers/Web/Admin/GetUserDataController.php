<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GetUserData;

class GetUserDataController extends Controller{

    public function getUser(Request $request){

        $search = $request->search;

        if($search == ''){
            $data = GetUserData::orderby('nama','asc')->select('id_user','nama')->limit(5)->get();
        } else {
            $data = GetUserData::orderby('nama','asc')->select('id_user','nama')->where('nama', 'like', '%' .$search . '%')->get();
        }

        $response = array();
        foreach($data as $datas){
            $response[] = array(
                "id"=>$datas->id_user,
                "text"=>$datas->nama
            );
        }

        return response()->json($response);
    }
}
