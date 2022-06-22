<x-app-layout>
  <div class="px-[30px]">
    <x-produk-terbaru :items="$items"></x-produk-terbaru>
  </div>

  {{-- <div id="data-table"></div> --}}
</x-app-layout>

<script>
  const fetchData = async (url) => {
    axios.get(url.split(window.location)[1])
      .then(response => {
        document.querySelector('#data-table').innerHTML = response.data;
      })
      .catch(error => {
        console.log(error);
      });
  };

  const selectYear = () => {
    axios.get('/api/invoices/year')
      .then(response => {
        document.querySelector('#data-table').innerHTML = response.data;
      })
      .catch(error => {
        console.log(error);
      });
  }

  const selectMonth = () => {
    axios.get('/api/invoices/month')
      .then(response => {
        document.querySelector('#data-table').innerHTML = response.data;
      })
      .catch(error => {
        console.log(error);
      });
  }

  const selectWeek = () => {
    axios.get('/api/invoices/week')
      .then(response => {
        document.querySelector('#data-table').innerHTML = response.data;
      })
      .catch(error => {
        console.log(error);
      });
  }

  window.onload = function() {
    selectYear();
  };
</script>
