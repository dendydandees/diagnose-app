<?php

namespace App\Http\Controllers;

use App\Models\ConsultationHistory;
use App\Models\Disease;
use App\Models\Symptom;
use App\Models\User;
use App\Models\UserInput;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConsultationController extends Controller
{
    public function history()
    {
        return view('consult/user-consultation-history');
    }

    public function index(Request $request)
    {
        $penyakit = Disease::all();
        $total_gejala = Symptom::count();
        $total_penyakit = Disease::count();

        return view('consult/index',
            [
                'total_gejala' => $total_gejala,
                'total_penyakit' => $total_penyakit,
                'penyakit' => $penyakit,
                'request'=>$request
            ]
        );
    }

    public function store(Request $request)
    {
        session_start();
        $id_user = Auth::user()->id;
        $inisial = $_GET['inisial'];
        $jawaban = $_GET['jawaban'];
        $urutan = $_GET['urutan'];
        $jenis = $_GET['jenis'];
        $ya_panik = $_GET['ya_panik'];
        $ya_cemas = $_GET['ya_cemas'];


        $cek = UserInput::where('user',$id_user)->where('symptom',$inisial);
        if ($cek->count() != 0) {
            UserInput::where('user', $id_user)->delete();
            return redirect(route('consult'));
        }
        UserInput::create(['user' => $id_user, 'symptom' => $inisial, 'value' => $jawaban]);

        $p_panik = Disease::where('type','Jenis Gangguan Panik')->get();
        $p_panik_rows = array();
        foreach($p_panik as $row){
            array_push($p_panik_rows,$row->code);
        }


        $p_cemas = Disease::where('type','Jenis Gangguan Kecemasan')->get();
        $p_cemas_rows = array();
        foreach($p_cemas as $row){
            array_push($p_cemas_rows,$row->code);
        }



        $x_or_panik = array();
        $or = DB::select("select symptoms.code from rules,symptoms,diseases where symptoms.id=rules.id_symptom and rules.description='or' and diseases.id=rules.id_disease and diseases.type='Jenis Gangguan Panik'");
        foreach($or as $o){
            if(!in_array($o->code, $x_or_panik)){
                array_push($x_or_panik, $o->code);
            }
        }

        $x_or_cemas = array();
        $or = DB::select("select symptoms.code from rules,symptoms,diseases where symptoms.id=rules.id_symptom and rules.description='or' and diseases.id=rules.id_disease and diseases.type='Jenis Gangguan Kecemasan'");
        foreach($or as $o){
            if(!in_array($o->code, $x_or_cemas)){
                array_push($x_or_cemas, $o->code);
            }
        }





        $x_and_panik = array();
        $and = DB::select("select symptoms.code from rules,symptoms,diseases where symptoms.id=rules.id_symptom and rules.description='and' and diseases.id=rules.id_disease and diseases.type='Jenis Gangguan Panik'");
        foreach($and as $o){
            if(!in_array($o->code, $x_and_panik)){
                array_push($x_and_panik, $o->code);
            }
        }

        $x_and_cemas = array();
        $and = DB::select("select symptoms.code from rules,symptoms,diseases where symptoms.id=rules.id_symptom and rules.description='and' and diseases.id=rules.id_disease and diseases.type='Jenis Gangguan Kecemasan'");
        foreach($and as $o){
            if(!in_array($o->code, $x_and_cemas)){
                array_push($x_and_cemas, $o->code);
            }
        }




        $total_jumlah_penyakit = Disease::get();
        $tjp = count($total_jumlah_penyakit);


        $panik_or = $x_or_panik;
        $panik_and = $x_and_panik;
        $panik_penyakit = $p_panik_rows;
        $minimal_panik = 4;

        $cemas_or = $x_or_cemas;
        $cemas_and = $x_and_cemas;
        $cemas_penyakit = $p_cemas_rows;
        $minimal_cemas = 3;






        $urutan += 1;





        if($jenis == "panik_or"){

            if($jawaban == 1){
                $ya_panik += 1;
            }


            if(isset($panik_or[$urutan])){
                $gejala_selanjutnya = $panik_or[$urutan];
                return redirect(route('consult', ['gejala' => $gejala_selanjutnya, 'urutan' => $urutan, 'jenis' => $jenis, 'ya_panik' => $ya_panik, 'ya_cemas' => $ya_cemas]))->with('success','Pertanyaan selanjutnya');

            }else{

                if($ya_panik >= $minimal_panik){

                    $jenis = "panik_and";
                    $urutan = 0;
                    $gejala_selanjutnya = $panik_and[$urutan];

                    return redirect(route('consult', ['gejala' => $gejala_selanjutnya, 'urutan' => $urutan, 'jenis' => $jenis, 'ya_panik' => $ya_panik, 'ya_cemas' => $ya_cemas]))->with('success','Pertanyaan selanjutnya');
                }else{

                    $jenis = "cemas_or";
                    $urutan = 0;
                    $gejala_selanjutnya = $cemas_or[$urutan];

                    return redirect(route('consult', ['gejala' => $gejala_selanjutnya, 'urutan' => $urutan, 'jenis' => $jenis, 'ya_panik' => $ya_panik, 'ya_cemas' => $ya_cemas]))->with('success','Pertanyaan selanjutnya');
                }

            }

        }






        if($jenis == "panik_and"){
            if(isset($panik_and[$urutan])){
                $gejala_selanjutnya = $panik_and[$urutan];
                return redirect(route('consult', ['gejala' => $gejala_selanjutnya, 'urutan' => $urutan, 'jenis' => $jenis, 'ya_panik' => $ya_panik, 'ya_cemas' => $ya_cemas]))->with('success','Pertanyaan selanjutnya');
            }else{

                $gejala_and_panik_user = array();

                $x = DB::select("select distinct code from user_inputs,symptoms,rules where user='$id_user' and user_inputs.symptom=symptoms.code and rules.id_symptom=symptoms.id and description='and' and user_inputs.value='1'");

                foreach($x as $xx){
                    $xxx = $xx->code;

                    if(!in_array($xxx, $gejala_and_panik_user)){
                        array_push($gejala_and_panik_user, $xxx);
                    }

                }

                $hasil = 1;
                $ax = count($p_panik_rows);
                for($a = 0; $a < $tjp; $a++){


                    if($_SESSION['rule'][$a]['jenis'] == "Jenis Gangguan Panik"){

                        $arr_and = $_SESSION['rule'][$a]['and'];
                        if($gejala_and_panik_user == $arr_and){

                            $hasil = $_SESSION['rule'][$a]['alternatif'];
                        }

                    }

                }


                $consult_create = ConsultationHistory::create([
                    "result" => $hasil,
                    "user_id" => $id_user,
                    "answer" => null
                ]);

                $this->consult_proccess($consult_create->id);
                return redirect(route('consult_summary', ["id" => $consult_create->id]));

            }
        }




        if($jenis == "cemas_or"){

            if($jawaban == 1){
                $ya_cemas+=1;
            }

            if(isset($cemas_or[$urutan])){
                $gejala_selanjutnya = $cemas_or[$urutan];
                return redirect(route('consult', ['gejala' => $gejala_selanjutnya, 'urutan' => $urutan, 'jenis' => $jenis, 'ya_panik' => $ya_panik, 'ya_cemas' => $ya_cemas]))->with('success','Pertanyaan selanjutnya');
            }else{

                if($ya_cemas >= $minimal_cemas){

                    $jenis = "cemas_and";
                    $urutan = 0;
                    $gejala_selanjutnya = $cemas_and[$urutan];

                    return redirect(route('consult', ['gejala' => $gejala_selanjutnya, 'urutan' => $urutan, 'jenis' => $jenis, 'ya_panik' => $ya_panik, 'ya_cemas' => $ya_cemas]))->with('success','Pertanyaan selanjutnya');
                }else{
                    $consult_create = ConsultationHistory::create([
                        "result" => '0',
                        "user_id" => $id_user,
                        "answer" => null
                    ]);

                    $this->consult_proccess($consult_create->id);
                    return redirect(route('consult_summary', ["id" => $consult_create->id]));
                }


            }

        }




        if($jenis == "cemas_and"){
            if(isset($cemas_and[$urutan])){
                $gejala_selanjutnya = $cemas_and[$urutan];
                return redirect(route('consult', ['gejala' => $gejala_selanjutnya, 'urutan' => $urutan, 'jenis' => $jenis, 'ya_panik' => $ya_panik, 'ya_cemas' => $ya_cemas]))->with('success','Pertanyaan selanjutnya');
            }else{

                $gejala_and_cemas_user = array();

                $x = DB::select("select distinct code from user_inputs,symptoms,rules where user_inputs.user='$id_user' and user_inputs.symptom=symptoms.code and rules.id_symptom=symptoms.id and description='and' and user_inputs.value='1'");

                foreach($x as $xx){
                    $xxx = $xx->code;

                    if(!in_array($xxx, $gejala_and_cemas_user)){
                        array_push($gejala_and_cemas_user, $xxx);
                    }

                }

                $cp = Disease::where('type','Jenis Gangguan Kecemasan')->first();

                $hasil = $cp->id;

                $ax = count($p_cemas_rows);
                for($a = $ax; $a < $tjp; $a++){

                    if($_SESSION['rule'][$a]['jenis'] == "Jenis Gangguan Kecemasan"){

                        $arr_and = $_SESSION['rule'][$a]['and'];
                        if($gejala_and_cemas_user == $arr_and){
                            $hasil = $_SESSION['rule'][$a]['alternatif'];
                        }

                    }

                }


                $consult_create = ConsultationHistory::create([
                    "result" => $hasil,
                    "user_id" => $id_user,
                    "answer" => null
                ]);

                $this->consult_proccess($consult_create->id);
                return redirect(route('consult_summary', ["id" => $consult_create->id]));

            }
        }
    }

    public function consult_proccess($consult_id)
    {
        $id_pasien = Auth::user()->id;

        $inputan = DB::table('user_inputs')
            ->join('symptoms', 'user_inputs.symptom', '=', 'symptoms.code')
            ->where("user_inputs.user",$id_pasien)
            ->select('user_inputs.*', 'symptoms.*')
            ->get();


        $history = ConsultationHistory::find($consult_id);

        $history->answer = $inputan;
        $history->save();
        UserInput::where('user', $id_pasien)->delete();
    }

    public function summary ($id)
    {
        $user = null;
        $user_history = Auth::user();

        if ($user_history->hasRole('user')) {
            $user = $user_history;
            $user_history = $user->history->find($id);
        } else {
            $user_history = ConsultationHistory::find($id);
            $user = User::find($user_history->user_id);
        }

        if (!$user_history) {
            return redirect(route('consult_history'))->with('message', 'Riwayat Konsultasi Tidak Ditemukan!');
        }

        return view('consult/consultation-result',
            [
                'user' => $user,
                'user_history' => $user_history,
                'user_input' => collect($user_history->answer),
            ]
        );
    }
}
