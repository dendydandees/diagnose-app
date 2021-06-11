<?php

namespace App\Http\Livewire\Consult;

use App\Models\ConsultationHistory;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Route;

class HistoryListExpertAdmin extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';
    public $show, $modalDelete = false;
    public $count;

    public function mount()
    {
        $this->show = !Route::is('dashboard') ? true : false;
        Route::is('dashboard') ? $this->count = 5 : $this->count = 10;
    }

    public function render()
    {
        return view('livewire.consult.history-list-expert-admin', [
            'history' => ConsultationHistory::orderBy('created_at', 'desc')->paginate($this->count),
        ]);
    }
}
