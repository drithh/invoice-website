<x-app-layout>


  <div id="data-table" class="mt-10 px-[18px]">

  </div>


  <div id="addStock"
    class="absolute inset-0 hidden h-screen w-screen items-center justify-center bg-black bg-opacity-50">
    <div class="relative h-[520px] w-1/2 rounded-lg bg-white px-9 py-10">
      <button class="absolute right-0 top-0 mt-10 mr-9 origin-center scale-[2] content-end" onclick="closeModal()">
        <x-crossmark></x-crossmark>
      </button>
      <h1 class="text-primary-textdark mb-5 text-lg font-semibold">Form tambahkan item</h1>
      <input type="text" name="name" onchange="searchPosts()" onkeyup="searchPosts()" placeholder="Search item"
      class="rounded-lg border-opacity-50" size="45" id="search_input">
      <button
      class="bg-primary-cyan text-primary-background border-primary-textdark border-1 ml-4 h-[41px] w-[75px] rounded-lg font-semibold"
      type="button">
      Search
    </button>
      <div id="body-form">

      </div>

    </div>
  </div>
</x-app-layout>

<script>
  const updateStock = (e) => {
    var bodyFormData = new FormData();
    var itemId = e.querySelector('#itemId').value;
    var newStock = e.querySelector('#newStock').value;
    bodyFormData.append('item_id', itemId);
    bodyFormData.append('stock', newStock);

    axios({
        method: 'post',
        url: '/api/item/updateStock',
        data: bodyFormData,
      })
      .then(response => {
        console.log(response.data);

        e.querySelector('#stock input').remove();
        e.querySelector('#stock').innerHTML = `<p>${newStock}</p>`;
        e.querySelector('#updateStock').classList.add('invisible');
        e.querySelector('#editStock').classList.remove('invisible');
        e.querySelector('#cancelStock').classList.add('invisible');

      })
  }

  const closeProductDetails = () =>{
    document.querySelector('#item-details').innerHTML = '';
  }

  const showProductDetails = (e) =>{

    const items_id = e.querySelector("#item_id").innerHTML;
    var bodyFormData = new FormData();
    bodyFormData.append('items_id', items_id);

    axios({
        method: 'get',
        url: `api/item/getItemDetails/${items_id}`,
        data: bodyFormData,
      })
      .then(response => {
        console.log(response.data);
        document.querySelector('#item-details').innerHTML = response.data;
      })
  }

  const getItemList = () => {
    axios.get('/api/items/list')
      .then(response => {
        document.querySelector('#data-table').innerHTML = response.data;
      })
      .catch(error => {
        console.log(error);
      });
  }

  const getItemGrid = () => {
    axios.get('/api/items/grid')
      .then(response => {
        document.querySelector('#data-table').innerHTML = response.data;
      })
      .catch(error => {
        console.log(error);
      });
  }

  window.onload = function() {
    getItemList();
  }

  const fetchData = async (url) => {
    axios.get(url.split(window.location)[0])
      .then(response => {
        document.querySelector('#data-table').innerHTML = response.data;
      })
      .catch(error => {
        console.log(error);
      });
  }


  const closeModal = () => {
    document.getElementById('addStock').classList.remove('flex');
    document.getElementById('addStock').classList.add('hidden');
  }

  const addData = () => {
    var addStock = document.getElementById('addStock');
    addStock.classList.remove('hidden');
    addStock.classList.add('flex');
  };

  const cancelUpdateStock = (e) => {
    e.querySelector('#updateStock').classList.add('invisible');
    e.querySelector('#cancelStock').classList.add('invisible');
    e.querySelector('#editStock').classList.remove('invisible');
    var itemId = e.querySelector('#itemId').value;
    var inputPlaceholder = e.querySelector('#stock input').placeholder;
    var stock = e.querySelector('#stock');

    stock.innerHTML = `<p>${inputPlaceholder}</p>`;

  }

  const editStock = (e) => {
    var stock = e.querySelector('#stock p');
    var stockVal = stock.innerHTML.trim();
    stock.remove();
    var input = `
    <input type="number" class="rounded-lg w-[70px] appearance-none" name="stock" id="newStock" placeholder="${stockVal}">
    `;
    e.querySelector('#stock').innerHTML = input;

    e.querySelector('#updateStock').classList.remove('invisible');
    e.querySelector('#editStock').classList.add('invisible');
    e.querySelector('#cancelStock').classList.remove('invisible');
  }



  const searchPosts = () => {
    var bodyFormData = new FormData();
    var input = document.getElementById('search_input').value;
    bodyFormData.set('search', input);

    axios({
        method: 'post',
        url: '/api/item/search',
        data: bodyFormData,
      })
      .then(response => {
        document.querySelector('#body-form').innerHTML = response.data;
        console.log(response.data);
      })
  };
</script>
