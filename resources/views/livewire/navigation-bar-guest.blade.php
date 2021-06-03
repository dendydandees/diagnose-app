<nav x-data="{ open: false }" class="bg-white shadow-sm">
    <div class="container sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
          <div class="relative flex items-center justify-between h-16">
            @if (Route::has('login'))
              <div class="absolute inset-y-0 right-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button @click="open = !open" type="button" class="inline-flex items-center justify-center p-2 rounded-md hover:text-white hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                  <span class="sr-only">Open main menu</span>
                    <!-- if hidden -->
                    <svg :class="{'hidden' : open, 'block' : !open}" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>

                    <!-- if open -->
                    <svg :class="{'block' : open, 'hidden' : !open}" class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
              </div>
            @endif

            <div class="flex-1 flex items-center justify-between sm:items-stretch">
              <div class="flex-shrink-0 flex items-center">
                  <a href="{{ route('welcome') }}" class="inline-block">
                      <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-purple-600.svg" alt="Diagnose Logo">
                  </a>
              </div>

              @if (Route::has('login'))
                <div class="hidden sm:block sm:ml-6">
                  <div class="flex space-x-4">
                    @auth
                      <a href="{{ route('dashboard') }}" class="{{ Route::is('dashboard') ? 'bg-purple-600 text-white' : '' }} px-3 py-2 rounded-md text-sm font-medium hover:bg-purple-700 hover:text-white">
                          {{ __('Dashboard') }}
                      </a>
                    @else
                      <a href="{{ route('login') }}" class="{{ Route::is('login') ? 'bg-purple-600 text-white' : '' }} px-3 py-2 rounded-md text-sm font-medium hover:bg-purple-700 hover:text-white">
                          {{ __('Sign In') }}
                      </a>
                      @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="{{ Route::is('register') ? 'bg-purple-600 text-white' : '' }} px-3 py-2 rounded-md text-sm font-medium hover:bg-purple-700 hover:text-white">
                          {{ __('Sign Up') }}
                        </a>
                      @endif
                    @endauth
                  </div>
                </div>
              @endif
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        @if (Route::has('login'))
          <div :class="{'block' : open, 'hidden' : !open}" class="transition-all duration-500 ease-in-out sm:hidden" id="mobile-menu">
            <div class="pt-2 pb-3 space-y-1">
              @auth
                <a href="{{ route('dashboard') }}" class="{{ Route::is('dashboard') ? 'bg-purple-600 text-white' : '' }} hover:bg-purple-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">{{ __('Dashboard') }}</a>
              @else
                <a href="{{ route('login') }}" class="{{ Route::is('login') ? 'bg-purple-600 text-white' : '' }} hover:bg-purple-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">{{ __('Sign In') }}</a>
                @if (Route::has('register'))
                  <a href="{{ route('register') }}" class="{{ Route::is('register') ? 'bg-purple-600 text-white' : '' }} hover:bg-purple-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">{{ __('Sign up') }}</a>
                @endif
              @endauth
            </div>
          </div>
        @endif
    </div>
</nav>
