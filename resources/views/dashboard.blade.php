<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <section class="py-6 px-3 lg:px-6">
        <div class="bg-white overflow-hidden shadow-xl p-4 sm:rounded-lg">
            <div class="w-7/12 space-y-4">
                <h3 class="font-bold text-xl">
                    {{ __("Welcome") }}{{ __(",") }} {{ Auth::user()->name }}
                </h3>
                <p>
                    {{ __('Excessive anxiety, difficult to control, and interfering with daily activities are Anxiety Disorders. With Diagnose, you can make early detection of the anxiety you experience.') }}
                </p>
            </div>
            <a href="#" class="mt-6 btn-primary">
                {{ __('Anxiety Consultation') }}
            </a>
        </div>
    </section>
</x-app-layout>
