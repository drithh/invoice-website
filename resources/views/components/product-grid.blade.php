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

  <div class="grid grid-cols-5 justify-between gap-x-6">
    @foreach ($items as $item)
      <div
        class="card mb-8 flex min-h-[18rem] w-full flex-col items-center justify-between rounded-xl bg-white p-8 shadow">
        <div class="flex w-[100%] flex-row justify-between">
          <div class="flex h-[100%] w-[30%] justify-start">
            <div
              class="{{ $loop->index % 3 == 0 ? 'bg-yellow-300' : ($loop->index % 3 == 1 ? 'bg-red-300' : 'bg-cyan-300') }} outline-3 h-[50px] w-[50px] rounded-xl outline outline-gray-400">
            </div>
          </div>
          <div class="h-[100%] w-[65%]">
            <h3 class="text-primary-textdark inline-block align-middle text-xs font-bold">{{ $item->name }}</h3>
          </div>
        </div>
        <div class="flex h-2/5 w-[100%] flex-col place-content-between">
          <div>
            <div class="flex h-[50%] w-[100%] flex-row items-center justify-between">
              <h3 class="text-primary-textdark inline-block align-middle text-xs font-semibold">Stok</h3>
              <span id="stock-number"
                class="text-primary-textdark text-md align-middle font-semibold">{{ substr($item->remaining_stock, 0, 2) . '%' }}</span>
            </div>
            <div class="flex h-[50%] w-[100%] flex-row items-center justify-between">

              <div class="h-1.5 w-full rounded-full bg-gray-200 dark:bg-gray-700">
                <div
                  class="{{ $item->remaining_stock < 33 ? 'bg-red-600' : ($item->remaining_stock > 33 && $item->remaining_stock < 66 ? 'bg-yellow-600' : 'bg-green-600') }} h-1.5 rounded-full dark:bg-gray-300"
                  style="width: {{ $item->remaining_stock }}%"></div>
              </div>
            </div>
          </div>
          <div class="flex w-[100%] flex-col">
            <div class="h-[100%] w-[50%]">
              <h3 class="text-primary-textdark inline-block align-middle text-xs font-semibold">Harga</h3>
            </div>
            <div
              class="{{ $loop->index % 3 == 0 ? 'text-primary-warmblue' : ($loop->index % 3 == 1 ? 'text-primary-orange' : 'text-primary-warmpink') }}">
              Rp{{ $item->retail_price }},00
            </div>
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
