<x-app-layout>

  {{-- change class from hidden to flex to see --}}
  <div id="add-stock" class="hidden">
    <div class="fixed inset-0 z-50 flex h-screen w-screen items-center justify-center bg-black bg-opacity-50">
      <div class="relative w-1/2 rounded-lg bg-white px-9 py-12">
        <button class="absolute right-0 top-0 mt-9 mr-9 origin-center scale-[2] content-end" onclick="toggleModal()">
          <x-crossmark></x-crossmark>
        </button>
        <div class="my-3 flex w-full justify-evenly">
          <button
            class="penjualan text-primary-textdark h-12 w-[30%] rounded-md border-2 text-lg font-semibold opacity-100 hover:opacity-100"
            onclick="formPenjualan(this.parentElement)">
            Penjualan
          </button>
          <button
            class="pembelian text-primary-textdark h-12 w-[30%] rounded-md border-2 text-lg font-semibold opacity-70 hover:opacity-100"
            onclick="formPembelian(this.parentElement)">
            Pembelian
          </button>
        </div>
        <div id="jual-barang" class="mt-10 flex-col justify-center px-16">
          <h3 class="text-primary-textdark mb-8 text-center text-lg font-semibold">MINIMARKET SENTOSA</h3>
          <div class="form-control mb-2 flex justify-between border-b-4 pb-2">
            <p class="w-80 text-sm">Nama</p>
            <p class="w-[70px] text-center text-sm">Qty</p>
            <p class="w-[120px] text-center text-sm">Action</p>
          </div>
          <div class="input-box">
            <div class="result"></div>
            <div class="input-wrapper mb-2 flex h-10 justify-between border-b-2 pb-1">
              <select class="nama w-80 rounded-md border-2 px-2 text-sm" name="state">
              </select>
              <input class="quantity w-[70px] rounded-md border-2 text-center text-sm" name="qty[]" placeholder="qty">
              <div class="flex w-[120px] items-center justify-center text-center">
                <button class="text-primary-cyan plus text-lg font-semibold" type="button"
                  onclick="addItem(this.parentElement.parentElement.parentElement)">+</button>
                <button class="text-primary-cyan minus hidden text-lg font-semibold"
                  onclick="removeElement(this.parentElement.parentElement)">
                  <x-crossmark></x-crossmark>
                </button>
              </div>
            </div>
          </div>
          <div class="flex w-full justify-center">
            <button onclick="decreaseStock()"
              class="bg-primary-blue text-primary-background mx-auto mt-6 rounded-lg px-4 py-2 text-center font-semibold">
              Submit
            </button>
          </div>
        </div>

        <div id="beli-barang" class="mt-10 hidden flex-col justify-center px-12">
          <div class="relative block">
            <input
              class="mb-4 block w-full rounded-md border border-slate-300 bg-white py-2 pl-4 pr-3 shadow-sm placeholder:italic placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 sm:text-sm"
              placeholder="Cari supplier..." id="search-input" type="text" name="search"
              onkeyup="searchSupplier()" />
            {{-- <p class="font-semibold text-base text-primary-textdark hidden" id="input_value"></p> --}}
            <div id="search-result" class="mb-8 flex-wrap items-start gap-4">

            </div>

          </div>
          <div class="form-control mb-2 flex justify-between border-b-4 pb-2">
            <p class="w-80 text-sm">Nama</p>
            <p class="w-[70px] text-center text-sm">Qty</p>
            <p class="w-[120px] text-center text-sm">Action</p>
          </div>
          <div class="input-box">
            <div class="result"></div>
            <div class="input-wrapper mb-2 flex h-10 justify-between border-b-2 pb-1">
              <select class="nama w-80 rounded-md border-2 px-2 text-sm" name="state">
              </select>
              <input class="quantity w-[70px] rounded-md border-2 text-center text-sm" name="qty[]" placeholder="qty">
              <div class="flex w-[120px] items-center justify-center text-center">
                <button class="text-primary-cyan plus text-lg font-semibold" type="button"
                  onclick="addItem(this.parentElement.parentElement.parentElement)">+</button>
                <button class="text-primary-cyan minus hidden text-lg font-semibold"
                  onclick="removeElement(this.parentElement.parentElement)">
                  <x-crossmark></x-crossmark>
                </button>
              </div>
            </div>
          </div>
          <div class="flex w-full justify-center">
            <button onclick="increaseStock()"
              class="bg-primary-blue text-primary-background mx-auto mt-6 rounded-lg px-4 py-2 text-center font-semibold">
              Submit
            </button>
          </div>
        </div>
        <div id="body-form">

        </div>

      </div>
    </div>
  </div>

  <div id="modal"></div>

  <div id="invoice-table" class="px-12"></div>

  <div id="struck-modal">

  </div>

</x-app-layout>


<script defer>
  // event listener keypress select2
  $('select[name="state"]').select2({
    data: [{
      id: 0,
      text: 'Ketik Nama Item'
    }],
    placeholder: 'Pilih nama barang',
    allowClear: true
  });

  const increaseStock = () => {
    const result = [...document.querySelectorAll('#beli-barang .name-result')]
    const formItem = result.map(item => {
      const nama = item.querySelector('.nama').innerHTML.trim();
      const qty = parseInt(item.querySelector('.quantity-result').innerHTML.trim());
      return {
        name: nama,
        quantity: qty
      }

    });

    const supplier = document.querySelector('#search-input').value;

    axios({
        method: 'POST',
        url: '/api/invoices/create/pembelian',
        data: {
          form: formItem,
          supplier: supplier
        }

      })
      .then(response => {
        alert('Struk berhasil dibuat')
      })

  };

  const decreaseStock = () => {
    const result = [...document.querySelectorAll('#jual-barang .name-result')]
    const formItem = result.map(item => {
      const nama = item.querySelector('.nama').innerHTML.trim();
      const qty = parseInt(item.querySelector('.quantity-result').innerHTML.trim());
      return {
        name: nama,
        quantity: qty
      }

    });

    axios({
        method: 'POST',
        url: '/api/invoices/create/penjualan',
        data: formItem,
      })
      .then(response => {
        alert('Struk berhasil dibuat')
      })
  }

  const closeStruk = () => {
    document.querySelector('#struck-modal').innerHTML = '';
  }




  let clickSearch = false;
  const placeSearchValue = (e) => {
    value = e.innerHTML;
    clickSearch = true;
    document.querySelector('#search-input').value = value;
    document.querySelector('#search-result').innerHTML = '';
  }

  const searchSupplier = () => {
    if (clickSearch) {
      clickSearch = false;
      return;
    }
    var bodyFormData = new FormData();
    var input = document.querySelector('#search-input').value;
    bodyFormData.set('search', input);

    axios({
        method: 'post',
        url: '/api/supplier/search',
        data: bodyFormData,
      })
      .then(response => {
        var button = response.data.map(item => {
          return `<button class="button-0 px-3 mb-2 py-1 bg-primary-textdark text-primary-background mr-2 rounded-lg" onclick="placeSearchValue(this)">${item.name}</button>`;
        });

        document.querySelector('#search-result').innerHTML = button.join('');
      })
  }

  const formPenjualan = (e) => {

    document.querySelector('#beli-barang').classList.add('hidden');
    document.querySelector('#beli-barang').classList.remove('flex');
    e.querySelector('.penjualan').classList.add('opacity-100');
    document.querySelector('#jual-barang').classList.remove('hidden');
    document.querySelector('#jual-barang').classList.add('flex');
    e.querySelector('.pembelian').classList.remove('opacity-100');
    e.querySelector('.pembelian').classList.add('opacity-70');


  }

  const formPembelian = (e) => {
    document.querySelector('#beli-barang').classList.remove('hidden');
    document.querySelector('#beli-barang').classList.add('flex');
    e.querySelector('.penjualan').classList.remove('opacity-100');
    e.querySelector('.penjualan').classList.add('opacity-70');


    document.querySelector('#jual-barang').classList.add('hidden');
    document.querySelector('#jual-barang').classList.remove('flex');

    e.querySelector('.pembelian').classList.add('opacity-100');


  }

  const removeElement = (e) => {
    e.remove();
  }

  const addItem = (e) => {
    console.log(e.querySelector('.quantity'));
    const templateRow = `
    <div class="name-result mb-2 flex h-10 justify-between border-b-2 pb-1">
      <div class="nama w-80 rounded-md border-2 px-2 text-base flex place-items-center "> ${e.querySelector('.select2-selection__rendered').innerHTML.trim()} </div>
      <div class="quantity-result w-[70px] rounded-md border-2 text-center text-base flex place-items-center place-content-center"> ${e.querySelector('.quantity').value} </div>
      <div class="flex w-[120px] items-center justify-center text-center">
        <button class="text-primary-cyan minus text-lg font-semibold"
          onclick="removeElement(this.parentElement.parentElement)">
          <x-crossmark></x-crossmark>
        </button>
      </div>
    </div>
    `;


    // const nama = e.querySelector('.nama').value;
    // const quantity = e.querySelector('.quantity').value;
    const inputRow = e.querySelector('.input-wrapper');
    // const newRow = inputRow.cloneNode(true);
    // set inputRow input disabled
    // newRow.querySelector('.nama').value = nama;
    // newRow.querySelector('.quantity').value = quantity;
    // newRow.querySelector('.nama').disabled = true;
    // newRow.querySelector('.quantity').disabled = true;
    // newRow.querySelector('.plus').classList.add('hidden');
    // newRow.querySelector('.minus').classList.remove('hidden');

    inputRow.querySelector('.quantity').value = '';
    // inputRow.querySelector('.select2-selection__rendered').innerHTML = 'Masukkan Nama Item';


    // var newRow = row.cloneNode(true);
    e.querySelector('.result').innerHTML += templateRow;


  }
  let items;

  const addData = () => {
    toggleModal();
    if (!items) {
      axios.get('/api/item/getAll')
        .then(response => {
          items = response.data;
          if (items) {
            const nama = items.map((item, index) => {
              return {
                id: index,
                text: item.name
              }
            });
            $('select[name="state"]').select2({
              data: nama,
              placeholder: 'Pilih nama barang',
              allowClear: true
            });
          }
        });
    }


  }
  const toggleModal = () => {
    document.querySelector('#add-stock').classList.toggle('hidden');
  }

  const viewModal = (e) => {
    const invoice = e.querySelector('input');
    const invoiceCategory = invoice.getAttribute('category');
    if (invoiceCategory === 'penjualan') {
      axios.get(`/api/invoices/sell/${invoice.value}`)
        .then(
          response => {
            const struckModal = document.querySelector('#struck-modal');
            struckModal.innerHTML = response.data;
          }
        )
    } else {
      axios.get(`/api/invoices/buy/${invoice.value}`)
        .then(
          response => {
            const struckModal = document.querySelector('#struck-modal');
            struckModal.innerHTML = response.data
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
        // console.log(response.data);
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
