<section class="space-y-6">
    @if($show)
        <div class="flex flex-row justify-end space-x-4">
            <button wire:click="$toggle('modalSymptomData')" class="btn-secondary py-1 px-3 text-sm flex flex-row items-center">
                {{ __('Lihat Gejala') }}
            </button>
            <button wire:click="$toggle('modalDiseaseData')" class="btn-secondary py-1 px-3 text-sm flex flex-row items-center">
                {{ __('Lihat Gangguan') }}
            </button>
        </div>
    @endif

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
                                    {{ __('Disease') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('S001') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('S002') }}
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-900">
                                        1.
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-900">
                                        (D001) Bukan Gangguan Kecemasan
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-900">
                                        Tidak
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-900">
                                        Tidak
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right font-medium space-x-2">
                                    @if($show)
                                        <a href="#" class="btn-green py-1 px-3 text-sm inline-block">
                                            Edit
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- {{ $diseases->onEachSide(3)->links() }} --}}

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

    {{-- Detail Symptom Data --}}
    <x-jet-dialog-modal wire:model="modalSymptomData">
        <x-slot name="title">
            <span class="font-bold">
                {{ __('Detail Symptom') }}
            </span>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-6">
                <div class="flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="align-middle inline-block min-w-full">
                            <div class="shadow-md overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Code') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Name') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse ($symptoms as $symptom)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $symptom->code }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <span class="text-sm text-gray-900">
                                                        {{ $symptom->name }}
                                                    </span>
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
                {{ $symptoms->onEachSide(3)->links() }}
            </div>
        </x-slot>

        <x-slot name="footer">
            <button class="btn-secondary inline-block" wire:click="$toggle('modalSymptomData')" wire:loading.attr="disabled">
                {{ __('Close') }}
            </button>
        </x-slot>
    </x-jet-dialog-modal>

    {{-- Detail Disease Data --}}
    <x-jet-dialog-modal wire:model="modalDiseaseData">
        <x-slot name="title">
            <span class="font-bold">
                {{ __('Detail Disease') }}
            </span>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-6">
                <div class="flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="align-middle inline-block min-w-full">
                            <div class="shadow-md overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Code') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Name') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse ($diseases as $disease)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $disease->code }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <span class="text-sm text-gray-900">
                                                        {{ $disease->name }}
                                                    </span>
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
                {{ $diseases->onEachSide(3)->links() }}
            </div>
        </x-slot>

        <x-slot name="footer">
            <button class="btn-secondary inline-block" wire:click="$toggle('modalSymptomData')" wire:loading.attr="disabled">
                {{ __('Close') }}
            </button>
        </x-slot>
    </x-jet-dialog-modal>
</section>
