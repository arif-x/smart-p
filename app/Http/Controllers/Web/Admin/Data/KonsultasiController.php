<?php

namespace App\Http\Controllers\Web\Admin\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Konsultasi;

class KonsultasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Konsultasi::join('kategori_konsultasi', 'kategori_konsultasi.id_kategori_konsultasi', '=', 'konsultasi.id_kategori_konsultasi')->orderBy('id_konsultasi')->get();
        if($request->ajax()){
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_konsultasi.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-data">Jawab</a>';

                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_konsultasi.'" data-original-title="Delete" class="btn btn-danger btn-sm delete-data">Delete</a>';

                return $btn;
            })
            ->addColumn('check', function($row){
                $data = '';
                if($row->jawaban_konsultasi == '-'){
                    $data = 'Belum Terjawab';
                } else {
                    $data = 'Terjawab';
                }

                return $data;
            })
            ->rawColumns(['action', 'check'])
            ->make(true);
        }
        return view('admin.data.konsultasi');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Konsultasi::updateOrCreate(
            ['id_konsultasi' => $request->id_konsultasi],
            [
                'jawaban_konsultasi' => $request->jawaban_konsultasi,
            ]
        );

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Konsultasi::find($id);
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Konsultasi::find($id)->delete();
        return response()->json($data);
    }
}
