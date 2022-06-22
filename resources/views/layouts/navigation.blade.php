<nav x-data="{ open: false }" class="sticky left-0 top-0 h-screen w-20 bg-white">

  <div class="flex h-screen w-full flex-col place-content-between place-items-center pb-[5vh] pt-[4vh]">
    <div class="wrapper">
      <!-- Logo -->
      <div class="flex shrink-0 items-center">
        <a href="{{ route('dashboard') }}">
          <x-application-logo />
        </a>
      </div>

      <!-- Navigation Links -->
      <div class="mt-12 flex flex-col place-items-center gap-y-10">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
          <x-dashboard-logo />
        </x-nav-link>
        <x-nav-link :href="route('invoice')" :active="request()->routeIs('invoice')">
          <x-invoice-logo />
        </x-nav-link>
        <x-nav-link :href="route('product')" :active="request()->routeIs('product')">
          <x-product-logo />
        </x-nav-link>
        <x-nav-link :href="route('report')" :active="request()->routeIs('report')">
          <x-report-logo />
        </x-nav-link>
      </div>
    </div>

    <!-- Profile Links -->
    <x-nav-link :href="route('profile')" :active="request()->routeIs('profile')">
      <x-profile-logo />
    </x-nav-link>
  </div>
</nav>
