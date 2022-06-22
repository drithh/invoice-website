@props(['invoices', 'total_invoices'])

<div class="px-[30px]">
  <div class="bg-white rounded-lg pl-[40px] pr-[60px] py-[30px] ">
    {{-- header --}}
    <div class="flex justify-between items-center mb-20">
      <div class="left">
        <h2 class="font-semibold text-xl mb-[0.75rem] text-primary-textdark">Penjualan Terbaru</h2>
        <p class="text-sm text-primary-textgray">Ada {{ $total_invoices }} struk</p>
      </div>
      <div class="right w-[254px] text-sm">
        <div class="my-auto rounded-lg bg-[#EFF1F9] text-primary-textgray flex justify-between items-center" id="mySelect">
          <button id="month" class="hover:cursor-pointer h-[35px] w-[30%]  flex items-center justify-center active:bg-primary-cyan active:font-semibold active:text-white active:rounded-lg" onclick="selectedMonth()">Month</button>
          {{-- <div class="block h-4 w-[1px] bg-primary-textgray opacity-50"></div> --}}
          <button id="week" class="hover:cursor-pointer h-[35px] w-[30%] flex items-center justify-center active:bg-primary-cyan active:font-semibold active:text-white active:rounded-lg" onclick="selectedWeek()">Week</button>
          {{-- <div class="block h-4 w-[1px] bg-primary-textgray opacity-50"></div> --}}
          <button id="day" class="hover:cursor-pointer h-[35px] w-[30%] flex items-center justify-center active:bg-primary-cyan active:font-semibold active:text-white active:rounded-lg" onclick="selectedDay()">Day</button>
        </div>
      </div>
    </div>


    {{-- table --}}
    <div>
      {{-- row --}}
      @foreach ($invoices as $invoice)

      <div class="h-[50px] mb-8 flex justify-between items-center">
        <div>
          <div class="block bg-primary-darkred w-[3px] h-[50px] rounded-full mr-[33px]"></div>
        </div>
        <div >
          <div class="w-[50px] bg-primary-textgray rounded-xl h-[50px] mr-[42px]"></div>
        </div>
        <div class="flex flex-col w-[500px]">
          <h3 class="font-semibold text-primary-textdark text-sm mb-2">{{ $invoice->username }}</h3>
          <p class="font-light text-primary-textgray text-xs">{{ $invoice->email }}</p>
        </div>
        <div class="text-primary-warmblue text-xs font-semibold w-[320px]">Rp{{ $invoice->total_price }},00</div>
        <div class="font-poppins text-primary-textgray font-light text-xs w-[200px]">{{ $invoice->total_items }}</div>
        <div class="w-[50px]"><x-on-button></x-on-button></div>
        {{-- <div><x-off-button></x-off-button></div> --}}
        <form action="">

          <button type="submit" class="w-[40px]"><x-edit-row></x-edit-row></button>
        </form>

        <form action="{{ route('invoice.deleteRow') }}" method="post">
          @csrf
          <input type="hidden" name="id" id="id" value="{{ $invoice->id }}">
          <button type="submit" id="deleteRow"><x-delete-row></x-delete-row></button>
        </form>
        {{-- <form action="route{{ edit }}" method="post">
          @csrf
          <input type="hidden" name="$invoice_id" value="{{ $invoice->invoice_id }}">
          <input type="submit" class="w-[20px]"><x-delete-row></x-delete-row></input>

        </form> --}}
      </div>
      @endforeach
    </div class="mb-8">

    {{ $invoices->links() }}
  </div>
</div>

<script>
  // $(document).ready(()=>{
  //   $("#deleteRow").click(()=>{

  //     $.ajax({
  //       type:"POST",
  //       url:"{{ route('invoice.deleteRow') }}",
  //       data: {
  //         "_token": "{{ csrf_token() }}",
  //         "id": $("#id").val()
  //       },
  //       success: function(data){
  //         alert(data);
  //       },
  //       error: function(data){
  //         console.log(data);
  //       }
  //     })
  //   })
  // });

  // const deleteRow = () => {
  //   console.log('test');
  //   $.ajax({
  //       type:"POST",
  //       url:"{{ route('invoice.deleteRow') }}",
  //       data: {
  //         "_token": "{{ csrf_token() }}",
  //         "id": $("#id").val()
  //       },
  //       success: function(data){
  //         alert(data);
  //       }
  //       error: function(data){
  //         console.log();(data);
  //       }
  //     })
  // }

</script>
