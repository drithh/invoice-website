<div class="mb-8 px-8">
  <div class="mb-8 rounded-lg bg-white pt-8 pb-16 pl-10 pr-16">
    {{-- header --}}
    <div class="mb-16 flex items-center justify-between">
      <div class="left w-[11rem] text-sm">
        <div class="text-primary-textgray my-auto flex items-center justify-between rounded-lg bg-[#EFF1F9]">
          <div
            class="bg-primary-cyan flex h-[35px] w-[50%] cursor-pointer flex-row items-center justify-center rounded-lg text-white">
            <x-list-icon fill="white"></x-list-icon>
            <button class="ml-1 flex cursor-pointer items-center justify-center" onclick="getItemList()">List</button>
          </div>
          <div class="flex h-[35px] w-[50%] cursor-pointer flex-row items-center justify-center rounded-lg">
            <x-grid-icon fill="#616679"></x-grid-icon>
            <button class="ml-1 flex h-[35px] w-[50%] items-center justify-center" onclick="getItemGrid()">Grid</button>
          </div>
        </div>
      </div>
    </div>
    <div class="mb-16 flex h-[50px] items-center rounded-xl bg-slate-50">
      <div class='flex w-[31%] items-center justify-center align-middle'>
        <x-sort></x-sort>
        <div class="ml-1 text-center">Product</div>
      </div>
      <div class='flex w-[16%] items-center justify-center align-middle'>
        <x-sort></x-sort>
        <div class="ml-1 text-center">Stok</div>
      </div>
      <div class='flex w-[16%] items-center justify-center align-middle'>
        <x-sort></x-sort>
        <div class="ml-1 text-center">Harga</div>
      </div>
      <div class='flex w-[16%] items-center justify-center align-middle'>
        <x-sort></x-sort>
        <div class="ml-1 text-center">Penjualan</div>
      </div>
      <div class='flex w-[15%] items-center justify-center align-middle'>
        <x-sort></x-sort>
        <div class="ml-1 text-center">Tag</div>
      </div>
    </div>

    @foreach ($items as $item)
      <div class="mb-16 flex h-[50px] items-center justify-between">
        <div class="hidden" id="item_id">
          {{ $item->id }}
        </div>
        <div class="w-[20px] pl-4">
          <div
            class="{{ $loop->index % 3 == 0 ? 'bg-yellow-300' : ($loop->index % 3 == 1 ? 'bg-red-300' : 'bg-cyan-300') }} outline-3 mr-[42px] h-[50px] w-[50px] rounded-xl outline outline-gray-400">
          </div>
        </div>
        <div class="flex w-[300px] flex-col">
          <h3 class="text-primary-textdark mb-2 text-sm font-semibold">{{ $item->name }}</h3>
        </div>
        <div class="font-poppins text-primary-textgray w-[100px] text-xs font-light">{{ $item->stock }}
        </div>
        <div
          class="{{ $loop->index % 3 == 0 ? 'text-primary-warmblue' : ($loop->index % 3 == 1 ? 'text-primary-orange' : 'text-primary-warmpink') }} w-[150px] text-xs font-semibold">
          Rp{{ $item->retail_price }},00
        </div>
        <div class="font-poppins text-primary-textgray w-[70px] text-xs font-light">{{ $item->terbeli }}
        </div>
        <div
          class="{{ $loop->index % 3 == 0 ? 'bg-green-100' : ($loop->index % 3 == 1 ? 'bg-rose-100' : 'bg-orange-100') }} flex h-[35px] w-[100px] items-center justify-center rounded-xl text-center text-xs font-semibold">
          {{ $item->category }}
        </div>
        <button class="pr-6" onclick="showProductDetails(this.parentElement)">
          <x-three-dot></x-three-dot>
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
      <div id="item-details">

      </div>
    {{ $items->links() }}
  </div>
</div>
