<?php

namespace App\Http\Livewire\Symptom;

use App\Models\Symptom;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class SymptomList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $modalDelete, $modalDetail, $modalEdit, $modalAdd = false;
    public $show, $count, $symptom_id, $name, $code, $list_code;

    protected $messages = [
        'required' => ':attribute tidak boleh kosong.'
    ];

    public function mount()
    {
        $this->show = !Route::is('dashboard') ? true : false;
        Route::is('dashboard') ? $this->count = 5 : $this->count = 10;
    }

    public function render()
    {
        return view('livewire.symptom.symptom-list', [
            'symptoms' => Symptom::orderBy('code', 'asc')->paginate($this->count),
        ]);
    }

    // reset the state
    public function resetFilters()
    {
        $this->reset(['symptom_id', 'name', 'code', 'list_code']);
    }

    // add data
    public function saveNewSymptom()
    {
        Validator::make(
            [
                'code' =>  $this->code,
                'name' => $this->name,
            ],
            [
                'code' => 'required|unique:symptoms',
                'name' => 'required',
            ],
            $this->messages
        )->validate();

        Symptom::create([
            'code' => $this->code,
            'name' => $this->name,
        ]);

        session()->flash('message', 'Gejala berhasil dibuat');

        return redirect()->to('/symptoms');
    }

    public function showAddSymptom()
    {
        $this->resetFilters();

        $get_count_symptom = Symptom::all()->count();
        $get_count_symptom += 1;
        $this->code = "S".substr("000{$get_count_symptom}", -3);

        $this->modalAdd = true;
    }

    // edit data
    public function saveEditSymptom($id)
    {
        Validator::make(
            [
                'code' =>  $this->code,
                'name' => $this->name,
            ],
            [
                'code' => 'required',
                'name' => 'required',
            ],
            $this->messages
        )->validate();

        $symptom = Symptom::findOrFail($id);
        // replace the symptom code
        if ($symptom->code != $this->code) {
            $old_code = $symptom->code;
            $new_code = $this->code;
            $same_symptom = Symptom::firstWhere('code', $new_code);

            $symptom->update([
                'code' => $new_code,
            ]);

            $same_symptom->update([
                'code' => $old_code,
            ]);
        }
        // update name symptom
        $symptom->update([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Gejala berhasil diperbarui');

        return redirect()->to('/symptoms');
    }

    public function showEditSymptom($id)
    {
        $this->resetFilters();

        $symptom = Symptom::findOrFail($id);

        $this->symptom_id = $id;
        $this->name = $symptom->name;
        $this->code = $symptom->code;

        $this->modalEdit = true;
    }

    // show data
    public function showDetailSymptom($id)
    {
        $this->resetFilters();

        $symptom = Symptom::findOrFail($id);

        $this->symptom_id = $id;
        $this->name = $symptom->name;
        $this->code = $symptom->code;

        $this->modalDetail = true;
    }

    // delete data
    public function deleteSymptom($id)
    {
        $symptom = Symptom::findOrFail($id);
        $symptom->delete();

        $all_symptom = Symptom::all();
        foreach($all_symptom as $key=>$item) {
            $key += 1;
            $item->update([
                'code' => "S".substr("000{$key}", -3)
            ]);
        }

        session()->flash('message', 'Gejala berhasil dihapus');

        return redirect()->to('/symptoms');
    }

    public function showDeleteSymptomsModal($id)
    {
        $this->resetFilters();

        $symptom = Symptom::findOrFail($id);

        $this->symptom_id = $id;
        $this->name = $symptom->name;
        $this->code = $symptom->code;

        $this->modalDelete = true;
    }
}
