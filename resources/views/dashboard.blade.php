<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white leading-tight tracking-wider">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <section class="py-10 px-3 lg:px-6 space-y-14">
        @hasanyrole('admin|expert')
            <div class="grid grid-cols-3 gap-x-4 text-center">
                <div class="bg-white shadow-md p-4 rounded-lg">
                    <div class="flex flex-col items-center py-4">
                        @role('expert')
                            <h4 class="text-lg font-semibold tracking-wider">
                                {{ __('Number of Consultations') }}
                            </h4>
                            <span class="text-2xl font-semibold mt-6">24</span>
                        @else
                            <h4 class="text-lg font-semibold tracking-wider">
                                {{ __('Number of Expert') }}
                            </h4>
                            <span class="text-2xl font-semibold mt-6">
                                {{ $experts_count }}
                            </span>
                        @endrole
                    </div>
                </div>
                <div class="bg-white shadow-md p-4 rounded-lg">
                    <div class="flex flex-col items-center py-4">
                        <h4 class="text-lg font-semibold tracking-wider">
                            {{ __('Number of Symptoms') }}
                        </h4>
                        <span class="text-2xl font-semibold mt-6">16</span>
                    </div>
                </div>
                <div class="bg-white shadow-md p-4 rounded-lg">
                    <div class="flex flex-col items-center py-4">
                        <h4 class="text-lg font-semibold tracking-wider">
                            {{ __('Number of Diseases') }}
                        </h4>
                        <span class="text-2xl font-semibold mt-6">8</span>
                    </div>
                </div>
            </div>

            @role('expert')
                <div>
                    <div class="flex flex-row justify-between items-center mb-6">
                        <h3 class="font-bold text-xl leading-tight tracking-wider">
                            {{ __('User Consultation History') }}
                        </h3>
                        <a href="{{ route('userConsultationHistory') }}" class="link">
                            {{ __('View more') }}
                        </a>
                    </div>

                    <x-user-consultation-history-table :history="$history ?? ''"/>
                </div>
            @else
                <div>
                    <div class="flex flex-row justify-between items-center mb-6">
                        <h3 class="font-bold text-xl leading-tight tracking-wider">
                            {{ __('Expert List') }}
                        </h3>
                        <a href="{{ route('experts.index') }}" class="link">
                            {{ __('View more') }}
                        </a>
                    </div>

                    @livewire('expert.expert-list')
                </div>
            @endrole
        @else
            <div class="bg-white overflow-hidden shadow-md p-4 rounded-lg">
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
        @endhasanyrole
    </section>
</x-app-layout>
