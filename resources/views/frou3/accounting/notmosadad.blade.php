@extends('layout.app')

@section('content')

<div class="content">
    <!-- BEGIN: Top Bar -->
    @include('layout.partial.topbar')
    <!-- END: Top Bar -->
    
    <div class="intro-y  grid-cols-12 gap-5 mt-5">
        <!-- BEGIN: Item List -->
        
        <div class="intro-y col-span-12 lg:col-span-12">
            <form action="">
                <div>   
                    <div class="mt-1 grid  grid-cols-3">
                        <div class="col-span-2">
                            <div class="grid grid-cols-3 "> 
                                <div class="form-inline ">
                                    <label for="horizontal-form-1" class="form-label " style=" text-align:left; margin-left:15px; margin-top:8px;  width:150px; ">الكود</label>
                                    <input type="text"  class="form-control form-select-sm "  aria-label="default input inline 1" style="width: 150px;"> 
                                </div>
                                <div class="form-inline">
                                    <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:15px; margin-top:8px; width:100px; ">تاريخ الشحنه</label>
                                    <input type="date"  class="form-control form-select-sm "  aria-label="default input inline 1" style="width: 150px;"> 
                                
                                </div>
                                <div class="form-inline">
                                    <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:10px; margin-top:8px;  width:30px; ">الي</label>
                                    <input type="date"  class="form-control form-select-sm "  aria-label="default input inline 1" style="width: 100px;"> 
                                    
                                </div>
                            </div > 
                        </div>
                        <div>
                            <div class="form-inline">
                                <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:10px; margin-top:8px;  width:150px; " >الفرع</label>
                                <select name="branch" class="form-select form-select-sm " aria-label=".form-select-sm example" style=" width:150px" @if(auth()->user()->branch !='الفرع الرئيسى') disabled @endif>
                                    <option value="">...</option>
                                    @foreach($branches as $branch)
                                    <option value="{{$branch->name_}}" @if($brach_filter ==$branch->name_) selected @endif>{{$branch->name_}}</option>
                                @endforeach
                                </select>
                               
                            </div>
                        </div>
                    </div>
                    <div class="mt-1 grid  grid-cols-3">
                        <div class="col-span-2">
                            <div class="grid grid-cols-3 "> 
                                <div class="form-inline ">
                                    <label for="horizontal-form-1" class="form-label " style=" text-align:left; margin-left:15px; margin-top:8px;  width:150px; ">رقم الوصل</label>
                                    <input type="text"  class="form-control form-select-sm "  aria-label="default input inline 1" style="width: 150px;"> 
                                </div>
                                <div class="form-inline">
                                    <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:15px; margin-top:8px; width:100px; ">تاريخ الحالة</label>
                                    <input type="date"  class="form-control form-select-sm "  aria-label="default input inline 1" style="width: 150px;"> 
                                
                                </div>
                                <div class="form-inline">
                                    <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:10px; margin-top:8px;  width:30px; ">الي</label>
                                    <input type="date"  class="form-control form-select-sm "  aria-label="default input inline 1" style="width: 100px;"> 
                                    
                                </div>
                            </div > 
                        </div>
                        <div>
                            <div class="flex justify-center">
                                <div class="form-check form-switch">
                                    <label class="form-check-label inline-block text-gray-800" for="flexSwitchCheckChecked">@if($waselOnly) شحنات الواصل @else كل الشحنات @endif </label>
                                  <input class="form-check-input appearance-none w-9 -ml-10 rounded-full float-left h-5 align-top bg-white bg-no-repeat bg-contain bg-gray-300 focus:outline-none cursor-pointer shadow-sm" 
                                  type="checkbox" role="switch" id="flexSwitchCheckChecked" name="waselOnly" @if($waselOnly) checked @endif onchange="this.form.submit()">
                                </div>
                              </div>
                        </div>
                    </div>
                    <div class="mt-1 grid  grid-cols-3">
                        <div class="col-span-2">
                            <div class="grid grid-cols-3 "> 
                                <div class="form-inline">
                                    <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:10px; margin-top:8px;  width:150px; ">المحافظة</label>
                                    <select name="mo7afza" class="form-select form-select-sm " aria-label=".form-select-sm example" style=" width:150px">
                                        <option value="">...</option>
                                        @foreach($mo7afazat as $mo7afaza)
                                        <option value="{{$mo7afaza->code}}"  @if(request()->get('mo7afza') ==$mo7afaza->code) selected @endif>{{$mo7afaza->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-inline mr-3">
                                    <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:10px; margin-top:8px; margin-right:3px ; ">هاتف المستلم</label>
                                    <input type="text"  class="form-control form-select-sm "  style="width: 150px;">
                                    
                                </div>
                                <div class="form-inline">
                                    <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:10px; margin-top:8px; margin-right:3px ; width:50px"> </label>

                                    <input type="submit"  class="btn btn-primary  "  value="فلتر">
                                    
                                </div>
                            </div > 
                        </div>
                        <div>
                            <div class="form-inline">
                                <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:10px; margin-top:8px;  width:150px; "> </label>
                                <input type="button"  class="btn btn-success  "  value="تسديد المحدد" id='tasdid'>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="overflow-x-auto mt-5">
                <table class="table table-striped">
                    <thead class="table-light">
                        <tr>
                                    
                            <th class="whitespace-nowrap">المحافظة</th>
                            <th class="whitespace-nowrap">هاتف المستلم</th>
                            <th class="whitespace-nowrap">الاسم التجارى</th>
                            <th class="whitespace-nowrap">تاريخ الشحنه</th>
                            <th class="whitespace-nowrap">الفرع</th>
                            <th class="whitespace-nowrap">الصافى</th>
                            <th class="whitespace-nowrap">اجره التحويل</th>
                            <th class="whitespace-nowrap">مبلغ الشحنه</th>
                                    <th class="whitespace-nowrap">الكود</th>
                                    <th class="whitespace-nowrap"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all->items() as $shipment)
                        <tr>
                            <td class="whitespace-nowrap">{{$shipment->mo7afza_}}</td>
                            <td class="whitespace-nowrap">{{$shipment->reciver_phone_}}</td>
                            <td class="whitespace-nowrap">{{$shipment->commercial_name_}}</td>
                            <td class="whitespace-nowrap">{{$shipment->tarikh_el7ala}}</td>
                            <td class="whitespace-nowrap">{{$shipment->branch_}}</td>
                            <td class="whitespace-nowrap">{{$shipment->shipment_coast_- $shipment->t7weel_cost}}</td>
                            <td class="whitespace-nowrap">{{$shipment->t7weel_cost}}</td>
                            <td class="whitespace-nowrap">{{$shipment->shipment_coast_}}</td>
                            <td class="whitespace-nowrap">{{$shipment->code_}}</td>
                                    <td class="whitespace-nowrap"><input type="checkbox" class="check_count" data-cost='{{$shipment->shipment_coast_}}'
                                        data-t7wel='{{$shipment->t7weel_cost}}' data-net='{{$shipment->shipment_coast_}}' data-code='{{$shipment->code_}}'></td>
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
        {!! $all->render() !!}
    </div>
    <div style="background-color:#fff;  opacity: 1;position: fixed; bottom:0px; z-index:999; width:79%;" class="flex h-12 pt-3 rounded ">
        <div class="mr-6" style="margin-left: 10px;">اجمالى مبالخ الشحنات</div>
        <div class="total_cost" style="margin-left: 40px;"><input type="text" disabled class="h-6 w-40" id="total_cost"></div>
        <div class="f" style="margin-left: 10px;">اجمالى مبالغ التحويل</div>
        <div class="total_t7wel" style="margin-left: 40px;"><input type="text" disabled class="h-6 w-40" id="total_t7wel"></div>
        <div class=" " style="margin-left: 10px;">اجمالى الصافى</div>
        <div class="total_net" style="margin-left: 40px;"><input type="text" disabled class="h-6 w-40" id='total_net'></div>
        <div class=" " style="margin-left: 10px;">مجموع عدد الشحنات</div>
        <div class=""> <input type="text" disabled class="h-6 w-16" id="total_cnt"></div>
    </div>
</div>

        <script type="text/javascript">
            let  shipments=[];
            let cnt=1;
           
            let current_status=0;
            $( document ).ready(function() {
                const myModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#type_modal"));
                 myModal.show();
            });
            
            $( "#modal_close" ).click(function() {
                
                $('#type').val($( "#select_type option:selected" ).text());
                current_status=$( "#select_type option:selected" ).val();
                const myModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#type_modal"));
                myModal.hide();
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
                                    //sconsole.log(shipments.includes(qr) ,shipments);
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
                                    
                                    console.log((data.data)[0]);
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
                 console.log($('.check_count'));
                 $('.check_count').each(function() {
                    if($(this).is(':checked')){
                        codes.push($(this).data('code'));
                    }
                });
                 $.ajax({
                     url: "{{route('frou3.accounting.tasdid')}}" ,
                     type: 'post',
                     data:{ code:codes,  brach_filter:'{{$brach_filter}}',  _token: "{{ csrf_token() }}"},
                     error: function(e){
                         console.log(e);
                     },
                     success: function(res) {
                         alert('تم التسديد');
                         $('.check_count').each(function() {
                            if($(this).is(':checked')){
                                $(this).parent().parent().remove();
                            }
                      });
                     }
                 });
                  
             });


                let total_cost=0;
                let total_cnt=0;
                let total_t7wel=0;
                let total_net=0;
                $( ".check_count" ).change(function(e){  
                    if($(this).is(':checked'))
                    {
                        total_cnt++;
                        total_cost+= $(this).data('cost');
                        total_t7wel+= parseInt($(this).data('t7wel'));
                        total_net+= $(this).data('net');
                    }
                    else 
                    {
                        total_cnt--;
                        total_cost-= $(this).data('cost');
                        total_t7wel-= parseInt($(this).data('t7wel'));
                        total_net-= $(this).data('net');
                    }
                    $('#total_cost').val(total_cost);
                    $('#total_t7wel').val(total_t7wel);
                    $('#total_net').val($('#total_cost').val()-$('#total_t7wel').val());
                    $('#total_cnt').val(total_cnt);
                });
                
          
            </script>
@endsection
