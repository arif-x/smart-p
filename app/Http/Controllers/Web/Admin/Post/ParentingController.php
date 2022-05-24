<?php

namespace App\Http\Controllers\Web\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParentingApi;
use DataTables;

class ParentingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = ParentingApi::join('kategori_parenting', 'kategori_parenting.id_kategori_parenting', '=', 'parentings.id_kategori_parenting')->join('jenis_parenting', 'jenis_parenting.id_jenis_parenting', '=', 'parentings.id_jenis_parenting')->select('jenis_parenting.jenis_parenting', 'jenis_parenting.jenis_parenting_en', 'kategori_parenting.kategori_parenting', 'kategori_parenting.kategori_parenting_en', 'parentings.*')->orderBy('id_parenting')->get();
        if($request->ajax()){
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_parenting.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-data">Edit</a>';

                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_parenting.'" data-original-title="Delete" class="btn btn-danger btn-sm delete-data">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.post.parenting');    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = ParentingApi::updateOrCreate(
            ['id_parenting' => $request->id_parenting],
            [
                'id_jenis_parenting' => $request->id_jenis_parenting,
                'id_kategori_parenting' => $request->id_kategori_parenting,
                'judul_parenting' => $request->judul_parenting,
                'judul_parenting_en' => $request->judul_parenting_en,
                'thumnile_parenting' => $request->thumnile_parenting,
                'video_parenting' => $request->url_video,
                'konten_parenting' => $request->konten_parenting,
                'konten_parenting_en' => $request->konten_parenting_en
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
        $data = ParentingApi::join('kategori_parenting', 'kategori_parenting.id_kategori_parenting', '=', 'parentings.id_kategori_parenting')->join('jenis_parenting', 'jenis_parenting.id_jenis_parenting', '=', 'parentings.id_jenis_parenting')->select('jenis_parenting.jenis_parenting', 'jenis_parenting.jenis_parenting_en', 'kategori_parenting.kategori_parenting', 'kategori_parenting.kategori_parenting_en', 'parentings.*')->find($id);
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
        $data = ParentingApi::find($id)->delete();
        return response()->json($data);
    }
}
