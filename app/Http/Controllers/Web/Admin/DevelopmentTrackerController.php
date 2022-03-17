<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\DevelopmentTracker;

class DevelopmentTrackerController extends Controller
{
    private $profile = 'profile';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $data = DevelopmentTracker::join($this->profile, 'profile.id_user', '=', 'development_tracker.id_user')->orderBy('id_development_tracker')->get();
        if($request->ajax()){
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_development_tracker.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-data">Edit</a>';

                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_development_tracker.'" data-original-title="Delete" class="btn btn-danger btn-sm delete-data">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.development-tracker');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        DevelopmentTracker::updateOrCreate(
            ['id_development_tracker' => $request->id_development_tracker],
            [
                'id_user' => $request->user,
                'delay' => $request->delay,
                'stimulasi' => $request->stimulasi,
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
        $data = DevelopmentTracker::join($this->profile, 'profile.id_user', '=', 'development_tracker.id_user')->find($id);
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        DevelopmentTracker::find($id)->delete();
        return response()->json(['success'=>'Dihapus']);
    }
}
