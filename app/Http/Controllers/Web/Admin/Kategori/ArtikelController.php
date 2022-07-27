<?php

namespace App\Http\Controllers\Web\Admin\Kategori;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriArtikel;
use DataTables;

class ArtikelController extends Controller
{
    public function index(Request $request){
        $data = KategoriArtikel::get();
        if($request->ajax()){
            return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_kategori_artikel.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-data">Edit</a>';

                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_kategori_artikel.'" data-original-title="Delete" class="btn btn-danger btn-sm delete-data">Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.kategori.artikel');
    }

    public function store(Request $request){
        $data = KategoriArtikel::updateOrCreate(
            ['id_kategori_artikel' => $request->id_kategori_artikel],
            [
                'kategori_artikel' => $request->kategori_artikel,
                'kategori_artikel_en' => $request->kategori_artikel_en,
            ],
        );
        return response()->json($data);
    }

    public function edit($id){
        $data = KategoriArtikel::find($id);
        return response()->json($data);
    }

    public function destroy(){
        $data = KategoriArtikel::find($id)->delete();
        return response()->json($data);
    }
}
