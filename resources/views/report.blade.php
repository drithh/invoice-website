<x-app-layout>
  {{-- <div class="welcome">Report</div> --}}
  <div class="relative -z-10 mx-12 flex flex-col">
    <div class="-z-100 relative h-[514px] w-[45rem] overflow-hidden rounded-lg bg-white p-8">
      <h3 class="text-primary-textdark text-lg font-semibold">Produk Terjual</h3>
      <p class="text-primary-textgray text-sm font-light">dalam Rupiah (Rp)</p>
      <div class="pointer-events-auto overflow-hidden">
        <div id="donutchart" class="relative z-10 mt-[-70px] h-full w-auto">

        </div>
      </div>
    </div>
  </div>
  <div class="mx-4 mt-8">
    <div id="table-karyawan"></div>
  </div>
</x-app-layout>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script defer>
  const fetchData = async (url) => {
    axios.get(url.split(window.location)[0])
      .then(response => {
        document.querySelector('#table-karyawan').innerHTML = response.data;
      })
      .catch(error => {
        console.log(error);
      });
  };

  const listKaryawan = () => {
    axios.get('/api/user/get')
      .then(response => {
        console.log(response.data);
        document.querySelector('#table-karyawan').innerHTML = response.data;
      })
      .catch(error => {
        console.log(error);
      });
  }

  const pieChart = () => {
    google.charts.load("current", {
      packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var isi_data = [
        ['Category', 'Total harga']
      ];
      @foreach ($total_penjualan as $data)
        isi_data.push(['{{ ucwords(strtolower($data->category)) }}', {{ $data->total_price }}]);
      @endforeach

      var data = google.visualization.arrayToDataTable(isi_data);

      var options = {
        pieSliceText: "none",
        pieHole: 0.5,
        colors: ['#7F2987', "#F26689", "#D51C53", "#2390CF", "#23A7AC", "#F79747"],
        fontName: 'Montserrat',
        height: 600,
        legend: {
          position: 'right',
          textStyle: {
            fontSize: 12,
            color: '#626679',
            fontName: 'Montserrat',
          }
        }
      };

      var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
      chart.draw(data, options);
    }
  }

  window.onload = function() {
    pieChart();
    listKaryawan();
  };
</script>
