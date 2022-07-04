<x-public-layout>
  <div
    class="struk-penjualan inset-0 z-50 flex h-max min-h-screen w-screen items-center justify-center bg-black bg-opacity-50 py-20">
    <div class="text-primary-textgray w-[540px] rounded-md bg-white px-12 pt-8 text-sm">
      <div class="flex items-center justify-between">
        <h3 class="font-poppins mb-6">
          Struk Penjualan | {{ $invoice->invoice_number }}
        </h3>
      </div>
      <div class="font-poppins mb-9">
        <div class="mb-12 flex flex-col items-center justify-start">
          <h3 class="text-base">MINIMARKET SENTOSA</h3>
          <p class="text-xs">Jl KH Hasyim Ashari Dlm 11 L, Dki Jakarta 10310</p>
        </div>
        <div class="flex w-full justify-between border-y-4 border-[#F6F5FA] py-3 text-xs">
          <p>{{ $invoice->invoice_date }}</p>
          <p>{{ $invoice->username }}</p>
        </div>

      </div>
      <h3 class="text-primary-textdark mb-8 text-base font-semibold">Deskripsi</h3>
      <div class="font-poppins text-primary-textdark mb-6 flex flex-col text-xs">
        <div class="header mb-5 flex justify-between">
          <p class="mb-2 w-[170px]">Item</p>
          <p class="mb-2 w-[50px] text-center">Jumlah</p>
          <p class="mb-2 w-[60px] text-center">Rate</p>
          <p class="mb-2 w-[84px] text-right">Harga Total</p>
        </div>
        <div class="wrapper">
          @foreach ($items as $key => $item)
            <div class="header text-primary-textgray mb-2 flex justify-between">
              <p class="mb-2 w-[170px]">{{ $item->name }}</p>
              <p class="mb-2 w-[50px] text-center">{{ $item->quantity }}</p>
              <p class="mb-2 w-[60px] text-center">{{ $item->retail_price }}</p>
              <p class="mb-2 w-[84px] text-right">{{ $item->quantity * $item->retail_price }}</p>
            </div>
          @endforeach
        </div>

      </div>
      <div class="font-poppins text-primary-textdark ml-auto mr-0 mb-14 flex w-[230px] flex-col text-xs">
        <div class="mb-2 flex justify-between">
          <p>Subtotal</p>
          <p>{{ $banyak_items->total_price }}</p>
        </div>
        <div class="mb-[6px] flex justify-between">
          <p>Tax 10%</p>
          <p>{{ ($banyak_items->total_price * 10) / 100 }}</p>
        </div>
        <div class="mb-[6px] flex justify-between">
          <p>Total</p>
          <p>{{ $banyak_items->total_price + ($banyak_items->total_price * 10) / 100 }}</p>
        </div>
      </div>
      <div class="font-poppins mb-10 w-full text-center text-xs">LAYANAN KONSUMEN CALL 021-571-9893</div>
    </div>
  </div>
</x-public-layout>
