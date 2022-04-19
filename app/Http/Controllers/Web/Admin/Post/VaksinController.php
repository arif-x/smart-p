<?php

namespace App\Http\Controllers\Web\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vaksin;
use DataTables;

class VaksinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Vaksin::orderBy('id_vaksin')->get();
        if($request->ajax()){
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_vaksin.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-data">Edit</a>';

                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_vaksin.'" data-original-title="Delete" class="btn btn-danger btn-sm delete-data">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.post.vaksin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Vaksin::updateOrCreate(
            ['id_vaksin' => $request->id_vaksin],
            [
                'nama_vaksin' => $request->nama_vaksin,
                'nama_vaksin_en' => $request->nama_vaksin_en,
                'jadwal_vaksin' => $request->jadwal_vaksin,
                'keterangan_vaksin' => $request->keterangan_vaksin,
                'keterangan_vaksin_en' => $request->keterangan_vaksin_en,
                'detail_vaksin' => $request->detail_vaksin,
                'detail_vaksin_en' => $request->detail_vaksin_en,
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
        $data = Vaksin::find($id);
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
        $data = Vaksin::find($id)->delete();
        return response()->json($data);
    }
}
