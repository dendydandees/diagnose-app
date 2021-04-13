<?php

namespace App\Http\Livewire\Expert;

use App\Models\Expert;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Livewire\Component;
use Livewire\WithFileUploads;

class ExpertList extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'tailwind';

    // state modal
    public $modalAdd, $modalEdit, $modalDetail, $modalDelete = false;
    // state session and add data button show
    public $show, $sessionShow = false;
    // state form and expert data
    public $expert_account = '';
    public $photoUpload;
    public $expert_id, $name, $email, $password, $password_confirmation, $position, $company, $photo, $photo_path;

    protected $rules = [
        'email' => 'required|email|max:64|unique:users',
        'name' => 'required|string|max:255',
        'position' => 'required|string',
        'company' => 'required',
        'password' => [
            'required',
            'string',
            'confirmed',
            'min:8',             // must be at least 8 characters in length
            'regex:/[a-z]/',      // must contain at least one lowercase letter
            'regex:/[A-Z]/',      // must contain at least one uppercase letter
            'regex:/[0-9]/',      // must contain at least one digit
        ],
    ];

    protected $messages = [
        'email.email' => 'Format Alamat Email tidak valid.',
        'password.confirmed' => 'Kata Sandi tidak cocok dengan Konfirmasi Kata Sandi.',
        'regex' => 'format :attribute tidak valid.',
        'string' => ':attribute harus berupa huruf.',
        'required' => ':attribute tidak boleh kosong.'
    ];

    // reset the state
    public function resetFilters()
    {
        $this->reset(['expert_id', 'expert_account', 'name', 'email', 'password', 'password_confirmation', 'position', 'company', 'photo', 'photo_path', 'photoUpload']);
    }

    public function mount()
    {
        $this->show = !Route::is('dashboard') ? true : false;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    // realtime validate photo upload
    public function updatedPhoto()
    {
        $this->validate([
            'photoUpload' => 'image|max:2048|mimes:png,jpg,jpeg', // 2MB Max
        ]);
    }

    // create expert
    public function saveNewExpert()
    {
        $this->validate();

        if ($this->photoUpload != null) {
            $this->photoUpload->storeAs(
                'public/profile-photos',
                now()."_".$this->photoUpload->getClientOriginalName()
            );
        }

        $user = User::create([
            'email' =>  $this->email,
            'name' => $this->name,
            'email_verified_at' => now(),
            'password' => Hash::make($this->password),
            'profile_photo_path' => $this->photoUpload !== null ? now()."_".$this->photoUpload->getClientOriginalName() : '',
        ]);
        $user->expert()->create([
            'position' => $this->position,
            'company' => $this->company,
        ]);
        $user->assignRole('expert');

        session()->flash('message', 'Akun Expert berhasil disimpan');

        return redirect()->to('/experts');
    }

    // edit expert
    public function saveEditExpert($id)
    {
        $user = User::findOrFail($id);

        if ($this->photoUpload != '') {
            // remove old file
            if ($user->profile_photo_path != '' && $user->profile_photo_path != null) {
                Storage::delete('public/profile-photos/'.$user->profile_photo_path);
            }

            // upload new file
            $this->photoUpload->storeAs(
                'public/profile-photos',
                now()."_".$this->photoUpload->getClientOriginalName()
            );
            // update user photo
            $user->update([
                'profile_photo_path' => $this->photoUpload !== null ? now()."_".$this->photoUpload->getClientOriginalName() : '',
            ]);
        }

        $user->update([
            'email' =>  $this->email,
            'name' => $this->name,
        ]);
        $user->expert()->update([
            'position' => $this->position,
            'company' => $this->company,
        ]);

        session()->flash('message', 'Akun Expert berhasil di edit');

        return redirect()->to('/experts');
    }

    // delete expert
    function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->removeRole('expert');
        if($user->profile_photo_path !== null)
        {
            Storage::delete('public/profile-photos/'.$user->profile_photo_path);
        }
        User::destroy($id);

        session()->flash('message', 'Akun Expert berhasil dihapus');

        return redirect()->to('/experts');
    }

    // show add modal form
    public function showAddExpert()
    {
        $this->resetFilters();

        $this->modalAdd = true;
    }

    // show edit modal
    public function showEditExpert($id)
    {
        $this->resetFilters();

        $this->expert_id = $id;
        $this->expert_account = User::findOrFail($id);
        $this->name = $this->expert_account->name;
        $this->email = $this->expert_account->email;
        $this->position = $this->expert_account->expert->position;
        $this->company = $this->expert_account->expert->company;
        $this->photo = $this->expert_account->profile_photo_url;
        $this->photo_path = $this->expert_account->profile_photo_path;
        $this->modalEdit = true;
    }

    // show detail modal
    public function showDetailExpert($id)
    {
        $this->resetFilters();

        $this->expert_account = User::findOrFail($id);
        $this->name = $this->expert_account->name;
        $this->email = $this->expert_account->email;
        $this->position = $this->expert_account->expert->position;
        $this->company = $this->expert_account->expert->company;
        $this->photo = $this->expert_account->profile_photo_url;
        $this->photo_path = $this->expert_account->profile_photo_path;
        $this->modalDetail = true;
    }

    // show delete modal confirmation
    public function showDeleteExpertModal($id)
    {
        $this->resetFilters();

        $this->expert_id = $id;
        $this->expert_account = User::findOrFail($id);
        $this->name = $this->expert_account->name;
        $this->modalDelete = true;
    }

    // render the components
    public function render()
    {
        return view('livewire.expert.expert-list', [
            'experts' => Expert::with('user')->orderBy('id', 'desc')->paginate(10),
        ]);
    }
}
