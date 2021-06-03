<x-app-layout>
  <x-slot name="header">
    <h2 class="font-bold text-2xl text-white leading-tight tracking-wider">
      {{ __('Edit Disease') }}
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
      <form method="POST" action="{{ route('diseases.update', ['disease' => $disease->id]) }}" enctype="multipart/form-data" class="space-y-4">
        @method('PUT')
        @csrf

        <div class="block w-6/12">
          <label for="code" class="font-medium text-gray-700 text-sm block">
              {{ __('Code') }}
          </label>
          <select id="code" name="code" autocomplete="code" class="form-select mt-2 block w-6/12 rounded-md  border-gray-400 @error('code') border-red-400 @enderror shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-75 capitalize" required>
            <option disabled selected value="">{{ __('Select Code') }}</option>
            @foreach ($list_code as $item)
                <option value="{{ $item->code }}" {{ $disease->code === $item->code ? 'selected' : '' }}>
                  {{ $item->code }}
                </option>
            @endforeach
          </select>
          @error('code')
              <x-jet-input-error for="code" class="mt-2" />
          @enderror
        </div>

        <div class="block">
            <label for="name" class="font-medium text-gray-700 text-sm block">
                {{ __('Name') }}
            </label>
            <input id="name" name="name" type="text" value="{{ $disease->name }}" class="form-input mt-2 block w-full rounded-md border-gray-400 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-75">
            @error('name')
                <x-jet-input-error for="name" class="mt-2" />
            @enderror
        </div>

        <div class="block">
            <label for="type" class="font-medium text-gray-700 text-sm block">
                {{ __('Type') }}
            </label>
            @php
                $type_option = ['Jenis Gangguan Panik', 'Jenis Gangguan Kecemasan'];
            @endphp
            <select id="type" name="type" autocomplete="type" class="form-select mt-2 block w-6/12 rounded-md  border-gray-400 @error('type') border-red-400 @enderror shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-75 capitalize" required>
              <option value="" selected disabled>Pilih Jenis Gangguan</option>
              @foreach ($type_option as $item)
                <option value="{{ $item }}" {{ $disease->type == $item ? 'selected' : '' }}>{{ $item }}</option>
              @endforeach
            </select>
            @error('type')
                <x-jet-input-error for="type" class="mt-2" />
            @enderror
        </div>

        <div class="block">
          <label for="description" class="font-medium text-gray-700 text-sm block mb-2">
              {{ __('Description') }}
          </label>
          <textarea id="description" name="description" class="ckeditor form-textarea mt-2 block w-full rounded-md border-gray-400 @error('description') border-red-400 @enderror shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-75">
            {{ $disease->description }}
          </textarea>
          @error('description')
              <x-jet-input-error for="description" class="mt-2" />
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
