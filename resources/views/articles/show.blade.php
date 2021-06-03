<x-app-layout>
  <x-slot name="header">
    <h2 class="font-bold text-2xl text-white leading-tight tracking-wider">
      {{ __('Mental Health Articles') }}
    </h2>
  </x-slot>

  <section class="py-6 px-3 space-y-6 lg:px-6">
    <div class="flex flex-row">
      <a href="{{ url()->previous() }}" class="link text-sm flex flex-row items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span class="ml-2">
        {{ __('Back') }}
        </span>
      </a>
    </div>

    <div class="bg-white overflow-hidden shadow-md px-4 py-12 rounded-lg space-y-8 text-gray-700">
      <div>
        @foreach ($article->keywords as $keyword)
          <span class="px-2 py-2 mr-2 rounded-lg bg-purple-200 capitalize text-purple-700 font-semibold text-sm">
            {{ $keyword }}
          </span>
        @endforeach
        <h3 class="text-2xl font-bold capitalize mt-4 mb-2">{{ $article->title }}</h3>
        <p class="text-sm font-semibold">
          {{ __('Updated At').' ' }}
          <span class="text-purple-700 capitalize">
            {{ $article->updated_at->locale('id')->format('d F Y') }}
          </span>
          {{ ' '.__('by').' ' }}
          <span class="text-purple-700 capitalize">
            {{ $article->writer }}
          </span>
        </p>
      </div>
      <img
        class="mt-2 w-full h-96 {{ $article->images !== '' ? 'object-cover' : 'object-contain' }} rounded-md border border-gray-200 object-top"
        src="{{ $article->images !== '' ? Storage::url('articles/'.$article->images) : 'https://tailwindui.com/img/logos/workflow-mark-purple-600.svg' }}"
        alt="{{ $article->title }}"
        style="filter: contrast(0.7)"
      >
      <div class="text-base">
        {!! $article->body !!}
      </div>
    </div>
  </section>
</x-app-layout>
