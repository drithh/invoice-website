<div class="">

  <div class="mb-8 w-[40rem] rounded-xl bg-white py-8 px-8">
    <div class="title font-montserrat text-primary-purple mt-6 pb-12 text-2xl font-bold tracking-wide drop-shadow-xl">
      Karyawan Terbaik</div>
    <div
      class="text-primary-textdark ml-2 mr-4 mb-6 flex flex-row place-content-between rounded-lg bg-slate-50 py-4 pr-16 text-sm">
      <button class="wrapper flex h-full flex-row place-items-center gap-x-4 px-9">
        <x-sort></x-sort>
        <div>Nama</div>
      </button>
      <button class="wrapper flex h-full flex-row place-items-center gap-x-4 px-9">
        <x-sort></x-sort>
        <div>Transaksi</div>
      </button>
    </div>
    <div class="px-8">
      @foreach ($users as $karyawan)
        <div class="flex place-content-between place-items-center py-6">
          <div class="flex w-[50%] flex-col">
            <h3 class="text-primary-textdark mb-2 text-sm">{{ $karyawan->username }}</h3>
          </div>
          <div
            class="{{ $loop->index % 3 == 0 ? 'text-primary-warmblue' : ($loop->index % 3 == 1 ? 'text-primary-orange' : 'text-primary-warmpink') }} w-[10%] text-center text-xs font-semibold">
            {{ $karyawan->invoice_count }}
          </div>
          <div>
            <input type="hidden" class="id" name="id" value="{{ $karyawan->id }}">
            <button type="button" class="h-full p-4" onclick="viewModal(this.parentElement)">
              <x-three-dot></x-three-dot>
            </button>
          </div>
        </div>
      @endforeach
    </div>
    <div class="mt-8">
      {{ $users->links() }}
    </div>
  </div>
</div>
