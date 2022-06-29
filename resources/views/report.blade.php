<x-app-layout>
  <div id="modal-karyawan"></div>

  <div class="flex flex-wrap place-content-between gap-8 px-12">
    {{-- Pie Chart Produk Terjual --}}
    <div class="h-[37rem] w-[49rem] overflow-hidden rounded-xl bg-white p-8">
      <h3 class="title font-montserrat text-primary-purple text-2xl font-bold tracking-wide drop-shadow-xl">Produk
        Terjual</h3>
      <p class="text-primary-textgray pb-8 text-lg font-medium text-opacity-40">dalam Rupiah (Rp)</p>
      <div class="overflow-hidden">
        <div id="donutchart" class="mt-[-70px] h-full w-auto">
        </div>
      </div>
    </div>


    <div class="h-[37rem] w-[57rem] overflow-hidden rounded-xl bg-white p-10 pt-12">
      <div class="place-items-left flex flex-col place-content-center">
        <div class="title font-montserrat text-primary-purple pb-8 text-2xl font-bold tracking-wide drop-shadow-xl">
          Rata-rata Transaksi
          <span id='rate' class="font-montserrat text-xs font-bold tracking-wide drop-shadow-xl"></span>
        </div>
        <canvas id="myChart" width="600" height="300"></canvas>
      </div>
    </div>

    <div id="table-karyawan"></div>

    <div class="h-fit w-[66rem] overflow-hidden rounded-lg bg-white p-8">
      <h3 class="title font-montserrat text-primary-purple text-2xl font-bold tracking-wide drop-shadow-xl">Pendapatan
        per bulan</h3>
      <p class="text-primary-textgray pb-8 text-lg font-medium text-opacity-40">dalam Rupiah (Rp)</p>
      <div class="mt-[-2rem] overflow-hidden">
        <div id="columnchart_material" class="ml-[-4.5rem] h-full w-auto">
        </div>
      </div>
    </div>



  </div>
</x-app-layout>



<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>

<script defer>
  const blockChart = () => {
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var column_data = [
        ['Month', 'Pengeluaran', 'Pendapatan']
      ];
      var bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

      @foreach ($pendapatan_bulanan as $data)
        column_data.push([bulan[{{ $data->bulan }} - 1], {{ $data->pengeluaran }}, {{ $data->untung_kotor }}]);
      @endforeach

      var data = google.visualization.arrayToDataTable(column_data);

      var options = {
        legend: {
          position: 'bottom',
          alignment: 'start'
        },
        fontName: "Montserrat",
        fontSize: 12,
        height: 400,
        width: 1200,
      };
      var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_material'));
      // var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

      chart.draw(data, options);
    }
  }

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
        document.querySelector('#table-karyawan').innerHTML = response.data;
      })
  }


  const viewModal = (e) => {
    const id = e.querySelector('.id').value;
    axios.get('/api/user/get/' + id)
      .then(response => {
        document.querySelector('#modal-karyawan').innerHTML = response.data;
      })
      .catch(error => {
        console.log(error);
      });
  }

  const closeModal = () => {
    document.querySelector('#modal-karyawan').innerHTML = '';
  }


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
                  offset: true,
                  grid: {
                    drawBorder: false
                  },
                  display: false,
                  suggestedMax: () => {
                    return (Math.ceil(Math.max(...datas) / 10) * 6) + 10
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
        isi_data.push(['{{ ucwords(strtolower($data->category)) }}',
          {{ $data->total_price }}
        ]);
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
  };


  window.onload = function() {
    pieChart();
    listKaryawan();
    getSaleAverage();
    blockChart();

  };
</script>
