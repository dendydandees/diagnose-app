<section class="space-y-6">
    @if($show)
        <div class="flex flex-row justify-end space-x-4">
            <a href="{{ route('articles.list') }}" class="btn-secondary py-1 px-3 text-sm flex flex-row items-center">
                <span class="ml-2">
                {{ __('See List Article') }}
                </span>
            </a>
            <a href="{{ route('articles.create') }}" class="btn-primary py-1 px-3 text-sm flex flex-row items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="ml-2">
                {{ __('Add Data') }}
                </span>
            </a>
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
                                    {{ __('Updated At') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Title') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Writer') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Status') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('View Count') }}
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($articles as $article)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-900">
                                            {{ $loop->iteration }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $article->updated_at->locale('id')->format('d F Y, H:i') }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 capitalize">
                                        <span class="text-sm text-gray-900 line-clamp-2 w-40" title="{{ ucwords($article->title )}}">
                                            {{ $article->title }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 capitalize">
                                        <span class="text-sm text-gray-900 line-clamp-1 w-20" title="{{ ucwords($article->writer )}}">
                                            {{ $article->writer }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-900">
                                            {{ $article->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-900">
                                            {{ $article->viewcount }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right font-medium space-x-2">
                                        <a href="{{ route('articles.slug', ['article' => $article->slug]) }}" class="btn-blue py-1 px-3 text-sm inline-block">
                                            Detail
                                        </a>
                                        @if($show)
                                            <a href="{{ route('articles.edit', ['article' => $article->id]) }}" class="btn-green py-1 px-3 text-sm inline-block">
                                                Edit
                                            </a>
                                            <button wire:click="showDeleteArticleModal({{ $article->id }})" class="btn-danger py-1 px-3 text-sm inline-block">
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
    {{ $articles->onEachSide(3)->links() }}

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

    {{-- Delete Confirmation --}}
    <x-jet-confirmation-modal wire:model="modalDelete">
        <x-slot name="title">
            <span class="font-bold">
                {{ __('Delete Article') }}
            </span>
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete ') }} <span class="font-bold capitalize">{{ $article_title }}</span> ? {{ __('After an article is deleted, all its resources and data will be permanently deleted.') }}
        </x-slot>

        <x-slot name="footer">
            <button class="btn-secondary inline-block" wire:click="$toggle('modalDelete')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </button>
            <x-jet-danger-button
                class="ml-2"
                wire:click="deleteArticle({{ $article_id }})"
                wire:loading.attr="disabled"
            >
                {{ __('Delete Article') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</section>
