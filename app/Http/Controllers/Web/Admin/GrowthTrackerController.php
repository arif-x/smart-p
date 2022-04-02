<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GrowthTracker;
use DataTables;

class GrowthTrackerController extends Controller
{

    private $anak = 'anak';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $data = GrowthTracker::join($this->anak, 'anak.id_anak', '=', 'growth_tracker.id_anak')->orderBy('id_growth_tracker')->get();
        if($request->ajax()){
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_growth_tracker.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-data">Edit</a>';

                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_growth_tracker.'" data-original-title="Delete" class="btn btn-danger btn-sm delete-data">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.growth-tracker');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        GrowthTracker::updateOrCreate(
            ['id_growth_tracker' => $request->id_growth_tracker],
            [
                'id_anak' => $request->anak,
                'berat_badan' => $request->berat_badan,
                'index_masa_tumbuh' => $request->index_masa_tumbuh,
                'lingkar_kepala' => $request->lingkar_kepala,
                'lingkar_lengan_atas' => $request->lingkar_lengan_atas,
                'lipatan_kulit' => $request->lipatan_kulit,
                'tinggi_badan' => $request->tinggi_badan,
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
        $data = GrowthTracker::join($this->anak, 'anak.id_anak', '=', 'growth_tracker.id_anak')->find($id);
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        GrowthTracker::find($id)->delete();
        return response()->json(['success'=>'Dihapus']);
    }
}
