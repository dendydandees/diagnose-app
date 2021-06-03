<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white leading-tight tracking-wider">
            {{ __('User Consultation History') }}
        </h2>
    </x-slot>

    @role('user')
      <section class="py-6 px-3 space-y-12 lg:px-6">
          @livewire('consult.history-list')
      </section>
    @else
      <section class="py-6 px-3 space-y-12 lg:px-6">
          @livewire('consult.history-list-expert-admin')
      </section>
    @endrole

    <div x-data="{ showSession: true }" x-show.transition.in="showSession" x-init="setTimeout(() => showSession = false, 3000)" class="transition duration-150 ease-in-out">
      @if (session()->has('message'))
        <div class="text-sm fixed flex flex-row justify-between items-center px-4 py-2 right-6 bottom-6 text-white bg-red-600 border border-transparent rounded-md">
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
