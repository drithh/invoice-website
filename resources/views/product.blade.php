<x-app-layout>


  <div id="data-table" class="mt-10 px-[18px]">

  </div>
</x-app-layout>

<script>
  const getItemList = () => {
    axios.get('/api/items/list')
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
  };
</script>
