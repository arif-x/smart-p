<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Tips;

class TipsController extends Controller
{
    private $danak = 'danak';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $data = Tips::join($this->danak, 'danak.id_anak', '=', 'tips.id_anak')->orderBy('id_tips')->get();
        if($request->ajax()){
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_tips.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-data">Edit</a>';

                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_tips.'" data-original-title="Delete" class="btn btn-danger btn-sm delete-data">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.tips');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        Tips::updateOrCreate(
            ['id_tips' => $request->id_tips],
            [
                'id_anak' => $request->anak,
                'menu_tips_kesehatan' => $request->menu_tips_kesehatan,
                'perawatan_anak' => $request->perawatan_anak,
            ]
        );        

        return response()->json(['success'=>'Disimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $data = Tips::join($this->danak, 'danak.id_anak', '=', 'tips.id_anak')->find($id);
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        Tips::find($id)->delete();
        return response()->json(['success'=>'Dihapus']);
    }
}
