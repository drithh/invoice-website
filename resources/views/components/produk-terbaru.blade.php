<div class="bg-white w-[625px] h-[514px] px-7 pt-8 rounded-lg">
  <h2 class="font-semibold text-lg text-primary-textdark mb-9" >Produk terbaru yang terjual</h2>

  {{-- table --}}
  @foreach ($items as $item => $value)

  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-primary-textdark w-[30px]">#{{ $item+1 }}</h1>
    <div class="{{ $loop->index % 3 == 0 ? 'bg-primary-warmblue' : ($loop->index % 3 == 1 ? 'bg-primary-orange' : 'bg-primary-warmpink') }} border-4 border-primary-cloud w-[50px] h-[50px] rounded-lg"></div>
    <div class="flex flex-col justify-around items-start w-[325px] h-[50px]">
      <h3 class="text-xs font-semibold text-primary-textdark">{{ ucwords(strtolower($value->name)) }}</h3>
      <p class="text-poppins text-xs font-light text-primary-textgray">{{ ucwords(strtolower($value->category)) }}</p>
    </div>
    <h3 class="font-semibold text-sm text-right {{ $loop->index % 3 == 0 ? 'text-primary-warmblue' : ($loop->index % 3 == 1 ? 'text-primary-orange' : 'text-primary-warmpink') }} pr-5 w-[80px] flex justify-end ">Rp{{ $value->retail_price }}</h3>
  </div>
  @endforeach
</div>
