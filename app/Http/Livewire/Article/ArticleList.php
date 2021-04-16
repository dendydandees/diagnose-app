<?php

namespace App\Http\Livewire\Article;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $perPage = 4;

    public function loadMore()
    {
        $this->perPage = $this->perPage + 4;
    }

    public function render()
    {
        $get_all_articles = Article::where('status', 'enabled')->orderBy('updated_at', 'desc')->get();
        $hot_articles = $get_all_articles->take(1)->first();
        $articles = Article::where('status', 'enabled')->whereNotIn('id', [$hot_articles->id])->orderBy('updated_at', 'desc')->paginate($this->perPage);

        return view('livewire.article.article-list', [
            'hot_article' => $hot_articles,
            'articles' =>$articles
        ]);
    }
}
