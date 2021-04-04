<div class="col-span-3 bg-white px-3 py-8 shadow">
    <div class="flex flex-col space-y-4">
        <a href="{{ route('dashboard') }}" class="{{ Route::is('dashboard') ? 'side-nav-link-active' : 'side-nav-link' }}">
            {{ __('Dashboard') }}
        </a>
        <a href="#" class="{{ Route::is('welcome') ? 'side-nav-link-active' : 'side-nav-link' }}">
            {{ __('Consultation History') }}
        </a>
        <a href="#" class="{{ Route::is('welcome') ? 'side-nav-link-active' : 'side-nav-link' }}">
            {{ __('Mental Health Articles') }}
        </a>

        <hr class="border-gray-300">

        <a href="{{ route('profile.show') }}" class="{{ Route::is('profile.show') ? 'side-nav-link-active' : 'side-nav-link' }}">
            {{ __('My Profile') }}
        </a>
        <a href="#" class="{{ Route::is('welcome') ? 'side-nav-link-active' : 'side-nav-link' }}">
            {{ __('About Diagnose') }}
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" class="{{ Route::is('logout') ? 'side-nav-link-active' : 'side-nav-link' }} block" onclick="event.preventDefault();this.closest('form').submit();">
                {{ __('Logout') }}
            </a>
        </form>
    </div>
</div>
