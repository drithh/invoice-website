<x-app-layout>


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

</x-app-layout>



<script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>

<script>

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

    window.onload = function() {
      getSaleAverage();
    };


  </script>
