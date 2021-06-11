<?php

namespace App\Http\Livewire\Consult;

use App\Models\ConsultationHistory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Route;
use Livewire\WithPagination;

class HistoryList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $show, $modalDelete = false;
    public $history_id, $item_position;
    public $count;

    // reset the state
    public function resetFilters()
    {
        $this->reset(['history_id']);
    }

    public function mount()
    {
        $this->show = !Route::is('dashboard') ? true : false;
        Route::is('dashboard') ? $this->count = 5 : $this->count = 10;
    }

    public function render()
    {
        $user_id = Auth::user()->id;

        return view('livewire.consult.history-list', [
            'history' => ConsultationHistory::where("user_id", $user_id)->orderBy('created_at', 'desc')->paginate($this->count),
        ]);
    }

    public function showDeleteForm($id, $iteration)
    {
        $this->resetFilters();
        $this->history_id = $id;
        $this->item_position = $iteration;

        $this->modalDelete = true;
    }

    public function deleteHistory($id)
    {
        $history = Auth::user()->history->find($id);

        $history->delete();

        session()->flash('message', 'Riwayat Konsultasi berhasil dihapus');

        return redirect()->to('/consult_history');
    }
}
