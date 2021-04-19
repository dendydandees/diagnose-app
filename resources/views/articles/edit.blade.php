<x-app-layout>
  <x-slot name="header">
    <h2 class="font-bold text-2xl text-white leading-tight tracking-wider">
      {{ __('Edit Article') }}
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

    <div id="formContainer" class="hidden bg-white shadow-md rounded-lg p-4">
      <form method="POST" action="{{ route('articles.update', ['article' => $article->id]) }}" enctype="multipart/form-data" class="space-y-4">
        @method('PUT')
        @csrf

        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
          <div x-data="imageViewer('{{ $article->images !== '' ? Storage::url('articles/'.$article->images) : '' }}')">
            <label for="image" class="font-medium text-gray-700 text-sm block">
              {{ __('Upload Photo') }}
            </label>
            <!-- Show the image -->
            <template x-if="imageUrl">
              <img :src="imageUrl"
                  class="mt-2 w-full h-80 object-cover rounded-md border border-gray-200 cursor-pointer object-top"
                  x-on:click.prevent="$refs.photo.click()"
              >
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
              <div
                  class="mt-2 w-full h-80 object-cover rounded-md border border-gray-200 bg-gray-400 cursor-pointer"
                  x-on:click.prevent="$refs.photo.click()"
              ></div>
            </template>

            <input
              x-ref="photo"
              id="image"
              name="image"
              type="file"
              class="hidden"
              @change="fileChosen"
            >
            <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
              {{ __('Select A New Photo') }}
            </x-jet-secondary-button>
            <template x-if="imageUrl">
              <x-jet-secondary-button
                type="button"
                class="mt-2"
                x-on:click.prevent="
                  $refs.photo.value='';
                  imageUrl='';
                "
              >
                {{ __('Remove Photo') }}
              </x-jet-secondary-button>
            </template>
            @error('image')
                <x-jet-input-error for="image" class="mt-2" />
            @enderror
          </div>
        @endif

        <div class="block">
          <label for="title" class="font-medium text-gray-700 text-sm block">
              {{ __('Title') }}
          </label>
          <input id="title" name="title" autocomplete="title" type="text" class="form-input mt-2 block w-full rounded-md border-gray-400 @error('title') border-red-400 @enderror shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-75" autofocus value="{{ $article->title }}">
          @error('title')
              <x-jet-input-error for="title" class="mt-2" />
          @enderror
        </div>

        <div class="block">
          <label for="body" class="font-medium text-gray-700 text-sm block mb-2">
              {{ __('Content') }}
          </label>
          <textarea id="body" name="body" class="ckeditor form-textarea mt-2 block w-full rounded-md border-gray-400 @error('body') border-red-400 @enderror shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-75">
            {{ $article->body }}
          </textarea>
          @error('body')
              <x-jet-input-error for="body" class="mt-2" />
          @enderror
        </div>

        <div class="block">
          <label for="status" class="font-medium text-gray-700 text-sm block">
              {{ __('Status') }}
          </label>
          <select id="status" name="status" autocomplete="status" class="form-select mt-2 block w-6/12 rounded-md border-gray-400 @error('status') border-red-400 @enderror shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-75 capitalize" required>
            <option disabled selected value="">{{ __('Select Status') }}</option>
            @foreach ($select_status as $status)
              <option value="{{ $status }}" {{ strtolower($article->status) == strtolower($status) ? 'selected' : '' }}>
                {{ $status }}
              </option>
            @endforeach
          </select>
          @error('status')
              <x-jet-input-error for="status" class="mt-2" />
          @enderror
        </div>

        <div class="block">
          <label for="keywords" class="font-medium text-gray-700 text-sm block">
              {{ __('Keywords') }}
          </label>
          <input id="keywords" name="keywords" autocomplete="keywords" type="text" class="form-input mt-2 block w-6/12 rounded-md border-gray-400 @error('keywords') border-red-400 @enderror shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-75" value="{{ implode(",", $article->keywords) }}">
          <small class="leading-3 text-gray-700">
            <span class="text-red-500">*</span>
            {{ __('Separate a few keywords with a comma') }}
          </small>
          @error('keywords')
              <x-jet-input-error for="keywords" class="mt-2" />
          @enderror
        </div>

        <div class="block">
          <label for="writer" class="font-medium text-gray-700 text-sm block">
              {{ __('Writer') }}
          </label>
          <select id="writer" name="writer" autocomplete="writer" class="form-select mt-2 block w-6/12 rounded-md border-gray-400 @error('writer') border-red-400 @enderror shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-75" required>
            <option disabled selected value="">{{ __('Select Writer') }}</option>
            @forelse ($experts as $expert)
              <option value="{{ $expert->user->name }}" {{ strtolower($article->writer) == strtolower($expert->user->name) ? 'selected' : '' }}>
                {{ $expert->user->name }}
              </option>
            @empty
                <option disabled selected value="Diagnose">{{ __('Expert Not Found') }}</option>
            @endforelse
          </select>
          @error('writer')
              <x-jet-input-error for="writer" class="mt-2" />
          @enderror
        </div>

        <div class="flex flex-row justify-end">
          <button class="btn-primary inline-block mt-4" type="submit">
              {{ __('Save') }}
          </button>
        </div>
      </form>
    </div>
  </section>
</x-app-layout>

@sectionMissing('script')
  <script src="https://cdn.ckeditor.com/ckeditor5/27.0.0/classic/ckeditor.js"></script>
    <script>
      // alpine.js
      function imageViewer(url){
        return{
          imageUrl: url,

          fileChosen(event) {
            this.fileToDataUrl(event, src => this.imageUrl = src)
          },

          fileToDataUrl(event, callback) {
            if (! event.target.files.length) return

            let file = event.target.files[0],
                reader = new FileReader()

            reader.readAsDataURL(file)
            reader.onload = e => callback(e.target.result)
          },
        }
      }

      // ck editor
      window.addEventListener('DOMContentLoaded', (e) => {
        ClassicEditor
            .create( document.querySelector( '.ckeditor' ) )
            .catch( error => {
                console.error( error );
            } );

        const form = document.querySelector('#formContainer')
        form.classList.replace('hidden', 'block')
      })
    </script>
@endif
