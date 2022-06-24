<x-app-layout>

  {{-- change class from hidden to flex to see --}}
  <div id="addStock" class="fixed inset-0 flex h-screen w-screen items-center justify-center bg-black bg-opacity-50">
    <div class="relative w-1/2 rounded-lg bg-white px-9 py-12">
      <button class="absolute right-0 top-0 mt-9 mr-9 origin-center scale-[2] content-end" onclick="closeModal()">
        <x-crossmark></x-crossmark>
      </button>
      <div class="my-3 flex w-full justify-evenly">
        <button
          class="text-primary-textdark h-12 w-[30%] rounded-md border-2 text-lg font-semibold opacity-70 hover:opacity-100" onclick="formPembelian()">
          Pembelian
        </button>
        <button
          class="text-primary-textdark h-12 w-[30%] rounded-md border-2 text-lg font-semibold opacity-70 hover:opacity-100" onclick="formPenjualan()">
          Penjualan
        </button>
      </div>
      <div id="beliBarang" class="hidden mt-10 flex-col justify-center px-16">
        <h3 class="text-primary-textdark mb-8 text-center text-lg font-semibold">MINIMARKET SENTOSA</h3>
        <div class="form-control mb-2 flex justify-between pb-2 border-b-4">
          <p class="w-[300px] text-sm">Nama</p>
          <p class="w-[70px] text-center text-sm">Qty</p>
          <p class="w-[120px] text-center text-sm">Action</p>
        </div>
        <div id="body-form-pembelian" class="">
          <div class="form-control mb-2 flex justify-between pb-1 border-b-2">
            <input class="w-[300px] text-xs border-2 rounded-md px-2" placeholder="Masukkan nama barang.." name='nama[]' id="nama">
            <input class="w-[70px] text-center text-xs border-2 rounded-md" name="qty[]" placeholder="qty" id="qty">
            <div class="w-[120px] text-center flex justify-center items-center">
              <button
              class="text-primary-cyan font-semibold text-lg plus" onclick="addItem()">+</button>
            </div>
          </div>
          <div class="w-full flex justify-center">
            <button class="text-center mx-auto mt-6 bg-primary-blue px-4 py-2 rounded-lg font-semibold text-primary-background">
              Submit
            </button>
          </div>
        </div>

      </div>
      <div id="jualBarang" class="  mt-10 flex-col justify-center px-12">
        <div class="relative block">
          <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-4 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm mb-4" placeholder="Cari supplier..." id="search_input" type="text" name="search"  onkeyup="searchSupplier()"/>
          {{-- <p class="font-semibold text-base text-primary-textdark hidden" id="input_value"></p> --}}
            <div id="search_result" class="mb-8 flex-wrap items-start gap-4">

            </div>

        </div>
        <div class="form-control mb-2 flex justify-between pb-2 border-b-4">
          <p class="w-[300px] text-sm">Nama</p>
          <p class="w-[70px] text-center text-sm">Qty</p>
          <p class="w-[120px] text-center text-sm">Action</p>
        </div>
        <div id="body-form-penjualan" class="">
          <div class="form-control mb-2 flex justify-between pb-1 border-b-2">
            <input class="w-[300px] text-xs border-2 rounded-md px-2" placeholder="Masukkan nama barang.." name='nama[]' id="nama">
            <input class="w-[70px] text-center text-xs border-2 rounded-md" name="qty[]" placeholder="qty" id="qty">
            <div class="w-[120px] text-center flex justify-center items-center">
              <button
              class="text-primary-cyan font-semibold text-lg plus" onclick="addItem()">+</button>
            </div>
          </div>
          <div class="w-full flex justify-center">
            <button class="text-center mx-auto mt-6 bg-primary-blue px-4 py-2 rounded-lg font-semibold text-primary-background">
              Submit
            </button>
          </div>
        </div>
      </div>
      <div id="body-form">

      </div>

    </div>
  </div>

  <div id="modal"></div>

  <div id="invoice-table"></div>

</x-app-layout>


<script>
  let clickSearch = false;
  const placeSearchValue= (e) =>{
    value = e.innerHTML;
    clickSearch = true;
    document.getElementById('search_input').value = value;
    document.querySelector('#search_result').innerHTML='';
  }

  const searchSupplier = () =>{
    if(clickSearch){
      clickSearch = false;
      return;
    }
    var bodyFormData = new FormData();
    var input = document.getElementById('search_input').value;
    bodyFormData.set('search',input);

    axios({
      method: 'post',
      url: '/api/supplier/search',
      data: bodyFormData,
    })
    .then(response =>{
      var button = response.data.map(item =>{
        return `<button class="button-0 px-3 mb-2 py-1 bg-primary-textdark text-primary-background mr-2 rounded-lg" onclick="placeSearchValue(this)">${item.name}</button>`;
      });

      document.querySelector('#search_result').innerHTML = button.join('');
   })
  }

  const formPenjualan = () =>{

    document.getElementById('beliBarang').classList.add('hidden');
    document.getElementById('jualBarang').classList.remove('hidden');
  }

  const formPembelian = () =>{
    document.getElementById('beliBarang').classList.remove('hidden');
    document.getElementById('jualBarang').classList.add('hidden');
  }

  const addItem = () =>{
    let nama = document.getElementById('nama').value;
    let qty = document.getElementById('qty').value;
    var row = document.querySelector('#body-form-pembelian .form-control');
    var newRow = row.cloneNode(true);
    document.querySelector('#body-form').appendChild(newRow);
    row.innerHTML =`
    <p class="w-[300px] text-xs px-2">${nama}</p>
    <p class="w-[70px] text-center text-xs">${qty}</p>
    <div class="w-[120px] text-center flex justify-center items-center">
      <button>
      <x-crossmark></x-crossmark>
      </button>
    </div>

    `;
    row.classList.remove('form-control');


  }

  const closeModal = () => {
    document.getElementById('addStock').classList.remove('flex');
    document.getElementById('addStock').classList.add('hidden');
  }

  const viewModal = (e) => {
    const invoice = e.querySelector('input');
    const invoiceCategory = invoice.getAttribute('category');
    if (invoiceCategory === 'penjualan') {
      axios.get(`/api/invoices/sell/${invoice.value}`).then(
        response => {
          console.log(response.data);
        }
      )
    } else {
      axios.get(`/api/invoices/buy/${invoice.value}`).then(
        response => {
          console.log(response.data);
        }
      )
    }

  }

  let globalFilter = 0;

  const fetchData = async (url) => {
    axios.get(url.split(window.location)[0], {
        params: {
          select: globalFilter
        }
      })
      .then(response => {
        document.querySelector('#invoice-table').innerHTML = response.data;
      })
      .catch(error => {
        console.log(error);
      });
  };

  const filterInvoices = (filter) => {

    if (filter) {
      globalFilter = filter;
    }
    const formData = new FormData();
    formData.append('select', filter);
    axios.get('/api/invoices/all', {
        params: {
          select: globalFilter
        }
      })
      .then(response => {
        document.querySelector('#invoice-table').innerHTML = response.data;
      })
      .catch(error => {
        console.log(error);
      });
  }

  window.onload = () => {

    filterInvoices();
  }
</script>
