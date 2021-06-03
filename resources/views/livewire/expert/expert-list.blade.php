<section class="space-y-6">
    @if($show)
        <div class="flex flex-row justify-end">
            <button wire:click="showAddExpert" class="btn-primary py-1 px-3 text-sm flex flex-row items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="ml-2">
                {{ __('Add Data') }}
                </span>
            </button>
        </div>
    @endif

    <div
        wire:model="sessionShow"
        x-data="{}"
        x-init="setTimeout(() => { $wire.set('sessionShow', false) }, 3000);"
        class="transition duration-150 ease-in-out"
    >
        @if (session()->has('message'))
            <div class="text-sm fixed flex flex-row justify-between items-center px-4 py-2 right-6 bottom-6 text-white bg-green-600 border border-transparent rounded-md">
                <span class="font-medium mr-4">
                    {{ session('message') }}
                </span>
                <button wire:click="$set('sessionShow', false)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif
    </div>

    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="align-middle inline-block min-w-full">
                <div class="shadow-md overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No.
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Name') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Position') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Hospital Name') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Status') }}
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 capitalize">
                            @forelse ($experts as $expert)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-900">
                                            {{ $loop->iteration }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img
                                                    class="h-10 w-10 rounded-full object-cover"
                                                    src="{{
                                                        $expert->user->profile_photo_path != null
                                                        ?
                                                        Storage::url('profile-photos/'.$expert->user->profile_photo_path)
                                                        :
                                                        $expert->user->profile_photo_url }}
                                                    "
                                                    alt="{{ $expert->user->name }}">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $expert->user->name }}
                                                </div>
                                                <div class="text-sm text-gray-500 lowercase">
                                                    {{ $expert->user->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-900">
                                            {{ $expert->position }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-900">
                                            {{ $expert->company }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-900">
                                            {{
                                                $expert->user->email_verified_at != null
                                                ? $expert->user->email_verified_at->locale('id')->format('d F Y, H:i')
                                                : __('Not Verified')
                                            }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right font-medium space-x-2">
                                        <button wire:click="showDetailExpert({{ $expert->user_id }})" class="btn-blue py-1 px-3 text-sm inline-block">
                                            Detail
                                        </button>
                                        @if($show)
                                            <button wire:click="showEditExpert({{ $expert->user_id }})" class="btn-green py-1 px-3 text-sm inline-block">
                                                Edit
                                            </button>
                                            <button wire:click="showDeleteExpertModal({{ $expert->user->id }})" class="btn-danger py-1 px-3 text-sm inline-block">
                                                {{ __('Delete') }}
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <div class="bg-white text-center p-6 mb-6 shadow-md rounded-lg">
                                    <p class="text-lg font-semibold">
                                        {{ __('Data not found, please add data!') }}
                                    </p>
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $experts->onEachSide(3)->links() }}

    <div>
        {{-- Add Modal --}}
        <x-jet-dialog-modal wire:model="modalAdd">
            <x-slot name="title">
                <span class="font-bold">
                    {{ __('Add Expert Account') }}
                </span>
            </x-slot>

            <x-slot name="content">
                <form wire:submit.prevent="saveNewExpert" class="flex flex-col w-6/12 space-y-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div
                            x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                        >
                            <label for="photoUpload" class="font-medium text-gray-700 text-sm block">
                                {{ __('Upload Photo') }}
                            </label>

                            @if ($photoUpload)
                                <img class="mt-2 rounded-full h-20 w-20 object-cover" src="{{ $photoUpload->temporaryUrl() }}">
                            @else
                                <img class="mt-2 rounded-full h-20 w-20 object-cover" src="https://ui-avatars.com/api/?name=Photo Profile&color=7F9CF5&background=EBF4FF">
                            @endif

                            <!-- File Input -->
                            <input x-ref="photo" id="photoUpload" type="file" class="hidden" wire:model="photoUpload">

                            <!-- Progress Bar -->
                            <div x-show="isUploading">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>

                            <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                                {{ __('Select A New Photo') }}
                            </x-jet-secondary-button>

                            @if ($photoUpload)
                                <x-jet-secondary-button type="button" class="mt-2" wire:click="$set('photoUpload', '')">
                                    {{ __('Remove Photo') }}
                                </x-jet-secondary-button>
                            @endif

                            @error('photoUpload')
                                <x-jet-input-error for="photoUpload" class="mt-2" />
                            @enderror
                        </div>
                    @endif

                    <div class="block">
                        <label for="email" class="font-medium text-gray-700 text-sm block">
                            {{ __('Email') }}
                        </label>
                        <input id="email" wire:model.defer="email" type="email" class="form-input mt-2 block w-full rounded-md border-gray-400 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-75" autofocus>
                        @error('email')
                            <x-jet-input-error for="email" class="mt-2" />
                        @enderror
                    </div>

                    <div class="block">
                        <label for="name" class="font-medium text-gray-700 text-sm block">
                            {{ __('Fullname') }}
                        </label>
                        <input id="name" wire:model.defer="name" type="text" class="form-input mt-2 block w-full rounded-md border-gray-400 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-75">
                        @error('name')
                            <x-jet-input-error for="name" class="mt-2" />
                        @enderror
                    </div>

                    <div class="block">
                        <label for="password" class="font-medium text-gray-700 text-sm block">
                            {{ __('Password') }}
                        </label>
                        <input id="password" wire:model.defer="password" type="password" autocomplete="new-password" class="form-input mt-2 block w-full rounded-md border-gray-400 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-75">
                        <small class="leading-3 text-gray-700">
                            <span class="text-red-500">*</span>
                            {{ __('Password must be at least 8 characters long and contain lowercase, uppercase, and numbers') }}
                        </small>
                        @error('password')
                            <x-jet-input-error for="password" class="mt-2" />
                        @enderror
                    </div>

                    <div class="block">
                        <label for="password_confirmation" class="font-medium text-gray-700 text-sm block">
                            {{ __('Password Confirmation') }}
                        </label>
                        <input id="password_confirmation" wire:model.defer="password_confirmation" type="password" autocomplete="new-password" class="form-input mt-2 block w-full rounded-md border-gray-400 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-75">
                        <small class="leading-3 text-gray-700">
                            <span class="text-red-500">*</span>
                            {{ __('Password must be at least 8 characters long and contain lowercase, uppercase, and numbers') }}
                        </small>
                        @error('password')
                            <x-jet-input-error for="password" class="mt-2" />
                        @enderror
                    </div>

                    <div class="block">
                        <label for="position" class="font-medium text-gray-700 text-sm block">
                            {{ __('Position') }}
                        </label>
                        <input id="position" wire:model.defer="position" type="text" class="form-input mt-2 block w-full rounded-md border-gray-400 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-75">
                        @error('position')
                            <x-jet-input-error for="position" class="mt-2" />
                        @enderror
                    </div>

                    <div class="block">
                        <label for="company" class="font-medium text-gray-700 text-sm block">
                            {{ __('Company') }}
                        </label>
                        <input id="company" wire:model.defer="company" type="text" class="form-input mt-2 block w-full rounded-md border-gray-400 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-75">
                        @error('company')
                            <x-jet-input-error for="company" class="mt-2" />
                        @enderror
                    </div>

                    <button class="hidden" type="submit" x-ref="submitAddForm">
                        {{ __('Save') }}
                    </button>
                </form>
            </x-slot>

            <x-slot name="footer">
                <button class="btn-secondary inline-block" wire:click="$toggle('modalAdd')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </button>
                <button class="ml-2 btn-primary inline-block" x-on:click="$refs.submitAddForm.click()" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </button>
            </x-slot>
        </x-jet-dialog-modal>

        {{-- Edit Modal --}}
        <x-jet-dialog-modal wire:model="modalEdit">
            <x-slot name="title">
                <span class="font-bold">
                    {{ __('Add Expert Account') }}
                </span>
            </x-slot>

            <x-slot name="content">
                <form wire:submit.prevent="saveEditExpert({{ $expert_id }})" class="flex flex-col w-6/12 space-y-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div
                            x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                        >
                            <label for="photoUploadEdit" class="font-medium text-gray-700 text-sm block">
                                {{ __('Upload Photo') }}
                            </label>

                            @if ($photoUpload)
                                <img class="mt-2 rounded-full h-20 w-20 object-cover" src="{{ $photoUpload->temporaryUrl() }}">
                            @else
                                <img class="mt-2 rounded-full h-20 w-20 object-cover" src="{{ $photo_path ? Storage::url('profile-photos/'. $photo_path) : 'https://ui-avatars.com/api/?name='.$name.'&color=7F9CF5&background=EBF4FF' }}">
                            @endif

                            <!-- File Input -->
                            <input x-ref="photo" id="photoUploadEdit" type="file" class="hidden" wire:model="photoUpload">

                            <!-- Progress Bar -->
                            <div x-show="isUploading">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>

                            <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                                {{ __('Select A New Photo') }}
                            </x-jet-secondary-button>

                            @if ($photoUpload)
                                <x-jet-secondary-button type="button" class="mt-2" wire:click="$set('photoUpload', '')">
                                    {{ __('Remove Photo') }}
                                </x-jet-secondary-button>
                            @endif

                            @error('photoUpload')
                                <x-jet-input-error for="photoUpload" class="mt-2" />
                            @enderror
                        </div>
                    @endif

                    <div class="block">
                        <label for="emailEdit" class="font-medium text-gray-700 text-sm block">
                            {{ __('Email') }}
                        </label>
                        <input id="emailEdit" wire:model.defer="email" type="email" class="form-input mt-2 block w-full rounded-md border-gray-400 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-75" autofocus>
                        @error('email')
                            <x-jet-input-error for="email" class="mt-2" />
                        @enderror
                    </div>

                    <div class="block">
                        <label for="nameEdit" class="font-medium text-gray-700 text-sm block">
                            {{ __('Fullname') }}
                        </label>
                        <input id="nameEdit" wire:model.defer="name" type="text" class="form-input mt-2 block w-full rounded-md border-gray-400 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-75">
                        @error('name')
                            <x-jet-input-error for="name" class="mt-2" />
                        @enderror
                    </div>

                    <div class="block">
                        <label for="verif_value" class="font-medium text-gray-700 text-sm block">
                            {{ __('Status') }}
                        </label>
                        <div class="mt-4 space-y-4">
                            @php
                                $verified_item = collect([true, false]);
                            @endphp
                            @foreach ($verified_item as $item)
                                <div class="flex items-center">
                                    <input
                                        wire:model.defer="verif_value"
                                        id="verifEdit{{ $item == true ? 'True' : 'False' }}"
                                        name="verif_value"
                                        type="radio"
                                        value="{{ $item == true ? 1 : 0 }}"
                                        class="form-radio focus:ring-purple-500 h-4 w-4 text-purple-600 border-gray-300"
                                        {{ $verif_value == $item ? 'checked' : '' }}
                                    >
                                    <label for="verifEdit{{ $item == true ? 'True' : 'False' }}" class="ml-3 block text-sm font-medium text-gray-700">
                                        {{ $item == true ? __('Verified') : __('Not Verified') }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('verif_value')
                            <x-jet-input-error for="verif_value" class="mt-2" />
                        @enderror
                    </div>

                    <div class="block">
                        <label for="positionEdit" class="font-medium text-gray-700 text-sm block">
                            {{ __('Position') }}
                        </label>
                        <input id="positionEdit" wire:model.defer="position" type="text" class="form-input mt-2 block w-full rounded-md border-gray-400 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-75">
                        @error('position')
                            <x-jet-input-error for="position" class="mt-2" />
                        @enderror
                    </div>

                    <div class="block">
                        <label for="companyEdit" class="font-medium text-gray-700 text-sm block">
                            {{ __('Company') }}
                        </label>
                        <input id="companyEdit" wire:model.defer="company" type="text" class="form-input mt-2 block w-full rounded-md border-gray-400 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-75">
                        @error('company')
                            <x-jet-input-error for="company" class="mt-2" />
                        @enderror
                    </div>

                    <button class="hidden" type="submit" x-ref="submitEditForm">
                        {{ __('Save') }}
                    </button>
                </form>
            </x-slot>

            <x-slot name="footer">
                <button class="btn-secondary inline-block" wire:click="$toggle('modalEdit')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </button>
                <button class="ml-2 btn-primary inline-block" x-on:click="$refs.submitEditForm.click()" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </button>
            </x-slot>
        </x-jet-dialog-modal>

        {{-- Detail Modal --}}
        <x-jet-dialog-modal wire:model="modalDetail">
            <x-slot name="title">
                <span class="font-bold">
                    {{ __('Detail Expert Account') }}
                </span>
            </x-slot>

            <x-slot name="content">
                <div class="space-y-4 capitalize">
                    <img
                        src="{{ $photo_path ? Storage::url('profile-photos/'. $photo_path) : sprintf('https://ui-avatars.com/api/?name=%s&color=7F9CF5&background=EBF4FF', $name) }}"
                        alt="{{ $name }}"
                        class="rounded-full h-20 w-20 object-cover"
                    >
                    <div class="space-y-2 capitalize">
                        <p class="font-bold">{{ __('Name') }}</p>
                        <p>{{ $name }}</p>
                    </div>
                    <div class="space-y-2 capitalize">
                        <p class="font-bold">{{ __('Email') }}</p>
                        <p class="lowercase">{{ $email }}</p>
                    </div>
                    <div class="space-y-2 capitalize">
                        <p class="font-bold">{{ __('Status') }}</p>
                        <p>
                            {{
                                $verified != null
                                ? $verified->locale('id')->format('d F Y, H:i')
                                : __('Not Verified')
                            }}
                        </p>
                    </div>
                    <div class="space-y-2 capitalize">
                        <p class="font-bold">{{ __('Position') }}</p>
                        <p>{{ $position }}</p>
                    </div>
                    <div class="space-y-2 capitalize">
                        <p class="font-bold">{{ __('Company') }}</p>
                        <p>{{ $company }}</p>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn-secondary inline-block" wire:click="$toggle('modalDetail')" wire:loading.attr="disabled">
                    {{ __('Close') }}
                </button>
            </x-slot>
        </x-jet-dialog-modal>

        {{-- Delete Modal --}}
        <x-jet-confirmation-modal wire:model="modalDelete">
            <x-slot name="title">
                <span class="font-bold">
                    {{ __('Delete Expert Account') }}
                </span>
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete ') }} <span class="font-bold">{{ $name }}</span> ? {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
            </x-slot>

            <x-slot name="footer">
                <button class="btn-secondary inline-block" wire:click="$toggle('modalDelete')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </button>
                <x-jet-danger-button
                    class="ml-2"
                    wire:click="deleteUser({{ $expert_id }})"
                    wire:loading.attr="disabled"
                >
                    {{ __('Delete Account') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-confirmation-modal>
    </div>
</section>
