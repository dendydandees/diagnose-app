<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiseaseController extends Controller
{
    public $messages = [
        'required' => ':attribute tidak boleh kosong.',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('diseases/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $get_count_disease = Disease::all()->count();
        $get_count_disease += 1;
        $code = "D".substr("000{$get_count_disease}", -3);

        return view('diseases/create', compact('code'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(),[
            'code' => 'required|unique:diseases',
            'name' => 'required',
            'type' => 'required',
            'description' => 'required',
        ],$this->messages)->validate();

        Disease::create([
            'code' => $request->code,
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
        ]);

        return redirect('/diseases')->with('message', 'Gangguan berhasil disimpan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function edit(Disease $disease)
    {
        $list_code = Disease::all('code')->sort();

        return view('diseases/edit', compact('disease', 'list_code'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disease $disease)
    {
        Validator::make($request->all(),[
            'code' => 'required',
            'name' => 'required',
            'type' => 'required',
            'description' => 'required',
        ],$this->messages)->validate();

        if ($disease->code != $request->code) {
            $old_code = $disease->code;
            $new_code = $request->code;
            $same_disease = Disease::firstWhere('code', $new_code);

            $disease->update([
                'code' => $new_code,
            ]);

            $same_disease->update([
                'code' => $old_code,
            ]);
        }

        $disease->update([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
        ]);

        return redirect('/diseases')->with('message', 'Gangguan berhasil diperbarui!');
    }
}
