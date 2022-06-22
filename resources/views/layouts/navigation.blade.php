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
        <x-nav-link :href="route('dashboard')" class="group relative left-0" :active="request()->routeIs('dashboard')">
          <x-dashboard-logo />
          <span
            class="border-primary-cyan absolute top-[-10px] right-[-11.5rem] flex h-10 w-36 origin-left scale-0 place-content-center place-items-center rounded-lg border-2 bg-white bg-opacity-60 text-base font-semibold transition-all group-hover:scale-100">Dashboard</span>
          <div
            class="{{ request()->routeIs('dashboard') ? 'active-route bg-primary-orange absolute top-[-10px] right-[-1.8rem] block h-12 w-[2px]' : '' }}">
          </div>
        </x-nav-link>
        <x-nav-link :href="route('invoice')" class="group relative left-0">
          <x-invoice-logo />
          <span
            class="border-primary-warmred absolute top-[-10px] right-[-11.5rem] flex h-10 w-36 origin-left scale-0 place-content-center place-items-center rounded-lg border-2 bg-white bg-opacity-60 text-base font-semibold transition-all group-hover:scale-100">Invoice</span>
          <div
            class="{{ request()->routeIs('invoice') ? 'active-route bg-primary-orange absolute top-[-10px] right-[-1.8rem] block h-12 w-[2px]' : '' }}">
          </div>
        </x-nav-link>
        <x-nav-link :href="route('product')" class="group relative left-0">
          <x-product-logo />
          <span
            class="border-primary-darkred absolute top-[-10px] right-[-11.5rem] flex h-10 w-36 origin-left scale-0 place-content-center place-items-center rounded-lg border-2 bg-white bg-opacity-60 text-base font-semibold transition-all group-hover:scale-100">Product</span>
          <div
            class="{{ request()->routeIs('product') ? 'active-route bg-primary-orange absolute top-[-10px] right-[-2rem] block h-12 w-[2px]' : '' }}">
          </div>
        </x-nav-link>
        <x-nav-link :href="route('report')" class="group relative left-0">
          <x-report-logo />
          <span
            class="border-primary-cyan absolute top-[-10px] right-[-11.5rem] flex h-10 w-36 origin-left scale-0 place-content-center place-items-center rounded-lg border-2 bg-white bg-opacity-60 text-base font-semibold transition-all group-hover:scale-100">Report</span>
          <div
            class="{{ request()->routeIs('report') ? 'active-route bg-primary-orange absolute top-[-18px] right-[-1.8rem] block h-12 w-[2px]' : '' }}">
          </div>
        </x-nav-link>
      </div>
    </div>

    <!-- Profile Links -->
    <x-nav-link :href="route('profile')" class="group relative left-0" :active="request()->routeIs('profile')">
      <x-profile-logo />
      <span
        class="border-primary-purple absolute top-[-10px] right-[-11.5rem] flex h-10 w-36 origin-left scale-0 place-content-center place-items-center rounded-lg border-2 bg-white bg-opacity-60 text-base font-semibold transition-all group-hover:scale-100">Report</span>
      <div
        class="{{ request()->routeIs('profile') ? 'active-route bg-primary-orange absolute top-[-12px] right-[-2rem] block h-12 w-[2px]' : '' }}">
      </div>
    </x-nav-link>
  </div>
</nav>
