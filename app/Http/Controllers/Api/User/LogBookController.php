<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\LogBook;

class LogBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = LogBook::where('id_user', $request->id_user)->get();
        return response()->json([
            'status' => true,
            'message' => 'Data Didapat',
            'data' => $data, 
        ], 200);
    }   

    public function store(Request $request)
    {
        // $tanggal = Carbon::createFromFormat('Y-m-d', $request->tanggal)->format('d-m-Y');
        $data = LogBook::insert(
            [
                'id_user' => $request->id_user,
                'tanggal' => $request->tanggal,
                'hari_ke' => $request->hari_ke,
                'log_book' => $request->log_book,
                'feedback' => $request->feedback,
            ]
        );

        return response()->json([
            'status' => true,
            'message' => 'Data Ditambahkan',
            'data' => $data, 
        ], 200);
    }

    public function single(Request $request)
    {
        $data = LogBook::where('id_user', $request->id_user)->where('id_log_book', $request->id_log_book)->get();
        if(empty($data)){
            return response()->json([
                'status' => true,
                'message' => 'Data Nggak Ada',
            ], 200);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Ditambahkan',
                'data' => $data, 
            ], 200);
        }
    }

    public function update(Request $request){
        // $tanggal = Carbon::createFromFormat('Y-m-d', $request->tanggal)->format('d-m-Y');
        $data = LogBook::where('id_user', $request->id_user)->where('id_log_book', $request->id_log_book)->update(
            [
                'tanggal' => $request->tanggal,
                'hari_ke' => $request->hari_ke,
                'log_book' => $request->log_book,
                'feedback' => $request->feedback,
            ]
        );

        return response()->json([
            'status' => true,
            'message' => 'Data Diedit',
            'data' => $data, 
        ], 200);
    }

    public function destroy(Request $request)
    {
        $data = LogBook::where('id_user', $request->id_user)->where('id_log_book', $request->id_log_book)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data Dihapus',
            'data' => $data, 
        ], 200);
    }
}
