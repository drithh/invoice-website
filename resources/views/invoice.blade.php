<x-app-layout>

  <div id="invoice-table"></div>
</x-app-layout>


<script>
  const addData = () => {
    alert('add data');
  }

  const selectYear = () => {
    const formData = new FormData();
    formData.append('select', 0);
    axios.get('/api/invoices/all', {
        params: {
          select: 0
        }
      })
      .then(response => {
        console.log(response.data);
        document.querySelector('#invoice-table').innerHTML = response.data;
      })
      .catch(error => {
        console.log(error);
      });
  }
  window.onload = () => {
    selectYear();
  }
</script>
