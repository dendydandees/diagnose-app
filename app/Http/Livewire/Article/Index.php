<?php

namespace App\Http\Livewire\Article;

use App\Models\Article;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $show, $modalDelete = false;
    public $article_id, $article_title, $count;

    public function mount()
    {
        $this->show = !Route::is('dashboard') ? true : false;
        Route::is('dashboard') ? $this->count = 5 : $this->count = 10;
    }

    public function render()
    {
        return view('livewire.article.index', [
            'articles' => Article::orderBy('updated_at', 'desc')->paginate($this->count),
        ]);
    }

    // reset the state
    public function resetFilters()
    {
        $this->reset(['article_id', 'article_title',]);
    }

    public function showDeleteArticleModal($id)
    {
        $this->resetFilters();

        $article = Article::findOrFail($id);
        $this->article_id = $id;
        $this->article_title = $article->title;
        $this->modalDelete = true;
    }

    public function deleteArticle($id)
    {
        $article = Article::findOrFail($id);
        if ($article->images !== '') {
            Storage::delete('public/articles/'.$article->images);
        }
        $article->delete();

        session()->flash('message', 'Artikel berhasil dihapus');

        return redirect()->to('/articles');
    }
}
