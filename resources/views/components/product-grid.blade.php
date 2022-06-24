<div class="mb-8 px-8">
  {{-- header --}}
  <div class="mb-16 flex items-center justify-between rounded-xl bg-white py-8 pl-8 pr-16">
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

  <div class="mb-16 grid grid-cols-4 gap-8">
    @foreach ($items as $item)
      <div class="h-[26rem] w-full rounded-xl bg-white">{{ $item->name }}</div>
    @endforeach
  </div>
  <div class="rounded-xl bg-white py-8 pl-8 pr-16">
    {{ $items->links() }}
  </div>
</div>
