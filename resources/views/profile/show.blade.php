<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white leading-tight tracking-wider">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <section x-data="{ photoPreview: false }">
        <div x-show.transition.in="!photoPreview" class="py-10 px-3 lg:px-6 space-y-12">
            <div class="bg-white shadow-md p-4 rounded-lg w-8/12 mx-auto space-y-6 text-center">
                <div class="flex justify-end">
                    <button @click="photoPreview = ! photoPreview" class="link text-purple-900" title="{{ __('Edit Profile') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </button>
                </div>

                <!-- Current Profile Photo -->
                <div>
                    <img src="{{ Auth::user()->profile_photo_path ? Storage::url('profile-photos/'.Auth::user()->profile_photo_path) : Auth::user()->profile_photo_url}}" alt="{{ auth()->user()->name }}" class="rounded-full h-20 w-20 object-cover mx-auto">
                    <span class="block mt-6 font-semibold text-xl capitalize">
                        {{ auth()->user()->name }}
                    </span>
                </div>

                <div class="space-y-2">
                    <span class="block font-semibold text-base text-gray-500">
                        {{ auth()->user()->email }}
                    </span>
                    @role('expert')
                        @isset(auth()->user()->expert)
                            <span class="block font-semibold text-base text-gray-500">
                                {{ auth()->user()->expert->position }}
                            </span>
                            <span class="block font-semibold text-base text-gray-500">
                                {{ auth()->user()->expert->company }}
                            </span>
                        @endisset
                    @else
                        @isset(auth()->user()->userProfile)
                            <span class="block font-semibold text-base text-gray-500">
                                {{ auth()->user()->userProfile->gender == "male" ? 'Laki - Laki' : 'Perempuan' }}
                            </span>
                            <span class="block font-semibold text-base text-gray-500">
                                {{ auth()->user()->userProfile->age }} {{ __('Years old') }}
                            </span>
                        @endisset
                    @endrole
                </div>
            </div>
        </div>

        <div x-show.transition.in="photoPreview">
            <div class="max-w-7xl mx-auto py-10 px-3 lg:px-6">
                <button @click="photoPreview = ! photoPreview" class="link mb-8 inline-flex items-center" title="{{ __('Back to my profile') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span class="ml-2">
                        {{ __('Back to my profile') }}
                    </span>
                </button>

                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                    @livewire('profile.update-profile-information-form')

                    <x-jet-section-border />
                @endif

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    <div class="mt-10 sm:mt-0">
                        @livewire('profile.update-password-form')
                    </div>

                    <x-jet-section-border />
                @endif

                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    <div class="mt-10 sm:mt-0">
                        @livewire('profile.two-factor-authentication-form')
                    </div>

                    <x-jet-section-border />
                @endif

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.logout-other-browser-sessions-form')
                </div>

                @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                    <x-jet-section-border />

                    <div class="mt-10 sm:mt-0">
                        @livewire('profile.delete-user-form')
                    </div>
                @endif
            </div>
        </div>

    </section>

    <div x-data="{ showSession: true }" x-show.transition.in="showSession" x-init="setTimeout(() => showSession = false, 3000)" class="transition duration-150 ease-in-out">
      @if (session()->has('message'))
        <div class="text-sm fixed flex flex-row justify-between items-center px-4 py-2 right-6 bottom-6 text-white bg-green-600 border border-transparent rounded-md">
          <span class="font-medium mr-4">
              {{ session('message') }}
          </span>
          <button @click="showSession = !showSession">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      @endif
    </div>
</x-app-layout>
