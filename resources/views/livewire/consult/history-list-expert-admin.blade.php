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
                                    {{ __('Name') }}
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
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            @php
                                                $user = App\Models\User::find($item->user_id);
                                            @endphp
                                            <img class="h-10 w-10 rounded-full" src="{{ $user->profile_photo_path ? Storage::url('profile-photos/'.$user->profile_photo_path) : $user->profile_photo_url }}" alt="{{ $user->name }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                            {{ $user->name }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                            {{ $user->email }}
                                            </div>
                                        </div>
                                    </div>
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
</section>
