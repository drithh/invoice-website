<x-guest-layout>
  <x-chart-card>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class=" flex flex-col place-content-center place-items-left">
      <div class="title font-montserrat text-primary-text text-[22px] font-bold tracking-wide drop-shadow-xl pb-8">Grafik Penjualan</div>
      <span id='income' class="title font-montserrat text-primary-text text-xl font-bold tracking-wide drop-shadow-xl mb-4">Rp</span>
      {{-- <div class="text font-poppins text-xs">User no {{Auth::id()}}</div> --}}
      <canvas id="myChart" width="800" height="400"></canvas>
    </div>


  </x-chart-card>
</x-guest-layout>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.5.0/dist/chartjs-plugin-datalabels.min.js"></script> --}}
<script>
  document.getElementById('income').innerHTML += '450.000';
  
  const ctx = document.getElementById('myChart').getContext('2d');
  const grad = ctx.createLinearGradient(0, 0, 0, 400);
  grad.addColorStop(0, '#BDDEF1');
  grad.addColorStop(1, 'white');

  const myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Juni', 'Aug', 'Sep', 'Okt', 'Nov', 'Des'],
          datasets: [{
              label: 'Total Penjualan',
              data: [40, 30, 34, 34, 36, 38, 20, 22, 24, 70, 38],
              backgroundColor: (context) =>{
                const chart = (context.chart);
                return grad;
              },
              borderColor: '#7F2987',
              borderWidth: 3,
              tension: 0.3,
              fill:true,
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
              // xAxes: [{
              //   gridLines: {
              //     display: false,
              //   }
              // }],
              
              // yAxes:[{
              //   ticks : {
              //       beginAtZero : true,
              //       callback : function(value,index,values){
              //           yAxesticks = values;
              //           return value;
              //       }
              //   }
              // }],
            
              x: {
                  offset:true,
              },

              y: {
                  grid: {
                    drawBorder: false
                  },
                  display:false,
                  suggestedMax: 100,
                  beginAtZero: true
              }
          }
      }
  });
  </script>