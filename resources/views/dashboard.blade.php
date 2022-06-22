<x-app-layout>
  <x-header-dashboard :date="$date"></x-header-dashboard>
  <div class="grid grid-cols-2">
    <x-chart-card>

      <!-- Session Status -->
      <x-auth-session-status class="mb-4" :status="session('status')" />

      <div class="place-items-left flex flex-col place-content-center">
        <div class="title font-montserrat text-primary-purple pb-8 text-2xl font-bold tracking-wide drop-shadow-xl">
          Grafik Penjualan</div>
        <span id='income'
          class="title font-montserrat text-primary-purple mb-16 text-xl font-bold tracking-wide drop-shadow-xl">Rp</span>
        <canvas id="myChart" width="600" height="300"></canvas>
      </div>
    </x-chart-card>

    <div class="item"></div>
  </div>



</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>

<script>
  document.getElementById('income').innerHTML = 0;
  if (@json($invoicesCtr)) {
    document.getElementById('income').innerHTML = `Rp.${@json($userIncome)}`;
    const ctx = document.getElementById('myChart').getContext('2d');
    const grad = ctx.createLinearGradient(0, 0, 0, 300);
    grad.addColorStop(0, '#BDDEF1');
    grad.addColorStop(1, 'white');


    var datas = @json($invoicesCtr);
    const myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: @json($monthsName),
        datasets: [{
          label: 'Total Penjualan',
          data: datas,
          backgroundColor: (context) => {
            // const chart = (context.chart);
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
</script>
