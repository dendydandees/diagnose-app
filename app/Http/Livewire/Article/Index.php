<?php

namespace App\Http\Livewire\Article;

use App\Models\Article;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $show = false;

    public function mount()
    {
        $this->show = !Route::is('dashboard') ? true : false;
    }

    public function render()
    {
        return view('livewire.article.index', [
            'articles' => Article::orderBy('updated_at', 'desc')->paginate(10),
        ]);
    }
}
