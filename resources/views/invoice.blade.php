<x-app-layout>

  <div id="invoice"></div>
</x-app-layout>


<script>
  const addData = () => {
    alert('add data');
  }

  const selectYear = () => {
    axios.get('/api/invoices/all')
      .then(response => {
        console.log(response.data);
        // document.querySelector('#data-table').innerHTML = response.data;
      })
      .catch(error => {
        console.log(error);
      });
  }
  window.onload = () => {
    selectYear();
  }
</script>
