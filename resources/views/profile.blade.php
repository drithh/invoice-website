<x-app-layout>
  <div class="flex h-screen place-content-center place-items-center">
    <form method="POST" action="{{ route('logout') }}">
      @csrf

      <x-nav-link :href="route('logout')" :active="request()->routeIs('logout')" onclick="event.preventDefault();this.closest('form').submit();">
        {{ __('Logout') }}
      </x-nav-link>
    </form>
  </div>

</x-app-layout>
