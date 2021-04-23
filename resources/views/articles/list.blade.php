<x-app-layout>
  <x-slot name="header">
    <h2 class="font-bold text-2xl text-white leading-tight tracking-wider">
      {{ __('Mental Health Articles') }}
    </h2>
  </x-slot>

  <section class="py-6 px-3 space-y-6 lg:px-6">
    @if (App\Models\Article::count() !== 0)
      @livewire('article.article-list')
    @else
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
      <div class="bg-white shadow-md p-4 rounded-lg">
        <h6 class="font-semibold text-lg text-center">
          {{ __('Articles are being prepared by Diagnose, please come back later!') }}
        </h6>
      </div>
    @endif
  </section>
</x-app-layout>
