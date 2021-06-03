<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use Illuminate\Http\Request;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $symptoms = Symptom::all();
        // foreach($symptoms as $key=>$symptom) {
        //     $key += 1;
        //     $symptom->code = "S-".substr("000{$key}", -3);
        // }
        // dd($symptoms);

        return view('symptoms/index');
    }
}
