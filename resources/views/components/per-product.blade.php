<div
  class="struk-penjualan fixed inset-0 z-50 flex h-screen w-screen items-center justify-center bg-black bg-opacity-50">
  <div class="text-primary-textgray w-[540px] rounded-md bg-white px-12 pt-8 text-sm">
    <div class="flex items-center justify-between">
      <h3 class="font-poppins mb-6">
        Informasi Produk
      </h3>
      <button class="mb-8 origin-center scale-[2] content-end pl-4" onclick="closeProductDetails()">
        <x-crossmark></x-crossmark>
      </button>
    </div>
    <div class="font-poppins mb-9">
      <div class="mb-12 flex flex-col items-center justify-start">
        <h3 class="text-base">MINIMARKET SENTOSA</h3>
        <p class="text-xs">Jl KH Hasyim Ashari Dlm 11 L, Dki Jakarta 10310</p>
      </div>
    </div>
    <h3 class="text-primary-textdark mb-8 text-base font-semibold">Deskripsi</h3>
    <div class="font-poppins text-primary-textdark mb-6 flex flex-col text-xs">
      <div class="header mb-5 flex">
        <p class="mb-2">{{ $item->name }}</p>
      </div>
      <div class="header text-primary-textgray mb-2 flex">
        <p class="mb-2 w-[100px]">Kategori</p>
        <p class="mb-2">: {{ $item->category }}</p>
      </div>
      <div class="header text-primary-textgray mb-2 flex">
        <p class="mb-2 w-[100px]">Content</p>
        <p class="mb-2 w-[100px]">: {{ $item->content }}</p>
      </div>
      <div class="header text-primary-textgray mb-2 flex">
        <p class="mb-2 w-[100px]">Unit</p>
        <p class="mb-2 w-[100px]">: {{ $item->unit }}</p>
      </div>
      <div class="header text-primary-textgray mb-2 flex">
        <p class="mb-2 w-[100px]">Harga beli</p>
        <p class="mb-2 w-[100px]">: Rp{{ $item->cost_of_goods_sold }}</p>
      </div>
      <div class="header text-primary-textgray mb-2 flex">
        <p class="mb-2 w-[100px]">Harga jual</p>
        <p class="mb-2 w-[100px]">: Rp{{ $item->retail_price }}</p>
      </div>
      <div class="header text-primary-textgray mb-2 flex">
        <p class="mb-2 w-[100px]">Stock</p>
        <p class="mb-2 w-[100px]">: {{ $item->stock }}</p>
      </div>
      <div class="header text-primary-textgray mb-2 flex">
        <p class="mb-2 w-[100px]">Terakhir terjual</p>
        <p class="mb-2 w-[100px]">: {{ $item->last_purchase_date }}</p>
      </div>

    </div>
    <div class="font-poppins mb-10 w-full text-center text-xs">LAYANAN KONSUMEN CALL 021-571-9893</div>
  </div>
</div>
