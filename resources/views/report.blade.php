<x-app-layout>
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
</x-app-layout>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
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
  }, 1000);

</script>
