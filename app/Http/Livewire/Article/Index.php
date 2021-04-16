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
    public $article_id, $article_title;

    public function mount()
    {
        $this->show = !Route::is('dashboard') ? true : false;
    }

    public function render()
    {
        Route::is('dashboard') ? $count = 5 : $count = 10;
        return view('livewire.article.index', [
            'articles' => Article::orderBy('updated_at', 'desc')->paginate($count),
        ]);
    }

    public function showDeleteArticleModal($id)
    {
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
