<?php

namespace App\Http\Controllers\Web\Admin\Klasifikasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KlasifikasiTinggiBadan;
use DataTables;

class TinggiBadanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = KlasifikasiTinggiBadan::orderBy('id_klasifikasi_tinggi_badan')->get();
        if($request->ajax()){
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_klasifikasi_tinggi_badan.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-data">Edit</a>';

                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_klasifikasi_tinggi_badan.'" data-original-title="Delete" class="btn btn-danger btn-sm delete-data">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.klasifikasi.tinggi-badan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = KlasifikasiTinggiBadan::updateOrCreate(
            ['id_klasifikasi_tinggi_badan' => $request->id_klasifikasi_tinggi_badan],
            [
                'jenis_kelamin' => $request->jenis_kelamin,
                'bulan' => $request->bulan,
                'min' => $request->min,
                'max' => $request->max,
                'klasifikasi_tinggi_badan' => $request->klasifikasi_tinggi_badan,
                'klasifikasi_tinggi_badan_en' => $request->klasifikasi_tinggi_badan_en,
                'saran_klasifikasi_tinggi_badan' => $request->saran_klasifikasi_tinggi_badan,
                'saran_klasifikasi_tinggi_badan_en' => $request->saran_klasifikasi_tinggi_badan_en,
                'hex_tinggi_badan' => $request->hex_tinggi_badan,
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
        $data = KlasifikasiTinggiBadan::find($id);
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
        $data = KlasifikasiTinggiBadan::find($id)->delete();
        return response()->json($data);
    }
}
