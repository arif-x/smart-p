<?php

namespace App\Http\Controllers\Web\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\KategoriArtikel;
use DataTables;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Artikel::join('kategori_artikel', 'kategori_artikel.id_kategori_artikel', '=', 'artikel.id_kategori_artikel')->select('artikel.*', 'kategori_artikel.kategori_artikel', 'kategori_artikel.kategori_artikel_en')->orderBy('id_artikel')->get();
        if($request->ajax()){
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_artikel.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-data">Edit</a>';

                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_artikel.'" data-original-title="Delete" class="btn btn-danger btn-sm delete-data">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $kategori_artikel = KategoriArtikel::pluck('kategori_artikel', 'id_kategori_artikel');

        return view('admin.post.artikel', compact('kategori_artikel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Artikel::updateOrCreate(
            ['id_artikel' => $request->id_artikel],
            [
                'judul_artikel' => $request->judul_artikel,
                'judul_artikel_en' => $request->judul_artikel_en,
                'url_video' => $request->url_video,
                'thumbnail' => $request->thumbnail,
                'label' => $request->label,
                'label_en' => $request->label_en,
                'konten' => $request->konten,
                'konten_en' => $request->konten_en,
                'id_kategori_artikel' => $request->id_kategori_artikel
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
        $data = Artikel::join('kategori_artikel', 'kategori_artikel.id_kategori_artikel', '=', 'artikel.id_kategori_artikel')->select('artikel.*', 'kategori_artikel.kategori_artikel', 'kategori_artikel.kategori_artikel_en')->find($id);
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
        $data = Artikel::find($id)->delete();
        return response()->json($data);
    }
}
