
<x-app-layout>
  <x-header-dashboard :date="$date"></x-header-dashboard>

  <x-chart-card>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class=" flex flex-col place-content-center place-items-left">
      <div class="title font-montserrat text-primary-text text-[22px] font-bold tracking-wide drop-shadow-xl pb-8">Grafik Penjualan</div>
      <span id='income' class="title font-montserrat text-primary-text text-xl font-bold tracking-wide drop-shadow-xl mb-4">Rp</span>
      {{-- <div class="text font-poppins text-xs">User no {{Auth::id()}}</div> --}}
      <canvas id="myChart" width="600" height="300"></canvas>
    </div>


  </x-chart-card>

  {{-- <x-chart-card>
    @foreach ($invoices as $invoice)
    <table>
      <tr style='border-bottom: 0.1px solid black;'>
          <td class='text-center'>{{$loop->iteration}}</td>
          <td class='row-nama'>{{$invoice->invoice_number}}</td>
          <td class='w-50 row-komentar'>{{$invoice->invoice_date}}</td>
      </tr>                
    </table>
    @endforeach
  </x-chart-card> --}}
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.5.0/dist/chartjs-plugin-datalabels.min.js"></script> --}}

<script>
  document.getElementById('income').innerHTML += '6.999.999';
  
  const ctx = document.getElementById('myChart').getContext('2d');
  const grad = ctx.createLinearGradient(0, 0, 0, 300);
  grad.addColorStop(0, '#BDDEF1');
  grad.addColorStop(1, 'white');
  
  
  var data = [40, 30, 34, 34, 36, 38, 50, 20, 22, 24, 70, 38];
  var datas = @json($invoicesCtr);
  const myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: @json($monthsName),
          datasets: [{
              label: 'Total Penjualan',
              data: datas,
              backgroundColor: (context) =>{
                // const chart = (context.chart);
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
                  suggestedMax: () => {
                    return Math.ceil(Math.max(...datas)/10)*5;
                  },
                  beginAtZero: true
              }
          }
      }
  });
  </script>

