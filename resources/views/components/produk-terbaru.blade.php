<div class="w-[50%] rounded-lg bg-white px-10 pt-8 pb-4">
  <h2 class="text-primary-purple mb-9 text-2xl font-bold">Produk terbaru yang terjual</h2>

  {{-- table --}}
  <div class="flex flex-col place-content-between gap-y-3 px-4">
    @foreach ($items as $item => $value)
      <div class="mb-6 flex w-full place-content-between items-center">
        <h1 class="text-primary-purple w-[30px] text-2xl font-bold">#{{ $item + 1 }}</h1>
        <div
          class="{{ $loop->index % 3 == 0 ? 'bg-primary-warmblue' : ($loop->index % 3 == 1 ? 'bg-primary-orange' : 'bg-primary-warmpink') }} border-primary-cloud h-[50px] w-[50px] rounded-lg border-4">
        </div>
        <div class="flex h-[50px] w-[325px] flex-col items-start justify-around">
          <h3 class="text-primary-textdark text-xs font-semibold">{{ ucwords(strtolower($value->name)) }}</h3>
          <p class="text-poppins text-primary-textgray text-xs font-light">{{ ucwords(strtolower($value->category)) }}
          </p>
        </div>
        <h3
          class="{{ $loop->index % 3 == 0 ? 'text-primary-warmblue' : ($loop->index % 3 == 1 ? 'text-primary-orange' : 'text-primary-warmpink') }} flex w-[80px] justify-end pr-5 text-right text-sm font-semibold">
          Rp{{ $value->retail_price }}</h3>
      </div>
    @endforeach
  </div>
</div>
