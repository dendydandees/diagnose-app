<section class="space-y-6">
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
                                    {{ __('Date') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Consultation Results') }}
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($history as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-900">
                                        {{ $loop->iteration }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-900">
                                        {{ $item->created_at->locale('id')->format('d F Y, H:i') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-900">
                                        @php
                                            $hasil = $item->result;
                                            if ($hasil != 0 && $hasil != '') {
                                                $p = App\Models\Disease::where('id',$hasil)->first();
                                                echo "{$p->name}";
                                            } else {
                                                echo "Tidak mengalami gangguan kecemasan";
                                            }
                                        @endphp
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right font-medium space-x-2">
                                    <a href="{{ route('consult_summary', ['id' => $item->id]) }}" class="btn-blue py-1 px-3 text-sm inline-block">Detail</a>
                                    @role('user')
                                        @if ($show)
                                            <button wire:click="showDeleteForm({{ $item->id }}, '{{ $loop->iteration }}')" class="btn-danger py-1 px-3 text-sm inline-block">
                                                {{ __('Delete') }}
                                            </button>
                                        @endif
                                    @endrole
                                </td>
                            </tr>
                            @empty
                            <div class="bg-white text-center p-6 mb-6 shadow-md rounded-lg">
                                <p class="text-lg font-semibold">
                                    {{ __("You haven't had a consultation") }}
                                </p>
                            </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $history->onEachSide(3)->links() }}

    {{-- Delete Confirmation --}}
    <x-jet-confirmation-modal wire:model="modalDelete">
        <x-slot name="title">
            <span class="font-bold">
                {{ __('Delete Consultation History') }}
            </span>
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete ') }} <b>{{ __("consultation number -") }}{{ $item_position }}</b> ? {{ __('After an consultation history is deleted, all its resources and data will be permanently deleted.') }}
        </x-slot>

        <x-slot name="footer">
            <button class="btn-secondary inline-block" wire:click="$toggle('modalDelete')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </button>
            <x-jet-danger-button
                class="ml-2"
                wire:click="deleteHistory({{ $history_id }})"
                wire:loading.attr="disabled"
            >
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</section>
