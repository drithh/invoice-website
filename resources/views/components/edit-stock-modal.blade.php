

<div class="my-6 w-full items-center flex justify-between border-b-2">
  <h1 class="font-semibold text-base w-[30px]">No</h1>

  <div class="flex h-[50px] w-[325px] flex-col items-start justify-around">
    <h3 class="text-primary-textdark text-base font-semibold">Name</h3>
  </div>
  <h3 class=" flex w-[130px] text-base font-semibold">
    Supplier
  </h3>
  <p class="w-[70px]">Stock</p>
  <p class="w-[100px] text-center">Edit Stock</p>
</div>

@foreach ($items as $item)
<div class="mb-6 w-full items-center flex justify-between " id="search_results{{ $loop->index+1 }}">
  <h1 class="font-bold text-xl w-[30px]">{{ $loop->index+1 }}</h1>

  <div class="flex h-[50px] w-[325px] flex-col items-start justify-around">
    <h3 class="text-primary-textdark text-xs font-semibold">{{ $item->name }}</h3>
    <p class="text-poppins text-primary-textgray text-xs font-light">{{ $item->category }}</p>
  </div>
  <h3 class=" flex w-[130px] text-sm font-semibold">
    {{ $item->supplier }}
  </h3>
  <div id="stock" class="w-[70px]">
    <p>{{ $item->stock }}</p>
  </div>

  <div class="w-[100px] flex justify-evenly" >
      <input type="hidden" name="id" id="itemId" value="{{ $item->id }}">
      <button type="submit" id="updateStock" onclick="updateStock(this.parentElement.parentElement)" class="scale-150 origin-center invisible">
        <x-checkmark></x-checkmark>
      </button>
      <button type="submit" id="editStock" onclick="editStock(this.parentElement.parentElement)" >
        <x-edit-row></x-edit-row>
      </button>
      <button onclick="cancelUpdateStock(this.parentElement.parentElement)" id="cancelStock" class="
     invisible scale-150 origin-center">
        <x-crossmark></x-crossmark>
      </button>
  </div>
</div>

@endforeach
