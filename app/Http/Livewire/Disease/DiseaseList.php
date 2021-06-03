<?php

namespace App\Http\Livewire\Disease;

use App\Models\Disease;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class DiseaseList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $modalDelete, $modalDetail = false;
    public $show, $count, $disease_id, $name, $type, $code, $description;

    public function mount()
    {
        $this->show = !Route::is('dashboard') ? true : false;
        Route::is('dashboard') ? $this->count = 5 : $this->count = 10;
    }

    public function render()
    {
        return view('livewire.disease.disease-list', [
            'diseases' => Disease::orderBy('code', 'asc')->paginate($this->count),
        ]);
    }

    // reset the state
    public function resetFilters()
    {
        $this->reset(['disease_id', 'name', 'code', 'description']);
    }

    // show data
    public function showDetailForm($id)
    {
        $this->resetFilters();

        $disease = Disease::findOrFail($id);

        $this->disease_id = $id;
        $this->name = $disease->name;
        $this->type = $disease->type;
        $this->code = $disease->code;
        $this->description = $disease->description;

        $this->modalDetail = true;
    }

    // delete data
    public function deleteDisease($id)
    {
        $disease = Disease::findOrFail($id);
        $disease->delete();

        $all_disease = Disease::all();
        foreach($all_disease as $key=>$item) {
            $key += 1;
            $item->update([
                'code' => "D".substr("000{$key}", -3)
            ]);
        }

        session()->flash('message', 'Gangguan berhasil dihapus');

        return redirect()->to('/diseases');
    }

    public function showDeleteForm($id)
    {
        $this->resetFilters();

        $disease = Disease::findOrFail($id);

        $this->disease_id = $id;
        $this->name = $disease->name;
        $this->code = $disease->code;

        $this->modalDelete = true;
    }
}
