<?php

namespace App\Http\Controllers\Web\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Development;
use DataTables;

class DevelopmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Development::join('kategori_development', 'kategori_development.id_kategori_development', '=', 'development.id_kategori_development')->select('kategori_development.kategori_development','kategori_development.kategori_development_en', 'development.*')->orderBy('id_development')->get();
        if($request->ajax()){
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_development.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-data">Edit</a>';

                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_development.'" data-original-title="Delete" class="btn btn-danger btn-sm delete-data">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.post.development');    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Development::updateOrCreate(
            ['id_development' => $request->id_development],
            [
                'id_kategori_development' => $request->id_kategori_development,
                'jenis' => $request->jenis,
                'untuk_usia' => $request->untuk_usia,
                'untuk_usia_en' => $request->untuk_usia_en,
                'judul_development' => $request->judul_development,
                'judul_development_en' => $request->judul_development_en,
                'keterangan' => $request->keterangan,
                'keterangan_en' => $request->keterangan_en,
                'stimulus1' => $request->stimulus_1,
                'stimulus1_en' => $request->stimulus_1_en,
                'stimulus2' => $request->stimulus_2,
                'stimulus2_en' => $request->stimulus_2_en,
                'stimulus3' => $request->stimulus_3,
                'stimulus3_en' => $request->stimulus_3_en,
                'stimulus4' => $request->stimulus_4,
                'stimulus4_en' => $request->stimulus_4_en,
                'thumnile' => $request->thumnile,
                'url_video' => $request->url_video,
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
        $data = Development::join('kategori_development', 'kategori_development.id_kategori_development', '=', 'development.id_kategori_development')->select('kategori_development.kategori_development','kategori_development.kategori_development_en', 'development.*')->find($id);
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
        $data = Development::find($id)->delete();
        return response()->json($data);
    }
}
