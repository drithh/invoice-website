<div class="mb-8 mt-8 h-14 px-12">
  <div class="flex items-center justify-between">
    <div class="flex h-14 w-14 items-center justify-center rounded-lg bg-white">
      <x-hamburger-dashboard></x-hamburger-dashboard>
    </div>
    <h2 class="text-lg font-semibold">Dashboard</h2>
    {{-- <div class="flex justify-between py-3 px-6 bg-white rounded-xl"> --}}
    <form action="">
      <input type="text" name="search" id="" placeholder="Search items" autocomplete="off"
        aria-label="Search Items"
        class="font-md placeholder-primary-textdark text-primary-textdark h-14 w-[65vw] flex-shrink-[2] rounded-2xl border-none bg-slate-100 px-3 py-2 text-center placeholder-opacity-50 focus:ring-0">
    </form>
    {{-- </div> --}}

    <div class="flex h-14 w-32 flex-col items-center justify-evenly rounded-lg bg-white text-center">
      <h3 class="text-xs font-bold">{{ date('d') }}</h3>
      <p class="font-poppins text-xs font-light">{{ $date['date'] }}</p>
    </div>

    <button class="text-primary-cyan h-14 w-14 rounded-lg bg-white text-2xl font-bold">+</button>
  </div>
</div>
