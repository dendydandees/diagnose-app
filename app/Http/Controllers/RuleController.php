<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Rule;
use App\Models\Symptom;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rules/index');
    }

    public function edit($id)
    {
        $disease = Disease::find($id);
        $symptoms = Symptom::orderBy('id','asc')->get();
        $rules = Rule::orderBy('id','asc')->get();

        return view('rules/edit', compact('disease', 'symptoms', 'rules'));
    }

    public function update($id, Request $request)
    {
        $alternatif = $request->input('alternatif');
        $gejala = $request->input('gejala');
        $nilai = $request->input('nilai');
        $keterangan = $request->input('keterangan');

        $rules = Rule::where('id_disease',$alternatif)->delete();

        for($a=0;$a<count($gejala);$a++){
            Rule::create([
                'id_disease' => $alternatif,
                'id_symptom' => $gejala[$a],
                'description' => $keterangan[$a],
                'value' => $nilai[$a]
            ]);
        }

        return redirect('/rules')->with('success','Data Aturan berhasil diperbaharui');
    }
}
