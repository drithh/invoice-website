<div
  class="struk-penjualan fixed inset-0 z-50 flex h-screen w-screen items-center justify-center bg-black bg-opacity-50">
  <div class="text-primary-textgray w-[540px] rounded-md bg-white px-12 pt-8 pb-12 text-sm">
    <div class="flex items-center justify-between">
      <h3 class="font-poppins mb-6 text-lg font-medium">
        Data Karyawan
      </h3>
      <button class="mb-8 origin-center scale-[2] content-end pl-4" onclick="closeModal()">
        <x-crossmark></x-crossmark>
      </button>
    </div>
    <div class="profile text-primary-textgray mb-2 flex flex-col justify-between gap-y-5 text-base">
      <div class="wrapper relative flex place-content-between">
        <p class="nama">Nama</p>
        <p class="relative right-0 w-44 min-w-min text-right">{{ $user->username }}</p>
      </div>
      <div class="wrapper relative flex place-content-between">
        <p class="nama">Email</p>
        <p class="relative right-0 w-44 min-w-min text-right">{{ $user->email }}</p>
      </div>
      <div class="wrapper relative flex place-content-between">
        <p class="nip">NIP</p>
        <p class="relative right-0 w-44 min-w-min text-right">{{ $user->registration_number }}</p>
      </div>
      <div class="wrapper relative flex place-content-between">
        <p class="alamat">Alamat</p>
        <p class="relative right-0 w-44 min-w-min text-right">{{ $user->address }}</p>
      </div>
      <div class="wrapper relative flex place-content-between">
        <p class="no-hp">No. HP</p>
        <p class="relative right-0 w-44 min-w-min text-right">{{ $user->phone }}</p>
      </div>
      <div class="wrapper relative flex place-content-between">
        <p class="tanggal-lahir">Tanggal Lahir</p>
        <p class="relative right-0 w-44 min-w-min text-right">{{ $user->birthday }}</p>
      </div>
      <div class="wrapper relative flex place-content-between">
        <p class="jabatan">Jabatan</p>
        <p class="relative right-0 w-44 min-w-min text-right">{{ $user->role }}</p>
      </div>
      <div class="wrapper relative flex place-content-between">
        <p class="transaksi">Jumlah Transaksi</p>
        <p class="relative right-0 w-44 min-w-min text-right">{{ $user->invoice_count }}</p>
      </div>

    </div>
  </div>
</div>
</div>
