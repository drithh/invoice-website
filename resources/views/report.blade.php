<x-app-layout>
  {{-- <div class="welcome">Report</div> --}}
  <div class="relative -z-10 mx-12 flex flex-col">
    <div class="-z-100 relative h-[514px] w-[45rem] overflow-hidden rounded-lg bg-white p-8">
      <h3 class="text-primary-textdark text-lg font-semibold">Produk Terjual</h3>
      <p class="text-primary-textgray text-sm font-light">dalam Rupiah (Rp)</p>
      <div class="pointer-events-auto overflow-hidden">
        <div id="donutchart" class="relative z-10 mt-[-70px] h-full w-auto">

  <div class="flex place-content-between px-12">
    <x-chart-card>

      <!-- Session Status -->
      
      <x-auth-session-status class="mb-4" :status="session('status')" />

      <div class="place-items-left flex flex-col place-content-center">
        <div class="title font-montserrat text-primary-purple pb-8 text-2xl font-bold tracking-wide drop-shadow-xl">
          Rata-rata Transaksi 
          <span id='rate' class="text-xs font-montserrat font-bold tracking-wide drop-shadow-xl"></span>
        </div>
        <canvas id="myChart" width="600" height="300"></canvas>
      </div>
    </x-chart-card>
    
      {{-- <div class="welcome">Report</div> --}}
  <div class="mx-12 flex flex-col">
    <div class="rounded-lg bg-white w-[650px] h-[514px] p-8 overflow-hidden">
      <h3 class="text-primary-textdark font-semibold text-lg">Produk Terjual</h3>
      <p class="text-primary-textgray font-light text-sm">dalam Rupiah (Rp)</p>
      <div class="overflow-hidden">
        <div id="donutchart" class="w-auto h-full mt-[-70px]">

        </div>
      </div>
    </div>
  </div>
  <div class="mx-4 mt-8">
    <div id="table-karyawan"></div>
  </div>
</x-app-layout>



<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>

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



  const getSaleAverage = () => {
    axios.get('/api/invoices/average')
    .then(response => {
      if (response.data.message === 'Invoices found') {
        const data = response.data;
        document.getElementById('rate').innerHTML = `(${data.monthsDiff} bulan terakhir)`;
        const ctx = document.getElementById('myChart').getContext('2d');
          const grad = ctx.createLinearGradient(0, 0, 0, 300);
          grad.addColorStop(0, '#BDDEF1');
          grad.addColorStop(1, 'white');

          var datas = data.avgPerHour;
          const myChart = new Chart(ctx, {
            type: 'line',
            data: {
              labels: ['08:00', '10:00', '12:00', '14:00', '16:00', '18:00', '20:00', '22:00'],
              datasets: [{
                label: 'Transaksi',
                data: datas,
                backgroundColor: (context) => {
                  return grad;
                },
                borderColor: '#7F2987',
                borderWidth: 3,
                tension: 0.3,
                fill: true,
                pointHoverRadius: 8
              }]
            },
            options: {
              plugins: {
                legend: {
                  display: false,
                }
              },
              interaction: {
                intersect: false,
              },
              radius: 0,
              scales: {
                x: {
                  offset: true,
                },
                y: {
                  grid: {
                    drawBorder: false
                  },
                  display: false,
                  suggestedMax: () => {
                    return Math.ceil(Math.max(...datas) / 10) * 5;
                  },
                  beginAtZero: true
                }
              }
            }
          });
        }
        // document.querySelector('#data-table').innerHTML = response.data;
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




  setInterval( pieChart = () =>{
    google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var isi_data =[
            ['Category', 'Total harga']
          ];
          @foreach ($total_penjualan as $data )
            isi_data.push(['{{ucwords(strtolower($data->category))}}', {{$data->total_price}}]);
          @endforeach

          var data = google.visualization.arrayToDataTable(isi_data);

          var options = {
            pieSliceText: "none",
            pieHole: 0.5,
            colors : ['#7F2987', "#F26689", "#D51C53" ,"#2390CF", "#23A7AC", "#F79747"],
            fontName : 'Montserrat',
            height: 600,
            legend : {
              position : 'right',
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
      };

      var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
      chart.draw(data, options);
    }
  }

  window.onload = function() {
    pieChart();
    listKaryawan();
      getSaleAverage();
    
  };
</script>
