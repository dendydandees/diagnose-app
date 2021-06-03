<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white leading-tight tracking-wider">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <section class="py-10 px-3 lg:px-6 space-y-14">
        {{-- show on admin and expert --}}
        @hasanyrole('admin|expert')
            <div class="grid grid-cols-3 gap-x-4 text-center">
                <div class="bg-white shadow-md p-4 rounded-lg">
                    <div class="flex flex-col items-center py-4">
                        {{-- show on expert --}}
                        @role('expert')
                            <h4 class="text-lg font-semibold tracking-wider">
                                {{ __('Number of Consultations') }}
                            </h4>
                            <span class="text-2xl font-semibold mt-6">
                                {{ $consult_count }}
                            </span>
                        {{-- show on admin --}}
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

                {{-- show on admin and expert --}}
                <div class="bg-white shadow-md p-4 rounded-lg">
                    <div class="flex flex-col items-center py-4">
                        <h4 class="text-lg font-semibold tracking-wider">
                            {{ __('Number of Symptoms') }}
                        </h4>
                        <span class="text-2xl font-semibold mt-6">
                            {{ $symptoms_count }}
                        </span>
                    </div>
                </div>
                <div class="bg-white shadow-md p-4 rounded-lg">
                    <div class="flex flex-col items-center py-4">
                        <h4 class="text-lg font-semibold tracking-wider">
                            {{ __('Number of Diseases') }}
                        </h4>
                        <span class="text-2xl font-semibold mt-6">
                            {{ $diseases_count }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- show on expert --}}
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

                    @livewire('consult.history-list-expert-admin')
                </div>
            {{-- show on admin --}}
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

            {{-- show on admin and expert --}}
            <div>
                <div class="flex flex-row justify-between items-center mb-6">
                    <h3 class="font-bold text-xl leading-tight tracking-wider">
                        {{ __('Mental Health Articles') }}
                    </h3>
                    <a href="{{ route('articles.index') }}" class="link">
                        {{ __('View more') }}
                    </a>
                </div>

                @livewire('article.index')
            </div>
            <div>
                <div class="flex flex-row justify-between items-center mb-6">
                    <h3 class="font-bold text-xl leading-tight tracking-wider">
                        {{ __('Symptom Data') }}
                    </h3>
                    <a href="{{ route('symptoms.index') }}" class="link">
                        {{ __('View more') }}
                    </a>
                </div>

                @livewire('symptom.symptom-list')
            </div>
            <div>
                <div class="flex flex-row justify-between items-center mb-6">
                    <h3 class="font-bold text-xl leading-tight tracking-wider">
                        {{ __('Disease Data') }}
                    </h3>
                    <a href="{{ route('diseases.index') }}" class="link">
                        {{ __('View more') }}
                    </a>
                </div>

                @livewire('disease.disease-list')
            </div>
        {{-- show on user --}}
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
                <a href="{{ route('consult') }}" class="mt-6 btn-primary">
                    {{ __('Anxiety Consultation') }}
                </a>
            </div>

            <div>
                <div class="flex flex-row justify-between items-center mb-6">
                    <h3 class="font-bold text-xl leading-tight tracking-wider">
                        {{ __('Consultation History') }}
                    </h3>
                    <a href="{{ route('consult_history') }}" class="link">
                        {{ __('View more') }}
                    </a>
                </div>

                @livewire('consult.history-list')
            </div>
        @endhasanyrole
    </section>
</x-app-layout>
