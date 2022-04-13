<?php

namespace App\Http\Controllers\Web\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nutrition;
use DataTables;

class NutritionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Nutrition::join('kategori_nutrition', 'kategori_nutrition.id_kategori_nutrition', '=', 'nutrition.id_kategori_nutrition')->select('kategori_nutrition.kategori_nutrition', 'kategori_nutrition.kategori_nutrition_en', 'nutrition.*')->orderBy('id_nutrition')->get();
        if($request->ajax()){
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_nutrition.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edit-data">Edit</a>';

                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_nutrition.'" data-original-title="Delete" class="btn btn-danger btn-sm delete-data">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.post.nutrition');    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Nutrition::updateOrCreate(
            ['id_nutrition' => $request->id_nutrition],
            [
                'id_kategori_nutrition' => $request->id_kategori_nutrition,
                'judul_nutrition' => $request->judul_nutrition,
                'judul_nutrition_en' => $request->judul_nutrition_en,
                'img_nutrition' => $request->img_nutrition,
                'konten_nutrition' => $request->konten_nutrition,
                'konten_nutrition_en' => $request->konten_nutrition_en
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
        $data = Nutrition::join('kategori_nutrition', 'kategori_nutrition.id_kategori_nutrition', '=', 'nutrition.id_kategori_nutrition')->select('kategori_nutrition.kategori_nutrition', 'kategori_nutrition.kategori_nutrition_en', 'nutrition.*')->find($id);
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
        $data = Nutrition::find($id)->delete();
        return response()->json($data);
    }
}
