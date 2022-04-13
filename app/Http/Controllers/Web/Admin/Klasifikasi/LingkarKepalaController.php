<?php

namespace App\Http\Controllers\Web\Admin\Klasifikasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KlasifikasiLingkarKepala;
use DataTables;

class LingkarKepalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = KlasifikasiLingkarKepala::orderBy('id_klasifikasi_lingkar_kepala')->get();
        if($request->ajax()){
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_klasifikasi_lingkar_kepala.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-data">Edit</a>';

                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_klasifikasi_lingkar_kepala.'" data-original-title="Delete" class="btn btn-danger btn-sm delete-data">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.klasifikasi.lingkar-kepala');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = KlasifikasiLingkarKepala::updateOrCreate(
            ['id_klasifikasi_lingkar_kepala' => $request->id_klasifikasi_lingkar_kepala],
            [
                'jenis_kelamin' => $request->jenis_kelamin,
                'bulan' => $request->bulan,
                'min' => $request->min,
                'max' => $request->max,
                'klasifikasi_lingkar_kepala' => $request->klasifikasi_lingkar_kepala,
                'klasifikasi_lingkar_kepala_en' => $request->klasifikasi_lingkar_kepala_en,
                'saran_klasifikasi_lingkar_kepala' => $request->saran_klasifikasi_lingkar_kepala,
                'saran_klasifikasi_lingkar_kepala_en' => $request->saran_klasifikasi_lingkar_kepala_en,
                'hex_lingkar_kepala' => $request->hex_lingkar_kepala,
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
        $data = KlasifikasiLingkarKepala::find($id);
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
        $data = KlasifikasiLingkarKepala::find($id)->delete();
        return response()->json($data);
    }
}
