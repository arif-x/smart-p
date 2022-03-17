<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Parenting;

class ParentingController extends Controller
{
    private $profile = 'profile';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $data = Parenting::join($this->profile, 'profile.id_user', '=', 'parenting.id_user')->orderBy('id_parenting')->get();
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
        return view('admin.parenting');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        Parenting::updateOrCreate(
            ['id_parenting' => $request->id_parenting],
            [
                'id_user' => $request->user,
                'modul_pengasuhan_anak' => $request->modul_pengasuhan_anak,
                'video_tutorial_teknik_stimulasi' => $request->video_tutorial_teknik_stimulasi,
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
        $data = Parenting::join($this->profile, 'profile.id_user', '=', 'parenting.id_user')->find($id);
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        Parenting::find($id)->delete();
        return response()->json(['success'=>'Dihapus']);
    }
}
