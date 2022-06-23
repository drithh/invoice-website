<x-app-layout>


  <div id="data-table" class="mt-10 px-[18px]">
    <div class="px-[30px]">
      <div class="rounded-lg bg-white py-[30px] pl-[40px] pr-[60px]">
        {{-- header --}}
        <div class="mb-20 flex items-center justify-between">
          <div class="left w-[11rem] text-sm">
            <div class="text-primary-textgray my-auto flex items-center justify-between rounded-lg bg-[#EFF1F9]">
              <div class="flex flex-row h-[35px] w-[50%] items-center justify-center rounded-lg cursor-pointer 
              bg-primary-cyan text-white">
                <x-list-icon></x-list-icon>
                <button
                  class="flex cursor-pointer items-center justify-center ml-1 "
                  onclick="listView()">List</button>
              </div>
              <div class="flex flex-row h-[35px] w-[50%] items-center justify-center rounded-lg cursor-pointer ">
                <x-grid-icon></x-grid-icon>
                <button
                class="flex h-[35px] w-[50%] items-center justify-center ml-1"
                onclick="gridView()">Grid</button>
              </div>
            </div>
          </div>
        </div>
        <div class="mb-10 flex h-[50px] items-center  bg-slate-100 rounded-xl" >
          <div class='w-[31%] flex items-center align-middle justify-center '>
            <x-sort-icon></x-sort-icon>
            <div class="text-center ml-1">Product</div>
          </div>
          <div class='w-[16%] flex items-center align-middle justify-center '>
            <x-sort-icon></x-sort-icon>
            <div class="text-center ml-1">Stok</div>
          </div>
          <div class='w-[16%] flex items-center align-middle justify-center '>
            <x-sort-icon></x-sort-icon>
            <div class="text-center ml-1">Harga</div>
          </div>
          <div class='w-[16%] flex items-center align-middle justify-center '>
            <x-sort-icon></x-sort-icon>
            <div class="text-center ml-1">Penjualan</div>
          </div>
          <div class='w-[15%] flex items-center align-middle justify-center '>
            <x-sort-icon></x-sort-icon>
            <div class="text-center ml-1">Tag</div>
          </div>
        </div>

        @foreach ($items as $item)
          <div class="mb-8 flex h-[50px] items-center justify-between">
            {{-- <div class="form-check ">
              <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" value="" id="itemCheckBox">
            </div> --}}
            <div class="w-[20px] pl-4">
              <div class="{{ $loop->index % 3 == 0 ? 'bg-yellow-300' : ($loop->index % 3 == 1 ? 'bg-red-300' : 'bg-cyan-300') }} mr-[42px] h-[50px] w-[50px] rounded-xl outline outline-gray-400 outline-3"></div>
            </div>
            <div class="flex w-[300px] flex-col">
              <h3 class="text-primary-textdark mb-2 text-sm font-semibold">{{ $item->name }}</h3>
              <p class="text-primary-textgray text-xs font-light">{{ $item->supplier }}</p>
            </div>
            <div class="font-poppins text-primary-textgray w-[100px] text-xs font-light">{{ $item->stock }}
            </div>
            <div class="{{ $loop->index % 3 == 0 ? 'text-primary-warmblue' : ($loop->index % 3 == 1 ? 'text-primary-orange' : 'text-primary-warmpink') }} w-[150px] text-xs font-semibold">
              Rp{{ $item->retail_price }},00
            </div>
            <div class="font-poppins text-primary-textgray w-[70px] text-xs font-light">{{ $item->terbeli }}
            </div>
            <div class="{{ $loop->index % 3 == 0 ? 'bg-green-100' : ($loop->index % 3 == 1 ? 'bg-rose-100' : 'bg-orange-100') }} w-[100px] h-[35px] flex items-center justify-center text-xs font-semibold rounded-xl text-center">
              {{ $item->category }}
            </div>
            <button class="pr-6" onclick=()>
              <x-dots-icon></x-dots-icon>
            </button>
    
            {{-- <form action="{{ route('item.deleteRow') }}" method="post">
              @csrf
              <input type="hidden" name="id" id="id" value="{{ $item->id }}">
              <button type="submit" id="deleteRow">
                <x-delete-row></x-delete-row>
              </button>
            </form> --}}
          </div>
        @endforeach
    
        {{-- {{ $items->links() }} --}}
      </div>
    </div>
  </div>
</x-app-layout>
