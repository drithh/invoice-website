<div class="">
  <div class="mb-8 rounded-xl bg-white py-8 pl-10 pr-14">
    {{-- header --}}
    <div class="mb-12 flex items-center justify-between">
      <div class="w-[320px] text-sm">
        <div class="text-primary-textgray my-auto flex items-center justify-between rounded-lg bg-[#EFF1F9]">
          <button
            class="{{ $invoice_select == 'all' ? 'bg-primary-cyan rounded-lg font-semibold text-white' : '' }} flex h-[35px] w-[22%] cursor-pointer items-center justify-center"
            onclick="filterInvoices(0)">All</button>
          <button
            class="{{ $invoice_select == 'penjualan' ? 'bg-primary-cyan rounded-lg font-semibold text-white' : '' }} flex h-[35px] w-[34%] cursor-pointer items-center justify-center"
            onclick="filterInvoices(1)">Penjualan</button>
          <button
            class="{{ $invoice_select == 'pembelian' ? 'bg-primary-cyan rounded-lg font-semibold text-white' : '' }} flex h-[35px] w-[34%] cursor-pointer items-center justify-center"
            onclick="filterInvoices(2)">Pembelian</button>
        </div>
      </div>
    </div>
    <div
      class="text-primary-textdark mr-32 ml-20 mb-12 flex flex-row place-content-between rounded-lg bg-slate-50 py-4 pl-4 text-sm">
      <button class="wrapper flex h-full flex-row place-items-center gap-x-4 px-9">
        <x-sort></x-sort>
        <div>Invoice</div>
      </button>
      <button class="wrapper flex h-full flex-row place-items-center gap-x-4 px-9">
        <x-sort></x-sort>
        <div>Tanggal</div>
      </button>
      <button class="wrapper flex h-full flex-row place-items-center gap-x-4 px-9">
        <x-sort></x-sort>
        <div>Kategori</div>
      </button>
      <button class="wrapper flex h-full flex-row place-items-center gap-x-4 px-9">
        <x-sort></x-sort>
        <div>Nama</div>
      </button>
      <button class="wrapper flex h-full flex-row place-items-center gap-x-4 px-9 pr-[5.3rem]">
        <x-sort></x-sort>
        <div>Harga</div>
      </button>

    </div>
    <div class="px-8">
      @foreach ($invoices as $invoice)
        <div class="flex place-content-between place-items-center py-6">
          <div>
            <x-invoice-logo></x-invoice-logo>
          </div>
          <div class="flex w-[15%] flex-col">
            <h3 class="text-primary-textdark mb-2 text-sm">{{ $invoice->invoice_number }}</h3>
          </div>
          <div class="flex w-[15%] flex-col">
            <h3 class="text-primary-textdark mb-2 text-sm">{{ $invoice->invoice_date }}</h3>
          </div>
          <div class="flex w-[15%] flex-col">
            <h3 class="text-primary-textdark mb-2 text-sm">{{ Str::ucfirst($invoice->category) }}</h3>
          </div>
          <div class="flex w-[15%] flex-col">
            <h3 class="text-primary-textdark mb-2 text-sm font-semibold">{{ $invoice->username }}</h3>
            <p class="text-primary-textgray text-xs font-light">{{ $invoice->email }}</p>
          </div>
          <div
            class="{{ $loop->index % 3 == 0 ? 'text-primary-warmblue' : ($loop->index % 3 == 1 ? 'text-primary-orange' : 'text-primary-warmpink') }} w-[10%] text-xs font-semibold">
            Rp{{ $invoice->total_price }},00
          </div>
          <div>
            <input type="hidden" name="id" id="id" category="{{ $invoice->category }}"
              value="{{ $invoice->id }}">
            <button type="button" class="h-full p-4" onclick="viewModal(this.parentElement)">
              <x-three-dot></x-three-dot>
            </button>
          </div>
        </div>
      @endforeach
    </div>
    <div class="mt-8">
      {{ $invoices->links() }}
    </div>
  </div>
</div>
