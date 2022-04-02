<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\VaccinationTracker;

class VaccinationTrackerController extends Controller
{
    private $anak = 'anak';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $data = VaccinationTracker::join($this->anak, 'anak.id_anak', '=', 'vaccination_tracker.id_anak')->orderBy('id_vaccination_tracker')->get();
        if($request->ajax()){
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_vaccination_tracker.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-data">Edit</a>';

                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_vaccination_tracker.'" data-original-title="Delete" class="btn btn-danger btn-sm delete-data">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.vaccination-tracker');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        VaccinationTracker::updateOrCreate(
            ['id_vaccination_tracker' => $request->id_vaccination_tracker],
            [
                'id_anak' => $request->anak,
                'jadwal_imunisasi' => $request->jadwal_imunisasi,
                'tipe_imunisasi' => $request->tipe_imunisasi,
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
        $data = VaccinationTracker::join($this->anak, 'anak.id_anak', '=', 'vaccination_tracker.id_anak')->find($id);
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        VaccinationTracker::find($id)->delete();
        return response()->json(['success'=>'Dihapus']);
    }
}
