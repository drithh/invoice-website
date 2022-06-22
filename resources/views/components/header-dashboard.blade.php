<div class="px-[30px] mb-8 mt-8 h-[50px]">
  <div class="flex justify-between items-center">
    <button class="w-[50px] h-[50px] bg-white flex justify-center items-center rounded-lg">
      <x-hamburger-dashboard></x-hamburger-dashboard>
    </button>
    <h2 class="text-lg font-semibold">Dashboard</h2>
    {{-- <div class="flex justify-between py-3 px-6 bg-white rounded-xl"> --}}
      <form action="">
        <input type="text" name="search" id="" placeholder="Search items" autocomplete="off" aria-label="Search Items" class="border-none px-3 py-2 font-md placeholder-primary-textdark text-primary-textdark rounded-2xl h-[50px] w-[925px] text-center placeholder-opacity-50">
      </form>
    {{-- </div> --}}

    <div class="w-[120px] h-[50px] rounded-lg bg-white flex justify-evenly flex-col text-right items-end pr-4">
      <h3 class="font-semibold text-xs">{{ $date['day']}}</h3>
      <p class="text-xs font-light font-poppins">{{ $date['date'] }}</p>
    </div>

    <button class="w-[50px] h-[50px] bg-white text-primary-cyan font-bold text-2xl rounded-lg ">+</button>
  </div>
</div>
