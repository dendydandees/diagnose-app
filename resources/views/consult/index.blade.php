<x-without-sidenav>
  <x-slot name="header">
    <h2 class="font-bold text-2xl text-white leading-tight tracking-wider">
      {{ __('Anxiety Consultation') }}
    </h2>
  </x-slot>

  <section class="py-6 px-3 space-y-6 lg:px-6 md:w-10/12 lg:w-8/12 mx-auto">
    <a href="{{ route('dashboard') }}" class="link text-sm inline-flex flex-row items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span class="ml-2">
        {{ __('Back') }}
        </span>
    </a>

    <div class="bg-white shadow-md rounded-lg px-4 py-10">
      <div class="lg:w-8/12 text-center mx-auto space-y-12">
        <div class="space-y-8">
          <p class="md:w-3/4 mx-auto">
            Pikirkanlah selama 2 minggu terakhir, seberapa sering permasalahan berikut menggangu Anda ?
          </p>

          <div class="space-y-6">
            <p class="text-xl font-bold">
              Apakah Anda sering mengalami berkeringat dingin atau berkeringat yang berlebihan ?
            </p>
            <div class="space-x-4">
              <div class="inline-flex items-center">
                <input id="no" name="symptom" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-700">
                <label for="no" class="ml-2 block text-sm font-medium text-gray-700">
                  {{ __('No') }}
                </label>
              </div>
              <div class="inline-flex items-center">
                <input id="push_email" name="symptom" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-700">
                <label for="push_email" class="ml-2 block text-sm font-medium text-gray-700">
                  {{ __('Yes') }}
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="flex flex-row justify-center items-center">
          <button class="btn-secondary mx-4">
            Kembali
          </button>
          <button class="btn-primary mx-4">
            Selanjutnya
          </button>
        </div>
      </div>
    </div>
  </section>
</x-without-sidenav>
