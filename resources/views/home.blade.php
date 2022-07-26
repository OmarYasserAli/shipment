@extends('layout.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="content">
    <!-- BEGIN: Top Bar -->
    @include('layout.partial.topbar')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: General Report -->
               
                <!-- END: General Report -->
                <!-- BEGIN: Sales Report -->
                <div class="col-span-12 lg:col-span-9 mt-8">
                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            شحنات العميل
                        </h2>
                        
                    </div>
                    <div class="intro-y box p-5 mt-12 sm:mt-5">
                        <div class="flex flex-col md:flex-row md:items-center">
                            <div class="flex">
                                <div>
                                    <div class="text-primary dark:text-slate-300 text-lg xl:text-xl font-medium">
                                        <input type="date" class='date_from'> 
                                    </div>
                                    <div class="mt-0.5 text-slate-500">التاريخ من</div>
                                </div>
                                <div class="w-px h-12 border border-r border-dashed border-slate-200 dark:border-darkmode-300 mx-4 xl:mx-5"></div>
                                <div>
                                    <div class="text-slate-500 text-lg xl:text-xl font-medium">
                                        <input type="date" class='date_to'></div>
                                    <div class="mt-0.5 text-slate-500"> التاريخ الي</div>
                                </div>
                            </div>
                            <div class="dropdown md:ml-auto mt-5 md:mt-0">
                                
                                <select data-placeholder="اسم العميل" class="tom-select w-full client_id client_el" id="crud-form-2" >
                                            
                                    @foreach ($clients as  $client)
                                
                                    <option value='{{$client->code_}}'>{{$client->name_}}</option>
                                    @endforeach
                                </select>
                                <div class="mt-0.5 text-slate-500"> اسم العميل</div>
                            </div>
                        </div>
                        <div class="">
                            <div class="h-[475px]">
                                <canvas class="" id="chartBar"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Sales Report -->
                <!-- BEGIN: Weekly Top Seller -->
                <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                           عدد الشحنات اليومية
                        </h2>
                       
                    </div>
                    <div class="intro-y box p-5 mt-5">
                        <div class="mt-3">
                            <div class="h-[213px]">
                                <canvas id="chartPie"></canvas>
                            </div>
                        </div>
                        <div class="w-52 sm:w-auto mx-auto mt-8">
                            <div class="flex items-center">
                                <div class="w-2 h-2  rounded-full mr-3"></div>
                                <span class="truncate">عدد الشحنات اليومية</span> <span class="font-medium ml-auto">{{ $dailyShipments->count()}}</span> 
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- END: Weekly Top Seller -->
                <!-- BEGIN: Sales Report -->
                <input type="hidden" >
                <div class="col-span-12 sm:col-span-8 lg:col-span-3 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            حالات الشحنة اليومية
                        </h2>
                        
                    </div>
                    <div class="intro-y box p-5 mt-5">
                        <div class="mt-3">
                            <div class="h-[213px]">
                                <canvas  id="chartDoughnut"></canvas>
                            </div>
                        </div>
                        <div class="w-52 sm:w-auto mx-auto mt-8">
                            @foreach ($dailyStatus as $key =>$val)
                            
                                <div class="flex items-center mt-4">
                                    <div class="w-2 h-2  rounded-full mr-3" style="background-color: {{$status_color[$key-1]}};"></div>
                                    {{-- <span class="truncate">{{$status[$key]}}</span> <span class="font-medium ml-auto">{{$dailyStatus[$key]}}</span>  --}}
                                </div>
                            @endforeach
                            
                            
                        </div>
                    </div>
                </div>
                
                
                <!-- END: Weekly Best Sellers -->
                <!-- BEGIN: General Report -->
               
                <!-- END: General Report -->
                <!-- BEGIN: Weekly Top Products -->
                
                <!-- END: Weekly Top Products -->
            </div>
        </div>
        
    </div>
</div>
  

</div>

    <script type="text/javascript">

const labelsBarChart = [
   
  ];
  const dataBarChart = {
    labels: labelsBarChart,
    datasets: [
      {
        label: "My First dataset",
        backgroundColor: "hsl(252, 82.9%, 67.8%)",
        borderColor: "hsl(252, 82.9%, 67.8%)",
        data: [ ],
      },
    ],
  };

  const configBarChart = {
    type: "bar",
    data: dataBarChart,
    options: {},
  };

  let chartBarz = new Chart(
    document.getElementById("chartBar"),
    configBarChart
  );
  $('.client_id').on('change',function(){
    var client_id = ($('.client_id').val());
    var date_to = ($('.date_to').val());
    var date_from = ($('.date_from').val());
    
    
    $.ajax({
                            url:"{{url('getclientChartData')}}?client_id="+client_id+'&date_from='+date_from + '&date_to='+date_to,
                            type: "get",
                            data: {

                            },
                            dataType : 'json',
                            success: function(result){
                                chartBarz.destroy();

                                const labelsBarChart = [
                                        
                                    ];

                                let d=[];
                                    $.each(result.data,function(key,value){
                                        labelsBarChart.push(result.statuses[key]); 
                                        d.push(value); 
                                    });
                                   
                                           
                                            console.log(d);
                                    const dataBarChart = {
                                        labels: labelsBarChart,
                                        datasets: [
                                        {
                                            label: "شحنات العميل",
                                            backgroundColor: "hsl(252, 82.9%, 67.8%)",
                                            borderColor: "hsl(252, 82.9%, 67.8%)",
                                            data: d,
                                        },
                                        ],
                                    };

                                    const configBarChart = {
                                        type: "bar",
                                        data: dataBarChart,
                                        options: {},
                                    };

                                     chartBarz = new Chart(
                                        document.getElementById("chartBar"),
                                        configBarChart
                                    );
                                                            
                            }
                        });
})
  /////
    const dataPie = {
            
    datasets: [
      {
        label: "شحنات العميل",
        data: [{{ $dailyShipments->count()}}],
        backgroundColor: [
          "rgb(133, 105, 241)",
          "rgb(164, 101, 241)",
          "rgb(101, 143, 241)",
        ],
        hoverOffset: 4,
      },
    ],
  };

  const configPie = {
    type: "pie",
    data: dataPie,
    options: {},
  };

  var chartBar = new Chart(document.getElementById("chartPie"), configPie);


  const dataDoughnut = {
    
    datasets: [
      {
        label: "My First Dataset",
        data: [
        @foreach ($dailyStatus as $key =>$val)
                {{$dailyStatus[$key]}},
        @endforeach
    ],
        backgroundColor: [
            @foreach ($dailyStatus as $key =>$val)
                '{{$status_color[$key-1]}}',
        @endforeach
         
        ],
        hoverOffset: 4,
      },
    ],
  };

  const configDoughnut = {
    type: "doughnut",
    data: dataDoughnut,
    options: {},
  };

  var chartBar = new Chart(
    document.getElementById("chartDoughnut"),
    configDoughnut
  );
            let  shipments=[];
            let cnt=1;
           
            let current_status=0;
            $( document ).ready(function() {
                $("body").fadeIn(50);
               
            });
            
            $( "#modal_close" ).click(function() {
                
                
                current_status=$( "#select_type" ).val();
                const myModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#type_modal"));
                var noClientFilter = $('#noClientFilter').is(':checked');
                let user_id = current_status;
                
                    myModal.hide();

               
                        
                    window.location.href = "{{route('permissions')}}?user_id="+user_id;
                    
            });
            $( "#msg_modal_close" ).click(function() {
                const msg_Modal = tailwind.Modal.getOrCreateInstance(document.querySelector("#msg_modal"));
                msg_Modal.hide();
            });
            $( "#qr_new" ).click(function() {
                $('#manteka-table tr').not(function(){ return !!$(this).has('th').length; }).remove();
                    cnt=1;
                    shipments=[];
                $('#shipment_form').find("input[type=text], textarea").val("");
                const myModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#type_modal"));
                myModal.show();
            });
             

            
                $( "#tanfez" ).click(function() {
                 
                    $.ajax({
                        url: "{{route('shipment.t7wel_qr_save')}}" ,
                        type: 'post',
                        data:{ code:shipments, status:current_status, _token: "{{ csrf_token() }}"},
                        error: function(e){
                           
                        },
                        success: function(res) {
                            alert('تم التحويل بناح');
                        }
                    });
                     
                });
                $( "#cancel" ).click(function() {
                    $('#manteka-table tr').not(function(){ return !!$(this).has('th').length; }).remove();
                    cnt=1;
                    shipments=[];
                });
                
                $( "#QR" ).keyup(function(e){
                    if(e.keyCode == 13)
                    {
                        var qr = ( $('#QR').val());
                        
                        if(shipments.includes(qr)) return;
                        if(qr=='') return;
                        $.ajax("{{route('getShipmentsByCode')}}"+"?code="+qr+"&status="+current_status+"&case=t7wel_7ala_qr",   // request url
                            {
                            
                                success: function (data, status, xhr) {
                                    
                                    
                                    if(shipments.includes(qr)) return;
                                    shipments.push(qr);
                                   
                                    var res = (data.data)[0];
                                    $('#rakam_tawsel').val(res.code_);
                                    $('#3amel_name').val(res.client_name_);
                                    $('#commercial_name').val(res.commercial_name_);
                                    $('#mostalem_phone').val(res.reciver_phone_);
                                    $('#mo7afza').val(res.mo7afza_);
                                    $('#manteka').val(res.mantqa_);
                                    $('#3nwan').val(res.el3nwan);
                                    $('#cost').val(res.shipment_coast_);
                                    $('#tawsil_cost').val(res.tawsil_coast_);
                                    $('#safi').val(res.total_);
                                
                                
                                    // success callback function
                                    //$('#manteka-table tr').not(function(){ return !!$(this).has('th').length; }).remove();
                                    
                                   
                                        $('#manteka-table   tr:last').after(`<tr class='' >
                                            <td>`+cnt+`</td>
                                            <td>`+res.code_+`</td>
                                            <td >`+(res.client_name_)+`   </td> 
                                            <td >`+(res.reciver_phone_)+`   </td> 
                                            
                                            <td  >`+(res.mo7afza_)+`</td>
                                            <td  >`+(res.shipment_coast_)+`</td>
                                        <td>
                                        
                                            </td>
                                            </tr>`
                                            );
                                            cnt++;
                            },
                            error: function (request, status, error) {
                                alert("خطأ فى ادخال الشحنة");
                            }
                        });
                    }
                });

                
                
               
    


                    
             $(document).on('change', '.check_count', function(){ 
                
                let total_cost=parseInt($('#total_cost').val());
                let total_cnt=parseInt($('#total_cnt').val());
                let total_tawsil=parseInt($('#total_tawsil').val());
                let total_net= parseInt($('#total_net').val($('#total_cost').val()-$('#total_tawsil').val()));
                if($(this).is(':checked'))
                {
                    total_cnt++;
                    total_cost+= $(this).data('cost');
                    total_tawsil+= parseInt($(this).data('t7wel'));
                    total_net+= $(this).data('net');
                }
                else 
                {
                    total_cnt--;
                    total_cost-= $(this).data('cost');
                    total_tawsil-= parseInt($(this).data('t7wel'));
                    total_net-= $(this).data('net');
                }
                $('#total_cost').val(total_cost);
                $('#total_tawsil').val(total_tawsil);
                $('#total_net').val($('#total_cost').val()-$('#total_tawsil').val());
                $('#total_cnt').val(total_cnt);
         });
                

                    $("#checkAll").click(function(){
                        $('.wasel_goz2y').css("background-color", "yellow");
                       // $('table tbody input:checkbox').not(this).prop('checked', this.checked);
                        let total_cost=parseInt($('#total_cost').val());
                        let total_cnt=parseInt($('#total_cnt').val());
                        let total_tawsil=parseInt($('#total_tawsil').val());
                        let total_net= parseInt($('#total_net').val($('#total_cost').val()-$('#total_tawsil').val()));

                        if($(this).is(':checked'))
                            var items=$('table tbody input:checkbox:not(:checked)')  
                        else
                            var items= $('table tbody input:checkbox:checked') 
                            items.each(function(){
                               
                            
                        if(!$(this).is(':checked'))
                        {
                            total_cnt++;
                            total_cost+= parseInt($(this).data('cost'));
                            total_tawsil+= parseInt($(this).data('t7wel'));
                            total_net+= parseInt($(this).data('net'));
                            $(this).prop('checked', 1);
                        }
                        else 
                        {
                            total_cnt--;
                            total_cost-= $(this).data('cost');
                            total_tawsil-= parseInt($(this).data('t7wel'));
                            total_net-= $(this).data('net');
                            $(this).prop('checked', 0);
                        }
                        

                        });
                        $('#total_cost').val(total_cost);
                        $('#total_tawsil').val(total_tawsil);
                        $('#total_net').val($('#total_cost').val()-$('#total_tawsil').val());
                        $('#total_cnt').val(total_cnt);
                });
                        
                $( ".filterByEnter" ).keyup(function(e){
                    if(e.keyCode == 13)
                    {
                        $('#filter_form').submit();
                    }
                });

                $('#client_id').on('change', function() {
                  
                    var client_id = this.value;
                        $("#Commercial_name").html('');
                        $.ajax({
                            url:"{{url('getCommertialnameBy3amil')}}?client_id="+client_id,
                            type: "get",
                            data: {
                                
                            },
                            dataType : 'json',
                            success: function(result){
                            $('#Commercial_name').prop('disabled', false);
                            $('#Commercial_name').html('<option value="">...</option>');
                            
                            $.each(result.all,function(key,value){
                                $("#Commercial_name").append('<option value="'+value.name_+'">'+value.name_+'</option>');
                            });
                            //$('#city_id').html('<option value="">Select city</option>'); 
                            }
                        });
                });    

            var page = 0;
            let cont=0;
       
            $(window).scroll(function () {
                if ($(window).scrollTop() + $(window).height() +1    >= $(document).height()) {
                    page++;
                    cont=$('#dataTable   tr:last td:first-child').text();
                    infinteLoadMore(page);
                }
            });
            function infinteLoadMore(page) {
                $.ajax({
                    url: "{{route('accounting.3amil.mosadad')}}"+ "?lodaMore=1&page=" + page+'&'+window.location.search.substr(1),
                
                    type: "get",
                    beforeSend: function () {
                        
                    }
                })
                .done(function (response) {
                    if (response.length == 0) {
                    
                        return;
                    }
                    $.each(response.data,function(key,value){
                        console.log(value.client);
                        cont++;
                        var client = '';
                        if (typeof value.client != 'undefined' &&  value.client != null){client = (value.client)['name_'];}else{client =value.client_name_}
                        $('#dataTable   tr:last').after(`<tr  class='status_`+value.Status_+`_color'>
                            <td  class="whitespace-nowrap " >`+cont+`</td>
                            <td  class="whitespace-nowrap " >`+value.mo7afza_+`</td>
                            <td  class="whitespace-nowrap " >`+value.reciver_phone_+`</td>
                            <td  class="whitespace-nowrap " >`+value.commercial_name_+`</td>
                            <td  class="whitespace-nowrap " >`+ client+`</td>
                            <td  class="whitespace-nowrap " >`+value.date_+`</td> 
                            <td  class="whitespace-nowrap " >`+value.tarikh_tasdid_el3amil+`</td> 
                            <td  class="whitespace-nowrap " >`+value.branch_+`</td>
                            <td  class="whitespace-nowrap " >`+value.total_+`</td>
                            <td  class="whitespace-nowrap " >`+value.tawsil_coast_+`</td>
                            <td  class="whitespace-nowrap " >`+value.shipment_coast_+`</td>
                            <td  class="whitespace-nowrap " >`+value.code_+`</td>
                            <td class="whitespace-nowrap " ><input type="checkbox" class="check_count" data-cost='`+value.shipment_coast_+`'
                                        data-t7wel='`+value.tawsil_coast_+`' data-net='`+value.shipment_coast_+`' data-code='`+value.code_+`' data-status='`+value.Status_+`'></td>                
                                            </tr>`
                            );

                            
                            //rows_counter()
                    });
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
            }

               
            </script>
@endsection
