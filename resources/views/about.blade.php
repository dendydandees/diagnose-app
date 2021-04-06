<x-app-layout>
  <x-slot name="header">
      <h2 class="font-bold text-2xl text-white leading-tight">
          {{ __('About Diagnose') }}
      </h2>
  </x-slot>

  <section class="py-6 px-3 lg:px-6">
      <div class="bg-white overflow-hidden shadow-xl px-4 py-8 sm:rounded-lg">
          <div class="flex flex-col items-center">
            <img class="h-24 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-purple-600.svg" alt="Diagnose Logo">
            <p class="mt-8 text-center text-lg sm:max-w-lg md:text-xl">
              {{ __('Diagnose is an expert system for early detection of anxiety disorders.') }}
            </p>
            <span class="mt-12 text-center sm:text-lg">
              {{ __("Thank's for") }}
            </span>
            <div class="flex flex-row justify-center mt-6 space-x-6">
              <address class="not-italic text-center w-4/12">
                <p class="font-bold text-xl">
                  Politeknik Negeri Jakarta
                </p>
                <a href="https://www.pnj.ac.id/" target="_blank" rel="noopener noreferrer" class="mt-2 inline-flex">
                  <img src="https://www.pnj.ac.id/asset/images/pnj-small.jpg" alt="Personal Growth Logo" class="h-10 w-auto">
                </a>
                <p class="font-bold mt-3">
                  {{ __('Address') }} :
                </p>
                <a href="https://goo.gl/maps/bUJxaV3MCGvUTnLXA" target="_blank" rel="noopener noreferrer" class="mt-2 inline-flex hover:text-purple-700">
                  Jl. Prof. DR. G.A. Siwabessy, Kampus Universitas Indonesia, Depok 16425
                </a>
                <p class="font-bold mt-3">
                  {{ __('Telephone') }} :
                </p>
                <a href="tel:021-7270036" class="mt-2 inline-flex hover:text-purple-700">
                  021-7270036
                </a>
              </address>
              <address class="not-italic text-center w-4/12">
                <p class="font-bold text-xl">
                  Personal Growth
                </p>
                <a href="https://www.personalgrowth.co.id/" target="_blank" rel="noopener noreferrer" class="mt-2 inline-flex">
                  <img src="https://www.personalgrowth.co.id/assets/images/logo.png" alt="Personal Growth Logo" class="h-10 w-auto">
                </a>
                <p class="font-bold mt-3">
                  {{ __('Address') }} :
                </p>
                <a href="https://goo.gl/maps/TLEN1VrakgdU8tYG6" target="_blank" rel="noopener noreferrer" class="mt-2 inline-flex hover:text-purple-700">
                  Perkantoran Aries Niaga, Jalan Taman Aries Blok A1 No. 1B, Kembangan, Meruya Utara, Jakarta 11620
                </a>
                <p class="font-bold mt-3">
                  {{ __('Telephone') }} :
                </p>
                <a href="tel:+622158903862" class="mt-2 inline-flex hover:text-purple-700">
                  +62 21 5890 3862
                </a>
              </address>
            </div>
          </div>
      </div>
  </section>
</x-app-layout>
