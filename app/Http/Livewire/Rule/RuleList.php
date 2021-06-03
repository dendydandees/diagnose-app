<?php

namespace App\Http\Livewire\Rule;

use App\Models\Disease;
use App\Models\Rule;
use App\Models\Symptom;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class RuleList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $modalSymptomData, $modalDiseaseData = false;
    public $show, $count;

    public function mount()
    {
        $this->show = !Route::is('dashboard') ? true : false;
        Route::is('dashboard') ? $this->count = 5 : $this->count = 10;
    }

    public function render()
    {
        return view('livewire.rule.rule-list', [
            'all_symptoms' => Symptom::orderBy('code', 'asc')->get(),
            'all_diseases' => Disease::orderBy('code', 'asc')->get(),
            'symptoms' => Symptom::orderBy('code', 'asc')->paginate($this->count),
            'diseases' => Disease::orderBy('code', 'asc')->paginate($this->count),
            'rules' => Rule::orderBy('id', 'asc')->paginate($this->count),
        ]);
    }
}
