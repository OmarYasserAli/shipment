@extends('layout.app')

@section('content')
<style>
    <?php
        foreach($status_color as $key => $value){
            echo ".{$key}>td { $css_prop : $value !important;}";
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
    <!-- END: Modal Toggle --> <!-- BEGIN: Modal Content -->
<div id="type_modal" class="modal" data-tw-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body px-5 py-10">
                <div class="text-center">
                    <div class="mb-5" style="font-size: 25px">الفرع</div>
                    <div class="form-inline">

                        <select class=" form-select-lg sm:mt-2 sm:mr-2 mb-5 tom-select  w-full" id='select_type' aria-label=".form-select-lg example" @if($user->branch !='الفرع الرئيسى')disabled @endif>
                            @foreach ($branches as $branch)
                             <option value="{{$branch->serial_}}">{{$branch->name_}}</option>
                             @endforeach
                        </select>

                      </div>
                      <div class="form-inline" style="font-size: 24px;">
                        {{-- <label for="horizontal-form-1" class="form-label" style=" text-align:right; margin-left:15px; margin-top:1px; width:320px; ">اظهار الكل</label>
                        <input type="checkbox" class="" id='noClientFilter'> --}}

                      </div>
                     <button type="button" data-tw-dismiss="" id='modal_close' class="btn btn-primary w-24 mt-5">استمرار</button>
                     <button type="button" data-tw-dismiss="" id='msg_modal_cancel' class="btn btn-warning w-24 mt-5">الغاء</button>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Modal Content -->

    <div class="intro-y  grid-cols-12 gap-5 mt-5">
        <!-- BEGIN: Item List -->

        <div class="intro-y col-span-12 lg:col-span-12">
            <form action="">
                <div>
                    <div class="mt-1 grid  grid-cols-3">
                    <div class="col-span-2">
                        <div class="grid grid-cols-3 ">
                            <div class="form-inline ">
                                <label for="horizontal-form-1" class="form-label " style=" text-align:left; margin-left:15px; margin-top:8px;  width:60px; ">الكود</label>
                                <input type="text" name="code" class="form-control form-select-sm filterByEnter"  aria-label="default input inline 1" style="width: 150px;" >
                            </div>
                            <div class="form-inline">
                                <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:2px; margin-top:8px; width:30px; ;">تاريخ التسديد</label>
                                <input name="tasdid_date_from" type="date"  class="form-control form-select-sm "  aria-label="default input inline 1" style="">
                                <label for="horizontal-form-1" class="form-label" style=" text-align:right!important; margin-right:3px; margin-left:5px; margin-top:8px;  ">الي</label>
                                <input name='tasdid_date_to' type="date"  class="form-control form-select-sm "  aria-label="default input inline 1" style="">
                            </div>
                            {{-- <div class="form-inline 3amil">
                                <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:15px; margin-top:1px; width:30px; ">العميل</label>

                                <input type="hidden" id='branch_' value="@if(request()->get('branch_')!= null){{request()->get('branch_')}}@else الكل @endif" name='branch_'>
                                    <div class="mr-6 alert alert-outline-secondary alert-dismissible show flex items-center mb-2" role="alert">
                                        @if(request()->get('branch_')!= null)
                                            {{request()->get('branch_')}}

                                       @endif
                                       @if(request()->get('branch_') == null)الكل@endif
                                        <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="Close" onclick="window.location.replace('{{route('accounting.notmosadad')}}')">
                                            <i data-lucide="x" class="w-4 h-4"></i> </button>
                                    </div>
                            </div> --}}

                        </div >
                    </div>
                    <div class="col-span-1">
                        <div class="flex justify-center">
                            <div class="form-check form-switch">
                                <label class="form-check-label inline-block text-gray-800" for="flexSwitchCheckChecked" style="width:400px; text-align:left; ">@if($waselOnly) شحنات الواصل @else كل الشحنات @endif </label>
                              <input class="form-check-input appearance-none w-9 -ml-10 rounded-full float-left h-5 align-top bg-white bg-no-repeat bg-contain bg-gray-300 focus:outline-none cursor-pointer shadow-sm"
                              type="checkbox" role="switch" id="flexSwitchCheckChecked" name="waselOnly" @if($waselOnly) checked @endif onchange="this.form.submit()">
                            </div>
                          </div>
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
                                    <input name="hala_date_from" type="date"  class="form-control form-select-sm "  aria-label="default input inline 1" style="">
                                    <label for="horizontal-form-1" class="form-label" style=" text-align:right!important; margin-right:3px; margin-left:5px; margin-top:1px;  ">الي</label>
                                    <input name="hala_date_to" type="date"  class="form-control form-select-sm "  aria-label="default input inline 1" style="">
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
                                    <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:10px; margin-top:8px;  width:60px; ">المحافظة</label>
                                    <select name="mo7afza" class="form-select form-select-sm mr-1" aria-label=".form-select-sm example" style=" width:250px">
                                        <option value="">...</option>
                                        @foreach($mo7afazat as $mo7afaza)
                                        <option value="{{$mo7afaza->code}}"  @if(request()->get('mo7afza') ==$mo7afaza->code) selected @endif>{{$mo7afaza->name}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-inline">
                                    <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:10px; margin-top:8px; margin-right:3px ; width:50px"> </label>

                                    <input type="submit"  class="btn btn-primary  "  value="فلتر">

                                </div>
                            </div >
                        </div>
                        <div>

                                <div class="form-inline align-left">
                                    <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:10px; margin-top:8px;  width:400px; "> </label>
                                    <input type="button"  class="btn btn-success  align-left" style="direction: ltr"  value="تحويل المحدد" id='tasdid' >

                                </div>

                        </div>
                    </div>
                </div>
            </form>
            <div class="overflow-x-auto mt-5">
                <table class="table table-striped" id="dataTable">
                    <thead class="table-light">
                        <tr>

                            <th class="whitespace-nowrap">#</th>
                            <th class="whitespace-nowrap">المحافظة</th>
                            <th class="whitespace-nowrap">هاتف المستلم</th>
                            <th class="whitespace-nowrap">الاسم التجارى</th>
                            <th class="whitespace-nowrap">اسم العميل</th>
                            <th class="whitespace-nowrap">تاريخ الشحنه</th>

                            <th class="whitespace-nowrap">الفرع</th>
                            <th class="whitespace-nowrap">مكان الشحنة</th>
                            <th class="whitespace-nowrap">الصافى</th>

                            <th class="whitespace-nowrap">مبلغ الشحنه</th>
                                    <th class="whitespace-nowrap">الكود</th>
                                    <th class="whitespace-nowrap"><input type="checkbox" id="checkAll"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach($all as $shipment)

                        <tr  class="status_{!!$shipment->Status_!!}_color"   >
                            <td  class="whitespace-nowrap " ><?php echo $i; $i++?></td>
                            <td  class="whitespace-nowrap " >{{$shipment->mo7afza_}}</td>
                            <td class="whitespace-nowrap " >{{$shipment->reciver_phone_}}</td>
                            <td class="whitespace-nowrap " >{{$shipment->commercial_name_}}</td>
                            <td class="whitespace-nowrap " >@if(isset($shipment->client)){{$shipment->client->name_}} @else {{$shipment->client_name_}}@endif</td>
                            <td class="whitespace-nowrap " >{{$shipment->date_}}</td>

                            <td class="whitespace-nowrap " >{{$shipment->branch_}}</td>
                            <td class="whitespace-nowrap " >{{$shipment->Ship_area_}}</td>
                            <td class="whitespace-nowrap " >{{$shipment->total_}}</td>

                            <td class="whitespace-nowrap " >{{$shipment->shipment_coast_}}</td>
                            <td class="whitespace-nowrap " >{{$shipment->code_}}</td>
                                    <td class="whitespace-nowrap " ><input type="checkbox" class="check_count" data-cost='{{$shipment->shipment_coast_}}'
                                        data-t7wel='{{$shipment->t7weel_cost}}' data-net='{{$shipment->shipment_coast_}}' data-code='{{$shipment->code_}}' data-status='{{$shipment->Status_}}'></td>
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

    </div>
    <div style="background-color:#fff;  opacity: 1;position: fixed; bottom:0px; z-index:999; width:79%;" class="flex h-12 pt-3 rounded ">
        <div class="mr-6" style="margin-left: 10px;">اجمالى مبالغ الشحنات</div>
        <div class="total_cost" style="margin-left: 40px;"><input type="text" disabled class="h-6 w-40" id="total_cost" value="0"></div>

        <div class=" " style="margin-left: 10px;">مجموع عدد الشحنات</div>
        <div class=""> <input type="text" disabled class="h-6 w-16" id="total_cnt" value="0"></div>

        <div style="margin-right:auto; margin-left:10px; margin-bottom:5px;"  class="dropdown inline-block" data-tw-placement="top"> <button class="dropdown-toggle btn btn-primary w-26 mr-1  h-6" aria-expanded="false" data-tw-toggle="dropdown"> اجماليات</button>
            <div class="dropdown-menu w-60">
                <ul class="dropdown-content">
                    <li> <a  class="dropdown-item"><span>{{$sums['totalCost']}}</span> <span style="margin-left:auto;">مبلغ الشحنات </span></a> </li>
                    <li> <a  class="dropdown-item"><span>{{$sums['allCount']}}</span>   <span style="margin-left:auto;">عدد الشحنات</span> </a> </li>



                </ul>
            </div>
        </div>
    </div>
</div>

        <script type="text/javascript">
            let opreation_codes=[];
            var branch_data = '';
            $('#operation_print').on('click', function(){
                
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
                                
                                window.open("{{route('opretation-print')}}"+'?report='+result.id+'&brach_filter='+branch_data+'&type=fro3&title='+'تحويل راجع الى فرع');

                            }
                        });
                });
            

            let  shipments=[];
            let cnt=1;

            let current_status=0;
            $( document ).ready(function() {
                $("body").fadeIn(50);


            });

            // $( "#modal_close" ).click(function() {


            //     current_status=$( "#select_type" ).val();
            //     const myModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#type_modal"));
            //     var noClientFilter = $('#noClientFilter').is(':checked');
            //     let branch_ = current_status;
            //     if(noClientFilter ){
            //         myModal.hide();


            //             $("#Commercial_name").html('');

            //         }else{
            //             window.location.href = "{{route('accounting.notmosadad')}}?branch_="+branch_;
            //         }
            // });
            $( "#msg_modal_close" ).click(function() {
                const msg_Modal = tailwind.Modal.getOrCreateInstance(document.querySelector("#msg_modal"));
                msg_Modal.hide();
            });


                $( "#msg_modal_cancel" ).click(function() {
                    const myModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#type_modal"));
                    myModal.hide();

                });


                $( "#tasdid" ).click(function() {
                    if($('.check_count:checked').length <1) return;
                    const myModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#type_modal"));
                    myModal.show();
                });
                $( "#modal_close" ).click(function() {
                    const myModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#type_modal"));
                    var brach_filter = $( "#select_type" ).val();
                    myModal.hide();
                    var codes =[]

                    $('.check_count').each(function() {
                        if($(this).is(':checked')){
                            codes.push($(this).data('code'));
                        }
                    });
                    opreation_codes= codes;
                    branch_data = brach_filter;
                    $.ajax({
                        url: "{{route('frou3_t7wel_rag3_manual_save')}}" ,
                        type: 'post',
                        data:{ code:codes,  _token: "{{ csrf_token() }}" ,status:brach_filter},
                        error: function(e){
                            console.log(e);
                        },
                        success: function(res) {

                            rowsAffected =  codes.length - res['count']
                            msg =" تم تحويل " +res['count']+   " شحنة  "  ;
                            let msg_modal = tailwind.Modal.getOrCreateInstance(document.querySelector("#msg_modal"));
                            $('#msg_modal_text').text(msg)
                            msg_modal.show();
                            let total_cost=parseInt($('#total_cost').val());
                            let total_cnt=parseInt($('#total_cnt').val());
                            let total_tawsil=parseInt($('#total_tawsil').val());
                            let total_net= parseInt($('#total_net').val($('#total_cost').val()-$('#total_tawsil').val()));
                            var i=1;
                            $('.check_count').each(function() {
                                //
                                if($(this).is(':checked')  && $(this).data('status')==9){
                                   // console.log($(this).data('status'));
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
                    },
                    error: function(jqXHR,error, errorThrown) {
                            if(jqXHR.status==403){
                                alert('لا يمكن تحويل الشحنه الى نفس الفرع')
                            }
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
                    url: "{{route('frou3_t7wel_rag3_manual')}}"+ "?lodaMore=1&page=" + page+'&'+window.location.search.substr(1),

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

                            <td  class="whitespace-nowrap " >`+value.branch_+`</td>
                            <td  class="whitespace-nowrap " >`+value.total_+`</td>
                            <td  class="whitespace-nowrap " >`+value.t7weel_cost+`</td>
                            <td  class="whitespace-nowrap " >`+value.shipment_coast_+`</td>
                            <td  class="whitespace-nowrap " >`+value.code_+`</td>
                            <td class="whitespace-nowrap " ><input type="checkbox" class="check_count" data-cost='`+value.shipment_coast_+`'
                                        data-t7wel='`+value.t7weel_cost+`' data-net='`+value.shipment_coast_+`' data-code='`+value.code_+`' data-status='`+value.Status_+`'></td>
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
