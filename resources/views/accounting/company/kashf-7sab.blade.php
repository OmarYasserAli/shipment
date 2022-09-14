@extends('layout.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.3/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.3/dist/js/tom-select.complete.min.js"></script>
<div class="content">
    <!-- BEGIN: Top Bar -->
    @include('layout.partial.topbar')
    <!-- END: Top Bar -->
    <div id="msg_modal" class="modal" data-tw-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body px-5 py-10">
                    <div class="text-center">


                          <div class="form-inline" style="font-size: 24px; align-items:center;">
                            <p id='msg_modal_text' style="margin: auto;"></p>
                          </div>
                         <button type="button" data-tw-dismiss="" id='msg_modal_close' class="btn btn-primary w-24 mt-5">استمرار</button>
                        <button type="button" data-tw-dismiss="" id='operation_print' class="btn btn-success w-24 mt-5">طباعه</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Modal Toggle --> <!-- BEGIN: Modal Content -->

<!-- END: Modal Content -->

    <div class="intro-y  grid-cols-12 gap-5 mt-5">
        <!-- BEGIN: Item List -->

        <div class="intro-y col-span-12 lg:col-span-12">
            <form action="">
                <div>
                    <div class="mt-1 grid  grid-cols-3">
                    
                        <input name="web" type="hidden"  value="1">
                    
                </div>
                    <div class="mt-1 grid  grid-cols-3">
                        <div class="col-span-2">
                            <div class="grid grid-cols-3 ">
                                
                                <div class="form-inline">
                                    <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:2px; margin-top:1px; width:30px; ">تاريخ الشحنه </label>
                                    <input name="date_from" type="date"  class="form-control form-select-sm "  aria-label="default input inline 1" style="">
                                    <label for="horizontal-form-1" class="form-label" style=" text-align:right!important; margin-right:3px; margin-left:5px; margin-top:1px;  ">الي</label>
                                    <input name="date_to" type="date"  class="form-control form-select-sm "  aria-label="default input inline 1" style="">
                                </div>
                               

                            </div >
                        </div>

                        <div class="col-span-1">

                        </div>
                    </div>
                    <div class="mt-1 grid  grid-cols-3">
                        <div class="col-span-2">
                            <div class="grid grid-cols-3 ">
                                <div class="form-inline">
                                    <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:10px; margin-top:8px;  width:60px; ">نوع الحساب</label>
                                    <select name="type" class="form-select form-select-sm mr-1 7sab_type" aria-label=".form-select-sm example" style=" width:250px">
                                        <option value="">...</option>
                                        
                                        <option value="عميل"  @if(request()->get('7sab_type') =='عميل') selected @endif>عميل</option>
                                        <option value="مندوب"  @if(request()->get('7sab_type') =='مندوب') selected @endif>مندوب</option>
                                        <option value="فرع"  @if(request()->get('7sab_type') =='فرع') selected @endif>فرع</option>
                                        <option value="اخرى"  @if(request()->get('7sab_type') =='اخرى') selected @endif>اخرى</option>
                                        <option value="مصاريف"  @if(request()->get('7sab_type') =='مصاريف') selected @endif>مصاريف</option>
                                       
                                    </select>
                                </div>
                                <div class="form-inline">
                                    <label for="horizontal-form-1" class="form-label "  style=" text-align:left; margin-left:10px; margin-top:8px;  width:60px; ">الحساب</label>
                                    <select name="owner" class="acc_owner" aria-label=".form-select-sm example" style=" width:250px" id='7san_owner' >
                                        <option value="">...</option>
                                        
                                    </select>
                                </div>
                                <script>
                                  
                                </script>
                                <div class="form-inline">
                                    <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:10px; margin-top:8px;  width:60px; ">نوع السند</label>
                                    <select name="is_solfa" class="form-select form-select-sm mr-1 is_solfa" aria-label=".form-select-sm example" style=" width:250px">
                                        <option value="2">...</option>
                                        <option value="">الكل</option>
                                        
                                        <option value="0"  @if(request()->get('is_solfa') =='0') selected @endif>سند</option>
                                        <option value="1"  @if(request()->get('is_solfa') =='1') selected @endif>سلف</option>
                                       
                                    </select>
                                </div>


                                <div class="form-inline">
                                    <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:10px; margin-top:8px; margin-right:3px ; width:50px"> </label>

                                    <input type="submit"  class="btn btn-primary  "  value="فلتر">
                                    <input type="button"  class="btn btn-success  align-left mr-1" style="direction: ltr"  value="طباعه" id='print' >
                                    

                                </div>
                            </div >
                        </div>

                    </div>
                </div>
            </form>
            <div class="overflow-x-auto mt-5">
                <table class="table table-striped" id="dataTable">
                    <thead class="table-light">
                        <tr>

                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">التاريخ</th>
                            <th class="whitespace-nowrap">الرقم</th>
                            <th class="whitespace-nowrap">نوع الحركة</th>
                            <th class="whitespace-nowrap">نوع الحساب</th>
                            <th class="whitespace-nowrap"> الحساب</th>
                            
                            {{-- <th class="whitespace-nowrap">المتسفيد</th> --}}
                            <th class="whitespace-nowrap">بيان</th>
                            <th class="whitespace-nowrap">حركة دائنة</th>
                            <th class="whitespace-nowrap">حركة مدينة</th>
                            <th class="whitespace-nowrap">رصيد دائن</th>
                            <th class="whitespace-nowrap">رصيد مدين</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=0; $raseed=$safi7sab;
                            $T7rkaDa2en=0;
                            $T7rkaMaden=0;
                            $TrasedDa2en=0;
                            $TrasedMaden=0;
                        @endphp
                        <tr>
                            <td colspan='9'>الرصيد السابق</td>
                            <td>@if($safi7sab < 0 )  {{($safi7sab)*-1}} @else 0 @endif</td>
                            <td>@if($safi7sab > 0 )  {{$safi7sab}} @else 0 @endif</td>
                           
                        
                    </tr>
                        @foreach($sanadat as $sanad)
                        @php 
                             $i++;
                             if($sanad->type =='صرف') {$raseed -= $sanad->amount;}
                             if($sanad->type =='قبض') {$raseed += $sanad->amount;}
                             if($raseed < 0){$da2en= -$raseed;   $madeen = 0;}
                             else{$da2en= 0;   $madeen = $raseed;}
                             $TrasedDa2en = $da2en;
                            $TrasedMaden = $madeen;
                        @endphp
                        <tr   > 

                            <td  class="whitespace-nowrap " ><?php echo $i;?></td>
                            <td  class="whitespace-nowrap " >{{$sanad->created_at }}</td>
                            <td  class="whitespace-nowrap " >{{$sanad->code }}</td>
                            <td class="whitespace-nowrap " >{{$sanad->type}} @if($sanad->is_solfa) سلفة @endif</td>
                            <td class="whitespace-nowrap " >{{$sanad->mostafed_type()}}</td>
                            <td class="whitespace-nowrap " >{{$sanad->sanadable()->first()->name_}}</td>
                            
                            <td class="whitespace-nowrap " >{{$sanad->note}}</td>
                            
                            <td class="whitespace-nowrap " >@if($sanad->type =='صرف')  {{number_format($sanad->amount , 0)}} @php $T7rkaDa2en+= $sanad->amount; @endphp @else 0 @endif</td>
                            <td class="whitespace-nowrap " >@if($sanad->type =='قبض'){{number_format($sanad->amount , 0)}} @php $T7rkaMaden+= $sanad->amount; @endphp @else 0 @endif</td>
                            <td class="whitespace-nowrap " >{{number_format($da2en , 0)}}</td>
                            <td class="whitespace-nowrap " >{{number_format($madeen , 0)}}</td>
                            
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan='7'>الاجمالى</td>
                            <td> {{$T7rkaDa2en}}</td>
                            <td> {{$T7rkaMaden}}</td>
                            <td> {{$TrasedDa2en}}</td>
                            <td> {{$TrasedMaden}}</td>
                           
                        
                        </tr>
                    </tbody>
                </table>
            </div>


        </div>

        <!-- END: Item List -->
        <!-- BEGIN: Ticket -->

        <!-- END: Ticket -->
    </div>
    <!-- BEGIN: New Order Modal -->

    <!-- END: Add Item Modal -->

    <div class="mt-10">

    </div>
    {{-- <div style="background-color:#fff;  opacity: 1;position: fixed; bottom:0px; z-index:999; width:79%;" class="flex h-12 pt-3 rounded ">
        <div class="mr-6" style="margin-left: 10px;">اجمالى مبالغ الشحنات</div>
        <div class="total_cost" style="margin-left: 40px;"><input type="text" disabled class="h-6 w-40" id="total_cost" value="0"></div>
        <div class="f" style="margin-left: 10px;">اجمالى مبالغ التحويل</div>
        <div class="total_tawsil" style="margin-left: 40px;"><input type="text" disabled class="h-6 w-40" id="total_tawsil" value="0"></div>
        <div class=" " style="margin-left: 10px;">اجمالى الصافى</div>
        <div class="total_net" style="margin-left: 40px;"><input type="text" disabled class="h-6 w-40" id='total_net' value="0"></div>
        <div class=" " style="margin-left: 10px;">مجموع عدد الشحنات</div>
        <div class=""> <input type="text" disabled class="h-6 w-16" id="total_cnt" value="0"></div>

        <div style="margin-right:auto; margin-left:10px; margin-bottom:5px;"  class="dropdown inline-block" data-tw-placement="top"> <button class="dropdown-toggle btn btn-primary w-26 mr-1  h-6" aria-expanded="false" data-tw-toggle="dropdown"> اجماليات</button>
            <div class="dropdown-menu w-60">
                <ul class="dropdown-content">
                    <li> <a  class="dropdown-item"><span>{{number_format($sums['totalCost'])}}</span> <span style="margin-left:auto;">مبلغ الشحنات </span></a> </li>
                    <li> <a  class="dropdown-item"><span>{{number_format($sums['tawsilCost'])}}</span>   <span style="margin-left:auto;">أجرة الشركة</span> </a> </li>
                    <li> <a  class="dropdown-item"><span>{{number_format($sums['netCost'])}}</span>   <span style="margin-left:auto;">الصافى</span>   </a> </li>
                    <li> <a  class="dropdown-item"><span>{{number_format($sums['allCount'])}}</span>   <span style="margin-left:auto;">عدد الشحنات</span> </a> </li>



                </ul>
            </div>
        </div>
    </div> --}}
</div>

        <script type="text/javascript">
          var  owner =new TomSelect(".acc_owner",{
                                    	valueField: 'id',
                                    	labelField: 'title',
                                    	searchField: 'title',
                                    	create: false
                                    });
            let opreation_codes=[];

            $('#print').on('click', function(){
                 window.open(window.location.href+'&pdf=1');
            });
            let  shipments=[];
            let cnt=1;

            let current_status=0;
            $( document ).ready(function() {
                $("body").fadeIn(50);
               // const myModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#type_modal"));

                @if(!isset(request()->client_id ))
                    // myModal.show();
                @endif
            });

            // $( "#modal_close" ).click(function() {


            //     current_status=$( "#select_type" ).val();
            //     const myModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#type_modal"));
            //     var noClientFilter = $('#noClientFilter').is(':checked');
            //     let client_id = current_status;
            //     if(noClientFilter ){
            //         myModal.hide();


            //             $("#Commercial_name").html('');
            //             $.ajax({
            //                 url:"{{url('getCommertialnameBy3amil')}}?client_id="+client_id,
            //                 type: "get",
            //                 data: {
            //                     'from':'modal'
            //                 },
            //                 dataType : 'json',
            //                 success: function(result){
            //                 $('#Commercial_name').prop('disabled', false);
            //                 $('#Commercial_name').html('<option value="">...</option>');

            //                 $.each(result.all,function(key,value){
            //                     $("#Commercial_name").append('<option value="'+value.name_+'">'+value.name_+'</option>');
            //                 });
            //                 //$('#city_id').html('<option value="">Select city</option>');
            //                 }
            //             });
            //         }else{
            //             window.location.href = "{{route('accounting.3amil.mosadad')}}?client_id="+client_id;
            //         }
            // });
            // $( "#msg_modal_close" ).click(function() {
            //     const msg_Modal = tailwind.Modal.getOrCreateInstance(document.querySelector("#msg_modal"));
            //     msg_Modal.hide();
            // });
            $( "#qr_new" ).click(function() {
                $('#manteka-table tr').not(function(){ return !!$(this).has('th').length; }).remove();
                    cnt=1;
                    shipments=[];
                $('#shipment_form').find("input[type=text], textarea").val("");
                // const myModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#type_modal"));
                // myModal.show();
            });



                $( "#tanfez" ).click(function() {

                    $.ajax({
                        url: "{{route('shipment.t7wel_qr_save')}}" ,
                        type: 'post',
                        data:{ code:shipments, status:current_status, _token: "{{ csrf_token() }}"},
                        error: function(e){
                            console.log(e);
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
                        //  console.log(qr);
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


                $( "#tasdid" ).click(function() {

                 var codes =[]

                 $('.check_count').each(function() {
                    if($(this).is(':checked')){
                        codes.push($(this).data('code'));
                    }

                });
                    opreation_codes= codes;
                 $.ajax({
                     url: "{{route('accounting.3amil.canceltasdid')}}" ,
                     type: 'post',
                     data:{ code:codes,  _token: "{{ csrf_token() }}"},
                     error: function(e){

                     },
                     success: function(res) {

                         rowsAffected =  codes.length - res['count']
                         msg =" تم تسديد " +res['count']+   " شحنة  "  +" تم رفض " + rowsAffected + " شحنة ";
                         let msg_modal = tailwind.Modal.getOrCreateInstance(document.querySelector("#msg_modal"));
                        $('#msg_modal_text').text(msg)
                         msg_modal.show();
                        let total_cost=parseInt($('#total_cost').val());
                        let total_cnt=parseInt($('#total_cnt').val());
                        let total_tawsil=parseInt($('#total_tawsil').val());
                        let total_net= parseInt($('#total_net').val($('#total_cost').val()-$('#total_tawsil').val()));
                        var i=1;
                        $('.check_count').each(function() {

                            if($(this).is(':checked') && $(this).data('status')==7){

                                total_cnt--;
                                total_cost-= $(this).data('cost');
                                total_tawsil-= parseInt($(this).data('t7wel'));
                                total_net-= $(this).data('net');
                                $('#total_cost').val(total_cost);
                                $('#total_tawsil').val(total_tawsil);
                                $('#total_net').val($('#total_cost').val()-$('#total_tawsil').val());
                                $('#total_cnt').val(total_cnt);

                                $(this).parent().parent().remove();


                            }else{
                                $(this).parent().parent().children('td:first').text(i)
                                i++;

                            }
                      });
                     }
                 });

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

                $('.7sab_type').on('change', function() {

                var type = this.value;
                    $("#7san_owner").html('');
                    $.ajax({
                        url:"{{route('get7sabOwners')}}?type="+type,
                        type: "get",
                        data: {

                        },
                        dataType : 'json',
                        success: function(result){
                        $('#7san_owner').prop('disabled', false);
                        // $('#7san_owner').html('<option value="">...</option>');

                        // $.each(result.data,function(key,value){
                        //     $("#7san_owner").append('<option value="'+value.code_+'">'+value.name_+'</option>');
                        // });

                            console.log();
                      
                         var temp = ''; var f=0;
                         owner.clearOptions();
                          $.each(result.data,function(key,value){
                            if(f==0){
                                f=1;
                              // temp = value.code_;
                            }
                            owner.addOption({
                                id: value.code_,
                                title: value.name_,

                            });
                            owner.setValue(temp);
                          });
                        //$('#city_id').html('<option value="">Select city</option>');
                        }
                    });
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
                    // infinteLoadMore(page);
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
                            <td  class="whitespace-nowrap " >`+value.total_.toLocaleString('en-US')+`</td>
                            <td  class="whitespace-nowrap " >`+value.tawsil_coast_.toLocaleString('en-US')+`</td>
                            <td  class="whitespace-nowrap " >`+value.shipment_coast_.toLocaleString('en-US')+`</td>
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
