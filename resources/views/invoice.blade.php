<x-app-layout>

  {{-- change class from hidden to flex to see --}}
  <div id="addStock" class="fixed inset-0 hidden h-screen w-screen items-center justify-center bg-black bg-opacity-50">
    <div class="relative h-[520px] w-1/2 rounded-lg bg-white px-9 py-12">
      <button class="absolute right-0 top-0 mt-9 mr-9 origin-center scale-[2] content-end" onclick="closeModal()">
        <x-crossmark></x-crossmark>
      </button>
      <div class="my-3 flex w-full justify-evenly">
        <button
          class="text-primary-textdark h-12 w-[30%] rounded-md border-2 text-lg font-semibold opacity-70 hover:opacity-100">
          Pembelian
        </button>
        <button
          class="text-primary-textdark h-12 w-[30%] rounded-md border-2 text-lg font-semibold opacity-70 hover:opacity-100">
          Penjualan
        </button>
      </div>
      <div id="beliBarang" class="mt-10 flex flex-col justify-center px-48">
        <h3 class="text-primary-textdark mb-8 text-center text-xl font-semibold">Form pembelian barang</h3>
        <div class="form-control mb-4 flex flex-col">
          <label for="name" class="text-primary-textgray text-lg font-medium">Nama</label>
          <input type="text" name="name" placeholder="Nama barang..." class="rounded-md text-sm">
        </div>
        <div class="form-control mb-7 flex flex-col">
          <label for="name" class="text-primary-textgray text-lg font-medium">Nama</label>
          <input type="text" name="name" placeholder="Nama barang..." class="rounded-md text-sm">
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
  const addData = () => {
    var addStock = document.getElementById('addStock');
    addStock.classList.remove('hidden');
    addStock.classList.add('flex');
  };
</script>
