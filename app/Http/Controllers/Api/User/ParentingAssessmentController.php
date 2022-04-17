<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriParentingAssessment;
use App\Models\SoalParentingAssessment;
use App\Models\KunciJawabanParentingAssessment;
use App\Models\HistoryParentingAssessment;
use DB;
use Carbon\Carbon;

class ParentingAssessmentController extends Controller
{
    public function kategori(Request $request)
    {

        // nilai di ambil dulu nilai terakhir dari by kategori by  user
        // 2 

        $data = KategoriParentingAssessment::get();
        $check_nilai = HistoryParentingAssessment::where('id_user', $request->id_user)->first();
        

        $total_skor = 0;
        $total_nilai_ok = 0;

        if (empty($check_nilai)) {
            // gak ngapain
        } else {
            for ($i = 0; $i < count($data); $i++) {
                $id_kategori = $data[$i]['id_kategori_parenting_assessment'];
                $where_bt_id_kategori = HistoryParentingAssessment::where('id_kategori_parenting_assessment', $id_kategori)->orderBy('id_history_parenting_assessment', 'DESC')->limit(1)->value('skor');
                $total_nilai_ok += $where_bt_id_kategori;
            }
            $skor = $total_nilai_ok / count($data);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data Didapat',
            'skor' => $skor,
            'data' => $data
        ], 200);
    }

    public function kategoriSingle(Request $request)
    {
        $check = KategoriParentingAssessment::where('id_kategori_parenting_assessment', $request->id_kategori_parenting_assessment)->first();

        $jumlah_soal = SoalParentingAssessment::select(DB::raw('COUNT(id_soal_parenting_assessment) as jumlah'))->where('id_kategori_parenting_assessment', $request->id_kategori_parenting_assessment)->value('jumlah');

        $kunci = KunciJawabanParentingAssessment::join('soal_parenting_assessment', 'soal_parenting_assessment.id_soal_parenting_assessment', '=', 'kunci_jawaban_parenting_assessment.id_soal_parenting_assessment')->get();

        $soal = SoalParentingAssessment::join('kunci_jawaban_parenting_assessment', 'kunci_jawaban_parenting_assessment.id_soal_parenting_assessment', '=', 'soal_parenting_assessment.id_soal_parenting_assessment')->leftJoin('jawaban_parenting_assessment', 'jawaban_parenting_assessment.id_soal_parenting_assessment', '=', 'soal_parenting_assessment.id_soal_parenting_assessment')->where('id_user', $request->id_user)->orWhereNull('id_user')->where('id_kategori_parenting_assessment', $request->id_kategori_parenting_assessment)->select('soal_parenting_assessment.*', 'kunci_jawaban_parenting_assessment.kunci_jawaban', 'jawaban_parenting_assessment.id_user', 'jawaban_parenting_assessment.jawaban')->get();

        $skor = HistoryParentingAssessment::where('id_kategori_parenting_assessment', $request->id_kategori_parenting_assessment)->get();

        if (count($skor) == 0) {
            return response()->json([
                'status' => true,
                'message' => 'Data Didapat',
                'nilai' => 'Belum Dikerjakan',
                'soal' => $check,
            ], 200);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Didapat',
                'nilai' => $skor[count($skor) - 1]['skor'],
                'soal' => $check,
            ], 200);
        }
    }

    public function getSoalByKategori(Request $request)
    {
        $soal = SoalParentingAssessment::where('id_kategori_parenting_assessment', $request->id_kategori_parenting_assessment)->get();

        return response()->json([
            'status' => true,
            'message' => 'Data Didapat',
            'soal' => $soal,
        ], 200);
    }

    public function soal(Request $request)
    {
        $soal = SoalParentingAssessment::get();

        return response()->json([
            'status' => true,
            'message' => 'Data Didapat',
            'soal' => $soal,
        ], 200);
    }

    public function jawab(Request $request){
        $data = HistoryParentingAssessment::insert([
            'id_user' => $request->id_user,
            'id_kategori_parenting_assessment' => $request->id_kategori_parenting_assessment,
            'skor' => $request->skor,
            'tanggal_pengerjaan' => Carbon::now()->format('d/m/Y'),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data Ditambah',
            'data' => $data,
        ], 200);
    }

    public function submit(Request $request)
    {
        $soal = SoalParentingAssessment::where('id_kategori_parenting_assessment', $request->id_kategori_parenting_assessment)->get();

        // if()

        $req = $request->except('id_user', 'id_kategori_parenting_assessment');

        $total_benar = 0;

        foreach ($req as $key => $value) {
            for ($i = 0; $i < count($soal); $i++) {
                if ($value == $soal[$i]->kunci_jawaban) {
                    $total_benar++;
                }
            }
        }

        $jumlah_soal = count($soal);

        $skor = $total_benar / $jumlah_soal * 100;

        $insert = HistoryParentingAssessment::create([
            'id_user' => $request->id_user,
            'id_kategori_parenting_assessment' => $request->id_kategori_parenting_assessment,
            'skor' => $skor,
            'tanggal_pengerjaan' => Carbon::now()->format('d/m/Y'),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data Ditambah',
            'data' => $insert,
        ], 200);
    }

    public function submitSingle(Request $request)
    {
        $data = JawabanParentingAssessment::updateOrCreate(
            ['id_jawaban_parenting_assessment' => $request->id_jawaban_parenting_assessment],
            [
                'id_user' => $request->id_user,
                'id_soal_parenting_assessment' => $request->id_soal_parenting_assessment,
                'jawaban' => $request->jawaban
            ]
        );

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data Tidak Ditambah/Edit',
            ], 200);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Ditambah/Edit',
                'data' => $data,
            ], 200);
        }
    }

    public function submitAll(Request $request)
    {
        $kategori = KategoriParentingAssessment::where('id_kategori_parenting_assessment', $request->id_kategori_parenting_assessment)->value('id_kategori_parenting_assessment');

        $jumlah_soal = SoalParentingAssessment::select(DB::raw('COUNT(id_soal_parenting_assessment) as jumlah'))->where('id_kategori_parenting_assessment', $request->id_kategori_parenting_assessment)->value('jumlah');

        $soal = SoalParentingAssessment::join('kunci_jawaban_parenting_assessment', 'kunci_jawaban_parenting_assessment.id_soal_parenting_assessment', '=', 'soal_parenting_assessment.id_soal_parenting_assessment')->leftJoin('jawaban_parenting_assessment', 'jawaban_parenting_assessment.id_soal_parenting_assessment', '=', 'soal_parenting_assessment.id_soal_parenting_assessment')->where('id_user', $request->id_user)->orWhereNull('id_user')->where('id_kategori_parenting_assessment', $kategori)->select('soal_parenting_assessment.*', 'kunci_jawaban_parenting_assessment.kunci_jawaban', 'jawaban_parenting_assessment.id_user', 'jawaban_parenting_assessment.jawaban')->get();

        $benar = 0;

        for ($i = 0; $i < count($soal); $i++) {
            if ($soal[$i]->jawaban == $soal[$i]->kunci_jawaban) {
                $benar++;
            }
        }

        $skor = $benar / $jumlah_soal * 100;

        $data = HistoryParentingAssessment::create([
            'id_user' => $request->id_user,
            'id_kategori_parenting_assessment' => $kategori,
            'skor' => $skor,
            'tanggal_pengerjaan' => Carbon::now()->format('d/m/Y'),
        ]);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data Tidak Ditambah/Edit',
            ], 200);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data Ditambah/Edit',
                'data' => $data,
            ], 200);
        }
    }
}
