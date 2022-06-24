<x-app-layout>

  <div id="invoice-table"></div>
</x-app-layout>


<script>
  const addData = () => {
    alert('add data');
  }

  const viewModal = (e) => {
    const idInvoice = e.querySelector('input').value;
    alert(idInvoice);
  }

  let globalFilter = 0;

  const fetchData = async (url) => {
    console.log(url.split(window.location)[0]);
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
