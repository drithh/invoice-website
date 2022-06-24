<div class="mb-8 px-8">
  {{-- header --}}
  <div class="mb-10 flex items-center justify-between rounded-xl bg-white py-8 pl-8 pr-16">
    <div class="left w-[11rem] text-sm">
      <div class="text-primary-textgray my-auto flex items-center justify-between rounded-lg bg-[#EFF1F9]">
        <div class="flex h-[35px] w-[50%] cursor-pointer flex-row items-center justify-center rounded-lg">
          <x-list-icon fill="#616679"></x-list-icon>
          <button class="ml-1 flex cursor-pointer items-center justify-center" onclick="getItemList()">List</button>
        </div>
        <div
          class="bg-primary-cyan flex h-[35px] w-[50%] cursor-pointer flex-row items-center justify-center rounded-lg text-white">
          <x-grid-icon fill="white"></x-grid-icon>
          <button class="ml-1 flex h-[35px] w-[50%] items-center justify-center" onclick="getItemGrid()">Grid</button>
        </div>


      </div>
    </div>
  </div>

  <div class="flex flex-row flex-wrap justify-between ">
    @foreach ($items as $item)
      <div class="card mb-8 flex flex-col items-center justify-between w-[240px] h-[15rem] bg-white m-3 p-5 rounded-lg shadow">
        <div class="flex-row flex w-[100%] justify-between ">
          <div class="flex justify-start w-[30%] h-[100%] ">
            <div class="{{ $loop->index % 3 == 0 ? 'bg-yellow-300' : ($loop->index % 3 == 1 ? 'bg-red-300' : 'bg-cyan-300') }} h-[50px] w-[50px] rounded-xl outline outline-gray-400 outline-3"></div>
          </div>
          <div class="w-[65%] h-[100%] ">
            <h3 class="inline-block text-primary-textdark text-xs font-bold align-middle">{{ $item->name }}</h3>
          </div>
        </div>
        <div class="flex flex-col w-[100%] ">
          <div class="w-[100%] h-[50%] flex flex-row justify-between items-center">
            <h3 class="inline-block text-primary-textdark text-xs font-semibold align-middle">Stok</h3>
            <span id="stock-number"  class="text-primary-textdark text-md font-semibold align-middle">{{ substr($item->remaining_stock, 0, 2).'%' }}</span>
          </div>
          <div class="w-[100%] h-[50%] flex flex-row justify-between items-center">
                        
            <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
              <div class="bg-{{ $item->remaining_stock < 33 ? 'red' : ($item->remaining_stock >33 && $item->remaining_stock <66 ? 'yellow' : 'green') }}-600 h-1.5 rounded-full dark:bg-gray-300" style="width: {{$item->remaining_stock}}%"></div>
            </div>

          </div>
        </div>
        <div class="flex flex-col w-[100%] ">
          <div class="w-[50%] h-[100%] ">
            <h3 class="inline-block text-primary-textdark text-xs font-semibold align-middle">Harga</h3>
          </div>
          <div class="{{ $loop->index % 3 == 0 ? 'text-primary-warmblue' : ($loop->index % 3 == 1 ? 'text-primary-orange' : 'text-primary-warmpink') }}">
            Rp{{ $item->retail_price }},00
          </div>
        </div>
      </div>
    @endforeach
  </div>
  <div class="rounded-xl bg-white py-8 pl-8 pr-16">
    {{ $items->links() }}
  </div>
</div>


{{-- <div class="px-[30px]">
      <div class="">
        <div class="mb-10 flex items-center justify-between rounded-lg bg-white py-[30px] pl-[40px] pr-[60px]">
          <div class="left w-[11rem] text-sm">
            <div class="text-primary-textgray my-auto flex items-center justify-between rounded-lg bg-[#EFF1F9]">
              <div class="flex flex-row h-[35px] w-[50%] items-center justify-center rounded-lg cursor-pointer ">
                <x-list-icon></x-list-icon>
                <button
                  class="flex cursor-pointer items-center justify-center ml-1 "
                  onclick="listView()">List</button>
              </div>
              <div class="flex flex-row h-[35px] w-[50%] items-center justify-center rounded-lg cursor-pointer 
              bg-primary-cyan text-white">
                <x-grid-icon></x-grid-icon>
                <button
                class="flex h-[35px] w-[50%] items-center justify-center ml-1"
                onclick="gridView()">Grid</button>
              </div>
            </div>
          </div>
        </div>
    
        {{ $items->links() }}
      </div> --}}