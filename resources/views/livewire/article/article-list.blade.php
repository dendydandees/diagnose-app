<section class="space-y-6">
    @hasanyrole('admin|expert')
        <div class="flex flex-row">
            <a href="{{ route('articles.index') }}" class="link text-sm flex flex-row items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span class="ml-2">
                {{ __('Back') }}
                </span>
            </a>
        </div>
    @endhasanyrole

    <div class="bg-white shadow-md p-4 rounded-lg">
        <div class="grid gap-y-16">
            <a href="{{ route('articles.slug', ['article' => $hot_article->slug]) }}" class="group grid grid-cols-2 gap-x-6 rounded-md hover:bg-purple-100 transform hover:scale-105 hover:shadow-sm transition-all">
                <img
                    src="{{ $hot_article->images !== '' ? Storage::url('articles/'.$hot_article->images) : 'https://tailwindui.com/img/logos/workflow-mark-purple-600.svg' }}"
                    alt="{{ $hot_article->title }}"
                    class="w-full h-60 rounded-md self-center object-top {{ $hot_article->images !== '' ? 'object-cover' : 'object-contain' }} border border-gray-200"
                    style="filter: contrast(0.7)"
                >
                <div class="py-4">
                    @foreach ($hot_article->keywords as $keyword)
                        @if($loop->iteration <= 2)
                            <span class="px-2 py-2 mr-2 rounded-lg bg-purple-200 capitalize text-purple-700 font-semibold text-sm">
                                {{ $keyword }}
                            </span>
                        @endif
                    @endforeach
                    <h5 class="mt-4 mb-2 group-hover:text-purple-700 text-xl font-bold leading-normal tracking-wide line-clamp-2 capitalize">
                        {{ $hot_article->title }}
                    </h5>
                    <div class="text-base line-clamp-5">
                        {{ substr(preg_replace('/<[^<]+?>/', ' ', $hot_article->body), 0, 500) }}
                    </div>
                </div>
            </a>

            <div class="grid grid-cols-4 gap-x-4 gap-y-6">
                @forelse ($articles as $article)
                    <a href="{{ route('articles.slug', ['article' => $article->slug]) }}" class="group rounded-md hover:bg-purple-100 transform hover:scale-105 hover:shadow-sm transition-all">
                        <img
                            src="{{ $article->images !== '' ? Storage::url('articles/'.$article->images) : 'https://tailwindui.com/img/logos/workflow-mark-purple-600.svg' }}"
                            alt="{{ $article->title }}"
                            class="w-full h-40 rounded-md object-top {{ $article->images !== '' ? 'object-cover' : 'object-contain' }} border border-gray-200"
                            style="filter: contrast(0.7)"
                        >
                        <div class="p-2 mt-2">
                            @foreach ($article->keywords as $count)
                                @if($loop->iteration <= 1)
                                    <span class="px-2 py-2 mr-2 rounded-lg bg-purple-200 capitalize text-purple-700 font-semibold text-xs">
                                        {{ $keyword }}
                                    </span>
                                @endif
                            @endforeach
                            <h5 class="mt-4 mb-2 group-hover:text-purple-700 text-lg font-bold leading-normal tracking-wide line-clamp-2 capitalize">
                                {{ $article->title }}
                            </h5>
                            <div class="text-base line-clamp-3">
                                {{ substr(preg_replace('/<[^<]+?>/', ' ', $article->body), 0, 200) }}
                            </div>
                        </div>
                    </a>
                @empty
                @endforelse
            </div>
            @if ($articles->count() > 4)
                <button wire:click="loadMore()" wire:loading.attr="disabled" class="btn-primary mx-auto">{{ __('View more') }}</button>
            @endif
        </div>
    </div>
</section>
