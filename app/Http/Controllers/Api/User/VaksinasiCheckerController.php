<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RecordVaksinasi;
use App\Models\Vaksin;
use App\Models\Anak;

class VaksinasiCheckerController extends Controller
{
    public function index(Request $request){
        $data_anak = Anak::where('id_user', $request->id_user)->get();
        $data_vaksin = Vaksin::where('id_bahasa', $request->id_bahasa)->get();
        
        for ($i=0; $i < count($data_vaksin); $i++) { 
            $data_vaksinasi = RecordVaksinasi::where('id_vaksin', $data_vaksin[$i]['id_vaksin'])->where('id_anak', $request->id_anak)->get();
            if(count($data_vaksinasi) == 0){
                $data_vaksin[$i]['status'] = 0;
            } else {
                $data_vaksin[$i]['status'] = 1;
            }
        }


        return response()->json([
            'status' => true,
            'message' => 'Data sukses didapat',
            'data_check_vaksin' => $data_vaksin
        ], 200);
    }
}
