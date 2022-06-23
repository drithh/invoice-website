<x-app-layout>
  {{-- change class from hidden to flex to see --}}
  <div id="addStock" class="hidden bg-black absolute inset-0 bg-opacity-50 w-screen h-screen items-center justify-center">
    <div class="bg-white rounded-lg w-1/2 h-[520px] px-9 py-12 relative">
      <button class="content-end absolute right-0 top-0 scale-[2] origin-center mt-9 mr-9" onclick="closeModal()">
        <x-crossmark ></x-crossmark>
      </button>
      <div class="flex justify-evenly w-full my-3">
        <button class="w-[30%] h-12 border-2 opacity-70 hover:opacity-100 text-primary-textdark font-semibold text-lg rounded-md ">
          Pembelian
        </button>
        <button class="w-[30%] h-12 border-2 opacity-70 hover:opacity-100 text-primary-textdark font-semibold text-lg rounded-md ">
          Penjualan
        </button>
      </div>
      <div id="beliBarang" class="mt-10 flex justify-center flex-col px-48">
        <h3 class="text-center text-xl font-semibold text-primary-textdark mb-8">Form pembelian barang</h3>
        <div class="form-control flex flex-col mb-4">
          <label for="name" class="font-medium text-lg text-primary-textgray ">Nama</label>
          <input type="text" name="name" placeholder="Nama barang..." class="rounded-md text-sm">
        </div>
        <div class="form-control flex flex-col mb-7">
          <label for="name" class="font-medium text-lg text-primary-textgray ">Nama</label>
          <input type="text" name="name" placeholder="Nama barang..." class="rounded-md text-sm">
        </div>


      </div>

        <div id="body-form">

        </div>

    </div>
  </div>

  {{-- change class from hidden to flex to see --}}
  <div class="struk-pembelian hidden bg-black absolute inset-0 bg-opacity-50 w-screen h-screen items-center justify-center">
    <div class="w-[540px] px-12 pt-8 bg-white text-sm text-primary-textgray rounded-md">
      <h3 class="font-poppins mb-4">
        Struk Pembelian | AB-01-12-3456
      </h3>
      <div class="flex justify-between mb-24 font-poppins text-xs">
        <div class="left flex flex-col justify-start">
          <p class="mb-2">Dari :</p>
          <p class="w-[180px]">
            Mami Tenong FISIP <br>
            Jl Ciputat Raya 18 A, Dki Jakarta <br>
            mami@gmail.com <br>
            021-639-1897
          </p>
        </div>
        <div class="right flex-col justify-start">
          <p class="mb-2">Ke: :</p>
          <p class="w-[180px]">
            Minimarket Sentosa <br>
            Jl KH Hasyim Ashari Dlm 11 L, Dki Jakarta 10310 <br>
            sentosa@gmail.com  <br>
            021-571-9893
          </p>
        </div>

      </div>
      <h3 class="font-semibold text-base mb-8 text-primary-textdark">Deskripsi</h3>
      <div class="flex flex-col text-xs font-poppins text-primary-textdark mb-6">
        <div class="header flex justify-between mb-5">
          <p class="mb-2 w-[170px]">Item</p>
          <p class="mb-2 w-[50px] text-center">Jumlah</p>
          <p class="mb-2 w-[60px] text-center">Rate</p>
          <p class="mb-2 w-[84px] text-right">Harga Total</p>
        </div>
        <div class="header flex justify-between mb-2 text-primary-textgray">
          <p class="mb-2 w-[170px]">Item</p>
          <p class="mb-2 w-[50px] text-center">Jumlah</p>
          <p class="mb-2 w-[60px] text-center">Rate</p>
          <p class="mb-2 w-[84px] text-right">Harga Total</p>
        </div>
        <div class="header flex justify-between mb-2 text-primary-textgray">
          <p class="mb-2 w-[170px]">Item</p>
          <p class="mb-2 w-[50px] text-center">Jumlah</p>
          <p class="mb-2 w-[60px] text-center">Rate</p>
          <p class="mb-2 w-[84px] text-right">Harga Total</p>
        </div>
        <div class="header flex justify-between mb-2 text-primary-textgray">
          <p class="mb-2 w-[170px]">Item</p>
          <p class="mb-2 w-[50px] text-center">Jumlah</p>
          <p class="mb-2 w-[60px] text-center">Rate</p>
          <p class="mb-2 w-[84px] text-right">Harga Total</p>
        </div>
        <div class="header flex justify-between mb-2 text-primary-textgray">
          <p class="mb-2 w-[170px]">Item</p>
          <p class="mb-2 w-[50px] text-center">Jumlah</p>
          <p class="mb-2 w-[60px] text-center">Rate</p>
          <p class="mb-2 w-[84px] text-right">Harga Total</p>
        </div>


      </div>
      <div class="flex flex-col w-[230px] ml-auto mr-0 text-xs font-poppins text-primary-textdark mb-16">
        <div class="flex justify-between mb-2">
          <p>Subtotal</p>
          <p>Rp800K</p>
        </div>
        <div class="flex justify-between mb-[6px]">
          <p>Tax 10%</p>
          <p>Rp80K</p>
        </div>
        <div class="flex justify-between mb-[6px]">
          <p>Total</p>
          <p>Rp880K</p>
        </div>
      </div>
    </div>
  </div>

  {{-- change class from hidden to flex to see --}}
  <div class="struk-penjualan flex bg-black absolute inset-0 bg-opacity-50 w-screen h-screen items-center justify-center">
    <div class="w-[540px] px-12 pt-8 bg-white text-sm text-primary-textgray rounded-md">
      <h3 class="font-poppins mb-6">
        Struk Pembelian | AB-01-12-3456
      </h3>
      <div class="mb-9 font-poppins">
        <div class="flex flex-col justify-start items-center mb-12">
          <h3 class="text-base">MINIMARKET SENTOSA</h3>
          <p class="text-xs">Jl KH Hasyim Ashari Dlm 11 L, Dki Jakarta 10310</p>
        </div>
        <div class="w-full border-y-4 py-3  border-[#F6F5FA] flex justify-between text-xs">
          <p>22-06-2022 12:15:00</p>
          <p>Jono Gunawan</p>
        </div>

      </div>
      <h3 class="font-semibold text-base mb-8 text-primary-textdark">Deskripsi</h3>
      <div class="flex flex-col text-xs font-poppins text-primary-textdark mb-6">
        <div class="header flex justify-between mb-5">
          <p class="mb-2 w-[170px]">Item</p>
          <p class="mb-2 w-[50px] text-center">Jumlah</p>
          <p class="mb-2 w-[60px] text-center">Rate</p>
          <p class="mb-2 w-[84px] text-right">Harga Total</p>
        </div>
        <div class="header flex justify-between mb-2 text-primary-textgray">
          <p class="mb-2 w-[170px]">Item</p>
          <p class="mb-2 w-[50px] text-center">Jumlah</p>
          <p class="mb-2 w-[60px] text-center">Rate</p>
          <p class="mb-2 w-[84px] text-right">Harga Total</p>
        </div>
        <div class="header flex justify-between mb-2 text-primary-textgray">
          <p class="mb-2 w-[170px]">Item</p>
          <p class="mb-2 w-[50px] text-center">Jumlah</p>
          <p class="mb-2 w-[60px] text-center">Rate</p>
          <p class="mb-2 w-[84px] text-right">Harga Total</p>
        </div>
        <div class="header flex justify-between mb-2 text-primary-textgray">
          <p class="mb-2 w-[170px]">Item</p>
          <p class="mb-2 w-[50px] text-center">Jumlah</p>
          <p class="mb-2 w-[60px] text-center">Rate</p>
          <p class="mb-2 w-[84px] text-right">Harga Total</p>
        </div>
        <div class="header flex justify-between mb-2 text-primary-textgray">
          <p class="mb-2 w-[170px]">Item</p>
          <p class="mb-2 w-[50px] text-center">Jumlah</p>
          <p class="mb-2 w-[60px] text-center">Rate</p>
          <p class="mb-2 w-[84px] text-right">Harga Total</p>
        </div>


      </div>
      <div class="flex flex-col w-[230px] ml-auto mr-0 text-xs font-poppins text-primary-textdark mb-14">
        <div class="flex justify-between mb-2">
          <p>Subtotal</p>
          <p>Rp800K</p>
        </div>
        <div class="flex justify-between mb-[6px]">
          <p>Tax 10%</p>
          <p>Rp80K</p>
        </div>
        <div class="flex justify-between mb-[6px]">
          <p>Total</p>
          <p>Rp880K</p>
        </div>
      </div>
      <div class="text-xs font-poppins text-center w-full mb-10">LAYANAN KONSUMEN CALL 021-571-9893</div>
    </div>
  </div>
</x-app-layout>
<script>
  const closeModal = () => {
    document.getElementById('addStock').classList.remove('flex');
    document.getElementById('addStock').classList.add('hidden');
  }

  const addData = () => {
    var addStock = document.getElementById('addStock');
    addStock.classList.remove('hidden');
    addStock.classList.add('flex');
  };
</script>
