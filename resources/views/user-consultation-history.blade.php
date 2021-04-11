<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white leading-tight tracking-wider">
            {{ __('User Consultation History') }}
        </h2>
    </x-slot>

    <section class="py-6 px-3 space-y-12 lg:px-6">
      <x-user-consultation-history-table :history="$history ?? ''"/>
    </section>
</x-app-layout>
