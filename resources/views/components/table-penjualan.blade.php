<div class="px-[30px]">
  <div class="rounded-lg bg-white py-[30px] pl-[40px] pr-[60px]">
    {{-- header --}}
    <div class="mb-20 flex items-center justify-between">
      <div class="left">
        <h2 class="text-primary-textdark mb-[0.75rem] text-xl font-semibold">Penjualan Terbaru</h2>
        <p class="text-primary-textgray text-sm">Ada {{ $total_invoices }} struk</p>
      </div>
      <div class="right w-[254px] text-sm">
        <div class="text-primary-textgray my-auto flex items-center justify-between rounded-lg bg-[#EFF1F9]">
          <button
            class="{{ $invoice_select == 'year' ? 'bg-primary-cyan rounded-lg font-semibold text-white' : '' }} flex h-[35px] w-[30%] cursor-pointer items-center justify-center"
            onclick="selectYear()">Year</button>
          <button
            class="{{ $invoice_select == 'month' ? 'bg-primary-cyan rounded-lg font-semibold text-white' : '' }} flex h-[35px] w-[30%] cursor-pointer items-center justify-center"
            onclick="selectMonth()">Month</button>
          <button
            class="{{ $invoice_select == 'week' ? 'bg-primary-cyan rounded-lg font-semibold text-white' : '' }} flex h-[35px] w-[30%] cursor-pointer items-center justify-center"
            onclick="selectWeek()">Week</button>
        </div>
      </div>
    </div>
    @foreach ($invoices as $invoice)
      <div class="mb-8 flex h-[50px] items-center justify-between">
        <div>
          <div class="bg-primary-warmred mr-[33px] block h-[50px] w-[3px] rounded-full"></div>
        </div>
        <div>
          <div class="bg-primary-cloud mr-[42px] h-[50px] w-[50px] rounded-xl"></div>
        </div>
        <div class="flex w-[500px] flex-col">
          <h3 class="text-primary-textdark mb-2 text-sm font-semibold">{{ $invoice->username }}</h3>
          <p class="text-primary-textgray text-xs font-light">{{ $invoice->email }}</p>
        </div>
        <div
          class="{{ $loop->index % 3 == 0 ? 'text-primary-warmblue' : ($loop->index % 3 == 1 ? 'text-primary-orange' : 'text-primary-warmpink') }} w-[320px] text-xs font-semibold">
          Rp{{ $invoice->total_price }},00</div>
        <div class="font-poppins text-primary-textgray w-[200px] text-xs font-light">{{ $invoice->total_items }}
        </div>
        <div class="w-[50px]">
          <x-on-button></x-on-button>
        </div>
        {{-- <div><x-off-button></x-off-button></div> --}}
        <form action="">
          <button type="submit" class="w-[40px]">
            <x-edit-row></x-edit-row>
          </button>
        </form>

        <form action="{{ route('invoice.deleteRow') }}" method="post">
          @csrf
          <input type="hidden" name="id" id="id" value="{{ $invoice->id }}">
          <button type="submit" id="deleteRow">
            <x-delete-row></x-delete-row>
          </button>
        </form>
      </div>
    @endforeach

    {{ $invoices->links() }}
  </div>
</div>
