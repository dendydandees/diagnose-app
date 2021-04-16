<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Expert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public $messages = [
        'image' => ':attribute harus berupa gambar',
        'required' => ':attribute tidak boleh kosong.',
        'mimes' => ':attribute harus berupa file dengan tipe :values.'
    ];

    public function list()
    {
        return view('articles/list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('articles/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $select_status = collect(['enabled', 'disabled']);
        $experts = Expert::with('user')->get();
        return view('articles/create', compact('experts', 'select_status'));
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
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'title' => 'required|unique:articles',
            'body' => 'required',
            'status' => 'required',
            'writer' => 'required',
        ],$this->messages)->validate();

        // check keywords value
        if ($request->keywords !== null) {
            $request->keywords = array_map('trim', array_filter(explode(',', $request->keywords), 'trim'));
        } else {
            $request->keywords = ['Diagnose'];
        }

        // check images value
        $image_name = '';
        if ($request->image != null) {
            $image_name = Str::of($request->title)->slug('-').".".$request->image->extension();
            $request->image->storeAs(
                'public/articles', $image_name
            );
        }

        // slug
        $slug = Str::of($request->title)->slug('-');

        Article::create([
            'images' => $image_name,
            'slug' => $slug,
            'title' => $request->title,
            'body' => $request->body,
            'status' => $request->status,
            'keywords' => $request->keywords,
            'viewcount' => 0,
            'writer' => $request->writer,
        ]);

        return redirect('/articles')->with('message', 'Artikel berhasil disimpan!');
    }

    public function slug(Article $article)
    {
        // count + 1 viewcount every goes to this route
        if(Auth::user()->hasRole('user'))
        {
            $viewcount = $article->viewcount+=1;
            $article->update([
                'viewcount' => $viewcount
            ]);
        }

        return view('articles/show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $select_status = collect(['enabled', 'disabled']);
        $experts = Expert::with('user')->get();

        return view('articles/edit', compact('article', 'experts', 'select_status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        Validator::make($request->all(),[
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'title' => 'required',
            'body' => 'required',
            'status' => 'required',
            'writer' => 'required',
        ],$this->messages)->validate();

        // check keywords value
        if ($request->keywords !== null) {
            $request->keywords = array_map('trim', array_filter(explode(',', $request->keywords), 'trim'));
        } else {
            $request->keywords = ['Diagnose'];
        }

        // check images value
        $image_name = '';
        if ($request->image != null) {
            // remove old file
            if ($article->images !== '') {
                Storage::delete('public/articles/'.$article->images);
            }

            // upload new file
            $image_name = Str::of($request->title)->slug('-').".".$request->image->extension();
            $request->image->storeAs(
                'public/articles', $image_name
            );
            // update article image
            $article->update([
                'images' => $image_name
            ]);
        }

        // slug
        $slug = Str::of($request->title)->slug('-');

        $article->update([
            'slug' => $slug,
            'title' => $request->title,
            'body' => $request->body,
            'status' => $request->status,
            'keywords' => $request->keywords,
            'writer' => $request->writer,
        ]);

        return redirect('/articles')->with('message', 'Artikel berhasil diperbarui!');
    }
}
