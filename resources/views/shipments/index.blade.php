@extends('layout.app')

@section('content')
<style>
    <?php
        foreach($status_color as $key => $value){
                echo( '.'.$key." > td ". "{" . $settings['status_css_prop']. " : ". $value. '}');
        }
    ?>
    body {
  display: none;
}
</style>
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

    <div id="type_modal" class="modal" data-tw-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body px-5 py-10">
                    <div class="text-center">
                        <div class="mb-5" style="font-size: 25px">اسم مندوب التسليم</div>
                        <div class="form-inline">

                            <select class="form-select form-select-lg sm:mt-2 sm:mr-2 mb-5" id='select_type' aria-label=".form-select-lg example">
                                @foreach($manadeb_taslim as $mandob)
                                <option value="{{$mandob->code_}}">{{$mandob->name_}}</option>
                                @endforeach


                            </select>
                          </div>
                         <button type="button" data-tw-dismiss="" id='modal_close' class="btn btn-primary w-24">استمرار</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- END: Modal Content -->

    <div class="intro-y  grid-cols-12 gap-5 mt-5">
        <!-- BEGIN: Item List -->

        <div class="intro-y col-span-12 lg:col-span-12">
            <form action="" id='filter_form'>
                <div>
                    <div class="mt-1 grid  grid-cols-3">
                    <div class="col-span-2">
                        <div class="grid grid-cols-3 ">
                            <div class="form-inline ">
                                <label for="horizontal-form-1" class="form-label " style=" text-align:left; margin-left:15px; margin-top:8px;  width:60px; ">الكود</label>
                                <input type="text" name="code" class="form-control form-select-sm filterByEnter"  aria-label="default input inline 1" style="width: 150px;" >
                            </div>
                            <div class="form-inline">
                                <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:2px; margin-top:8px; width:30px; ;">تاريخ الحالة</label>
                                <input name="hala_date_from" type="date"  class="form-control form-select-sm "  aria-label="default input inline 1" style="">
                                <label for="horizontal-form-1" class="form-label" style=" text-align:right!important; margin-right:3px; margin-left:5px; margin-top:8px;  ">الي</label>
                                <input name='hala_date_to' type="date"  class="form-control form-select-sm "  aria-label="default input inline 1" style="">
                            </div>
                            @if($type ==4 || $type ==6 || $type ==7)
                            <div class="form-inline 3amil">
                                <label for="horizontal-form-1" class="form-label " style=" text-align:left; margin-left:15px; margin-top:8px;  width:60px; ">مندوب التسليم</label>

                                <select id="mandoub_taslim" name="mandoub_taslim" class="form-select form-select-sm " aria-label=".form-select-sm example" style=" width:244px">
                                    <option value="">...</option>
                                    @foreach($mandoub_taslims as $mandoub_taslim)
                                        <option value="{{$mandoub_taslim->name_}}" @if(request()->get('mandoub_taslim') ==$mandoub_taslim->name_) selected @endif>{{$mandoub_taslim->name_}}</option>
                                    @endforeach

                                </select>

                            </div>
                            @endif

                        </div >
                    </div>
                    <div class="form-inline">


                    </div>
                </div>
                    <div class="mt-1 grid  grid-cols-3">
                        <div class="col-span-2">
                            <div class="grid grid-cols-3 ">
                                <div class="form-inline ">
                                    <label for="horizontal-form-1" class="form-label " style=" text-align:left; margin-left:15px; margin-top:1px;  width:60px; ">هاتف المستلم</label>
                                    <input type="text" name='reciver_phone'  class="form-control form-select-sm filterByEnter"  aria-label="default input inline 1" style="width: 150px;">
                                </div>
                                <div class="form-inline">
                                    <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:2px; margin-top:1px; width:30px; ">تاريخ الشحنه </label>
                                    <input name="date_from" type="date"  class="form-control form-select-sm "  aria-label="default input inline 1" style="">
                                    <label for="horizontal-form-1" class="form-label" style=" text-align:right!important; margin-right:3px; margin-left:5px; margin-top:1px;  ">الي</label>
                                    <input name="date_to" type="date"  class="form-control form-select-sm "  aria-label="default input inline 1" style="">
                                </div>
                                <div class="form-inline">
                                    <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:2px; margin-top:8px; width:30px; ;">اسم العميل </label>

                                    <select class=" form-select-lg sm:mt-2 sm:mr-2  tom-select  w-full" id='client_id' name="client_id" aria-label=".form-select-lg example">
                                        <option value="">...</option>
                                        @foreach($clients as $Commercial_name)
                                            <option value="{{$Commercial_name->name_}}" @if(request()->get('Commercial_name') ==$Commercial_name->name_) selected @endif>{{$Commercial_name->name_}}</option>
                                        @endforeach
                                    </select>

                                </div>



                            </div >
                        </div>

                        <div class="form-inline">
                            <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:10px; margin-top:8px;  width:64px; ">الاسم التجاري</label>
                            <select id="Commercial_name" name="Commercial_name" class="form-select form-select-sm " aria-label=".form-select-sm example" style=" width:244px">
                                <option value="">...</option>
                                @foreach($Commercial_names as $Commercial_name)
                                    <option value="{{$Commercial_name->name_}}" @if(request()->get('Commercial_name') ==$Commercial_name->name_) selected @endif>{{$Commercial_name->name_}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="mt-1 grid  grid-cols-3">
                        <div class="col-span-2">
                            <div class="grid grid-cols-3 ">
                                <div class="form-inline">
                                    <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:10px; margin-top:8px;  width:60px; ">المحافظة</label>
                                    <select name="mo7afza" class="form-select form-select-sm mr-1" aria-label=".form-select-sm example" style=" width:250px">
                                        <option value="">...</option>
                                        @foreach($mo7afazat as $mo7afaza)
                                        <option value="{{$mo7afaza->code}}"  @if(request()->get('mo7afza') ==$mo7afaza->code) selected @endif>{{$mo7afaza->name}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-inline align-left">
                                    <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:10px; margin-top:8px; margin-right:3px ; width:50px"> </label>

                                    <input type="submit"  class="btn btn-primary  "  value="فلتر">
                                    <input type="button"  class="btn btn-success  align-left mr-1" style="direction: ltr"  value="طباعه" id='print' >

                                </div>

                            </div >
                        </div>
                        @if(auth()->user()->type_=='موظف')
                        <div class="form-inline">
                            <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:10px; margin-top:8px; margin-right:3px ; width:250px">تحويل الشحنات الى</label>

                            <select id="t7weel_to" name="t7weel_to" class="form-select form-select-sm align-left" aria-label=".form-select-sm example" style="margin-left:8px; width:244px ; direction: ltr">
                                <option value="">...</option>
                                @foreach($t7weelTo as $element)
                                    <option value="{{$element}}"   >{{$element}}</option>
                                @endforeach

                            </select>
                            <input type="button"  class="btn btn-success  align-left" style="direction: ltr"  value="تحويل المحدد" id='tasdid' >
                        </div>
                        @endif
                    </div>
                </div>
            </form>
            <div class="overflow-x-auto mt-5">
                <table class="table table" id="dataTable">
                    <thead class="table-dark">
                        <tr>

                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">المحافظة</th>
                            <th class="whitespace-nowrap">هاتف المستلم</th>
                            <th class="whitespace-nowrap">الاسم التجارى</th>
                            <th class="whitespace-nowrap">اسم العميل</th>
                            @if($type ==4 || $type ==6 || $type ==7)
                                <th class="whitespace-nowrap">مندوب التسليم</th>
                            @endif
                            <th class="whitespace-nowrap">العنوان</th>
                            <th class="whitespace-nowrap">تاريخ الشحنه</th>
                            <th class="whitespace-nowrap">الفرع</th>
                            <th class="whitespace-nowrap">الصافى</th>
                            @if($type ==4)
                                <th class="whitespace-nowrap">اجره المندوب</th>
                            @else
                                <th class="whitespace-nowrap">اجره الشركه</th>
                            @endif
                            <th class="whitespace-nowrap">مبلغ الشحنه</th>
                                <th class="whitespace-nowrap">الملاحظات</th>
                                <th class="whitespace-nowrap">الكود</th>
                                <th class="whitespace-nowrap"><input type="checkbox" id="checkAll"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1;

                         @endphp

                        @foreach($all as $shipment)
                        @php
                            if($type ==4) $ogra=  $shipment->tas3ir_mandoub_taslim;
                            else $ogra= $shipment->tawsil_coast_;
                        @endphp
                        <tr  class="status_{!!$shipment->Status_!!}_color"   >
                            <td  class="whitespace-nowrap " ><?php echo $i; $i++?></td>
                            <td  class="whitespace-nowrap " >{{$shipment->mo7afza_}}</td>
                            <td class="whitespace-nowrap " >{{$shipment->reciver_phone_}}</td>
                            <td class="whitespace-nowrap " >{{$shipment->commercial_name_}}</td>
                            <td class="whitespace-nowrap " >@if(isset($shipment->client)){{$shipment->client->name_}}
                                 @else {{$shipment->client_name_}}@endif</td>
                            @if($type ==4 || $type ==6 || $type ==7)
                                <td class="whitespace-nowrap">{{$shipment->mandoub_taslim}}</td>
                            @endif
                            <td class="whitespace-nowrap">{{$shipment->el3nwan}}</td>
                            <td class="whitespace-nowrap " >{{$shipment->date_}}</td>
                            <td class="whitespace-nowrap " >{{$shipment->branch_}}</td>
                            <td class="whitespace-nowrap " >{{number_format($shipment->shipment_coast_-$ogra , 0)}}</td>
                            <td class="whitespace-nowrap " >{{number_format($ogra , 0)}}</td>
                            <td class="whitespace-nowrap " >{{number_format($shipment->shipment_coast_ , 0)}}</td>
                            
                            <td class="whitespace-nowrap " >{{$shipment->notes_}}</td>
                            <td class="whitespace-nowrap " >{{$shipment->code_}}</td>
                                    <td class="whitespace-nowrap " ><input type="checkbox" class="check_count" data-cost='{{$shipment->shipment_coast_}}'
                                        data-t7wel='{{$ogra}}' data-net='{{$shipment->shipment_coast_}}' data-code='{{$shipment->code_}}' data-status='{{$shipment->Status_}}'></td>
                        </tr>
                        @endforeach

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
        {{-- {!! $all->render() !!} --}}
    </div>
    <div style="background-color:#fff;  opacity: 1;position: fixed; bottom:0px; z-index:999; width:79%;" class="flex h-12 pt-3 rounded ">
        <div class="mr-6" style="margin-left: 10px;">اجمالى مبالغ الشحنات</div>
        <div class="total_cost" style="margin-left: 40px;"><input type="text" disabled class="h-6 w-40" id="total_cost" value="0"></div>
        <div class="f" style="margin-left: 10px;">@if($type==4)اجمالى أجرةالمندوب @else اجمالى أجرة الشركة @endif</div>
        <div class="total_tawsil" style="margin-left: 40px;"><input type="text" disabled class="h-6 w-40" id="total_tawsil" value="0"></div>
        <div class=" " style="margin-left: 10px;">اجمالى الصافى</div>
        <div class="total_net" style="margin-left: 40px;"><input type="text" disabled class="h-6 w-40" id='total_net' value="0"></div>
        <div class=" " style="margin-left: 10px; margin-right: auto;">مجموع عدد الشحنات</div>
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

    </div>
</div>

        <script type="text/javascript">
             let opreation_codes=[];
             let global_ta7weel_to='';
             $('#print').on('click', function(){
                var codes=[];
                $('.check_count').each(function() {
                        if($(this).is(':checked')){
                            codes.push($(this).data('code'));
                        }
                    });
                $.ajax({
                            url:"{{route('save_print_report')}}",
                            type: "post",
                            data: {
                                'codes':codes,
                                'pdf' :1,
                                'save' :1,
                                '_token' :'{{csrf_token()}}'
                            },
                            success: function(result){
                                window.open(window.location.href.split('?')[0]+'?pdf=1&report='+result.id+'&status={{$type}}');
                            }
                        });
                });
            // $('#print').on('click', function(){
            //     var codes=[];
            //     $('.check_count').each(function() {
            //             if($(this).is(':checked')){
            //                 codes.push($(this).data('code'));
            //             }
            //         });
            //     window.open(window.location.href.split('?')[0]+'?pdf=1&codes='+codes+'&status={{$type}}');
            //    // window.location.replace ();
            // });


            $('#operation_print').on('click',function(){

                
                $.ajax({
                            url:"{{route('save_print_report')}}",
                            type: "post",
                            data: {
                                'codes':opreation_codes,
                                'pdf' :1,
                                'save' :1,
                                '_token' :'{{csrf_token()}}'
                            },
                            success: function(result){
                                if($('#t7weel_to').val()=='الشحنات لدى مندوب التسليم'){
                                    window.open(window.location.href.split('?')[0]+'?pdf=1&report='+result.id+'&status=4&title='+global_ta7weel_to);
                                }else{
                                    window.open(window.location.href.split('?')[0]+'?pdf=1&report='+result.id+'&status={{$type}}&title='+global_ta7weel_to);
                                    //window.open("{{route('opretation-print')}}"+'?codes='+opreation_codes+'&type=shipment&title='+global_ta7weel_to);
                                }
                                
                            }
                        });
                

            })
            

            let  shipments=[];
            let cnt=1;

            let current_status=0;
            $( document ).ready(function() {
                $("body").fadeIn(50);

                // rows_counter()
            });



            $( "#qr_new" ).click(function() {
                $('#manteka-table tr').not(function(){ return !!$(this).has('th').length; }).remove();
                    cnt=1;
                    shipments=[];
                $('#shipment_form').find("input[type=text], textarea").val("");

            });


                $( "#cancel" ).click(function() {
                    $('#manteka-table tr').not(function(){ return !!$(this).has('th').length; }).remove();
                    cnt=1;
                    shipments=[];
                });



                $( "#msg_modal_close" ).click(function() {
                const msg_Modal = tailwind.Modal.getOrCreateInstance(document.querySelector("#msg_modal"));
                msg_Modal.hide();
            });
            $('#t7weel_to').on('change',function(){

                if($('#t7weel_to').val() == 'الشحنات لدى مندوب التسليم'){
                    const myModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#type_modal"));
                    myModal.show();
                }
            })
            $( "#modal_close" ).click(function() {

                $('#mandob').val($( "#select_type option:selected" ).text());
                current_status=$( "#select_type option:selected" ).val();
                const myModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#type_modal"));
                myModal.hide();
            });

            $( "#tasdid" ).click(function() {

                    var codes =[]
                    var t7weel_to = $('#t7weel_to').val();
                    $('.check_count').each(function() {
                        if($(this).is(':checked')){
                            codes.push($(this).data('code'));
                        }
                    });
                    if(t7weel_to =='' || t7weel_to== null) return;
                    global_ta7weel_to= t7weel_to;
                    //console.log(codes)
                    opreation_codes= codes;
                    $.ajax({
                        url: "{{route('shiments.t7weel_manual')}}" ,
                        type: 'post',
                        data:{ code:codes, t7weel_to:t7weel_to, status:current_status, _token: "{{ csrf_token() }}"},
                        error: function(e){
                            console.log(e);
                        },
                        success: function(res) {
                           // console.log(res)
                            rowsAffected =  codes.length - res['count']
                            msg =" تم تحويل " +res['count']+   " شحنة  "  +" تم رفض " + rowsAffected + " شحنة ";
                            let msg_modal = tailwind.Modal.getOrCreateInstance(document.querySelector("#msg_modal"));
                            $('#msg_modal_text').text(msg)
                            msg_modal.show();
                            let total_cost=parseInt($('#total_cost').val());
                            let total_cnt=parseInt($('#total_cnt').val());
                            let total_tawsil=parseInt($('#total_tawsil').val());
                            let total_net= parseInt($('#total_net').val($('#total_cost').val()-$('#total_tawsil').val()));
                            var i=1;
                            $('.check_count').each(function() {

                                if($(this).is(':checked')){
                                    console.log($(this).data('status'));
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
                            console.log($(this))

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
                    // var name = $(this).attr("name");
                    // var val = $(this).val();
                    // window.location.replace("{{Request::url()}}?"+name+"="+val);
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
                        console.log(result);
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
                    url: "{{route('shiments',['type' =>$type])}}"+ "?lodaMore=1&page=" + page+'&'+window.location.search.substr(1),

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
                        var mandoub='';
                        if(value.Status_ ==4) var ogra=  value.tas3ir_mandoub_taslim;
                            else  var ogra= value.tawsil_coast_;
                        if(value.Status_== 7|| value.Status_==6 || value.Status_ ==4)
                         mandoub= '<td  class="whitespace-nowrap " >'+ value.mandoub_taslim+'</td>'

                         if(value.notes_ == null)
                         value.notes_ = ''

                        if (typeof value.client != 'undefined' &&  value.client != null){client = (value.client)['name_'];}else{client =value.client_name_}
                        $('#dataTable   tr:last').after(`<tr  class='status_`+value.Status_+`_color'>
                            <td  class="whitespace-nowrap " >`+cont+`</td>
                            <td  class="whitespace-nowrap " >`+value.mo7afza_+`</td>
                            <td  class="whitespace-nowrap " >`+value.reciver_phone_+`</td>
                            <td  class="whitespace-nowrap " >`+value.commercial_name_+`</td>
                            <td  class="whitespace-nowrap " >`+ client+`</td>
                            `+
                            mandoub

                            +
                            `
                            <td  class="whitespace-nowrap " >`+value.el3nwan+`</td>
                            <td  class="whitespace-nowrap " >`+value.date_+`</td>
                            <td  class="whitespace-nowrap " >`+value.branch_+`</td>
                            <td  class="whitespace-nowrap " >`+(value.shipment_coast_ - ogra).toLocaleString('en-US')+`</td>
                            <td  class="whitespace-nowrap " >`+ogra.toLocaleString('en-US')+`</td>
                            <td  class="whitespace-nowrap " >`+value.shipment_coast_.toLocaleString('en-US')+`</td>
                            <td  class="whitespace-nowrap " >`+value.notes_+`</td>
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
            // function rows_counter(){
            //     $('#rows_counter').val($('#dataTable tr').length-1)
            // }


            </script>
@endsection
