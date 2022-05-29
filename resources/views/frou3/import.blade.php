@extends('layout.app')

@section('content')

<div class="content">
    <!-- BEGIN: Top Bar -->
    @include('layout.partial.topbar')
    <!-- END: Top Bar -->
    
    <div class="intro-y  grid-cols-12 gap-5 mt-5">
        <!-- BEGIN: Item List -->
        
        <div class="intro-y col-span-12 lg:col-span-12">
            <div>   
                <div class="mt-1 grid  grid-cols-3">
                    <div class="col-span-2">
                        <div class="grid grid-cols-3 "> 
                            <div class="form-inline ">
                                <label for="horizontal-form-1" class="form-label " style=" text-align:left; margin-left:15px; margin-top:8px;  width:150px; ">الكود</label>
                                <input type="text"  class="form-control form-select-sm "  aria-label="default input inline 1" style="width: 150px;"> 
                            </div>
                            <div class="form-inline">
                                <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:15px; margin-top:8px; width:100px; ">العميل</label>
                                <select class="form-select form-select-sm " aria-label=".form-select-sm example" style=" width:150px">
                                    <option>Chris Evans</option>
                                    <option>Liam Neeson</option>
                                    <option>Daniel Craig</option>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:10px; margin-top:8px;  width:150px; ">الاسم التجاري</label>
                                <select class="form-select form-select-sm " aria-label=".form-select-sm example" style=" width:150px">
                                    <option>Chris Evans</option>
                                    <option>Liam Neeson</option>
                                    <option>Daniel Craig</option>
                                </select>
                            </div>
                        </div > 
                    </div>
                    <div></div>
                </div>
                <div class="mt-1 grid  grid-cols-3">
                    <div class="col-span-2">
                        <div class="grid grid-cols-3 "> 
                            <div class="form-inline ">
                                <label for="horizontal-form-1" class="form-label " style=" text-align:left; margin-left:15px; margin-top:8px;  width:150px; ">رقم التوصيل</label>
                                <input type="text"  class="form-control form-select-sm "  aria-label="default input inline 1" style="width: 150px;"> 
                            </div>
                            <div class="form-inline">
                                <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:15px; margin-top:8px; width:100px; ">هاتف المستلم</label>
                                <input type="text"  class="form-control form-select-sm "  aria-label="default input inline 1" style="width: 150px;"> 
                            </div>
                            <div class="form-inline">
                                <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:10px; margin-top:8px;  width:150px; ">مندوب التسليم</label>
                                <select class="form-select form-select-sm " aria-label=".form-select-sm example" style=" width:150px">
                                    <option>Chris Evans</option>
                                    <option>Liam Neeson</option>
                                    <option>Daniel Craig</option>
                                </select>
                            </div>
                        </div > 
                    </div>
                    <div></div>
                </div>
                <div class="mt-1 grid  grid-cols-3">
                    <div class="col-span-2">
                        <div class="grid grid-cols-3 "> 
                            <div class="form-inline">
                                <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:10px; margin-top:8px;  width:150px; ">مندوب التسليم</label>
                                <select class="form-select form-select-sm " aria-label=".form-select-sm example" style=" width:210px">
                                    <option>Chris Evans</option>
                                    <option>Liam Neeson</option>
                                    <option>Daniel Craig</option>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:10px; margin-top:8px;  width:150px; ">مندوب التسليم</label>
                                <select class="form-select form-select-sm " aria-label=".form-select-sm example" style=" width:200px">
                                    <option>Chris Evans</option>
                                    <option>Liam Neeson</option>
                                    <option>Daniel Craig</option>
                                </select>
                            </div>
                            <div class="form-inline mr-3">
                                <ul>
                                    <li><label for="horizontal-form-1" class="" style=" text-align:left; margin-left:10px; margin-top:8px;  width:100px; ">
                                        <input type="radio" id="javascript" name="fav_language" value="JavaScript">  تاريخ الشحنة </label>
                                    </li>
                                    <li>
                                        <label for="horizontal-form-1" class="" style=" text-align:left; margin-left:10px; margin-top:8px;  width:100px; ">
                                            <input type="radio" id="javascript" name="fav_language" value="JavaScript">  تاريخ الحالة </label>
                                    </li>
                                </ul>
 
                                <input type="date"  class="form-control form-select-sm "  style="width: 150px;">
                               
                            </div>
                        </div > 
                    </div>
                    <div>
                        <label for="horizontal-form-1" class="form-label" style=" text-align:left; margin-left:10px; margin-top:8px; margin-right:3px ; ">الي</label>
                        <input type="date"  class="form-control form-select-sm "  style="width: 150px;">
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto mt-5">
                <table class="table table-striped">
                    <thead class="table-light">
                        <tr>
                            <th class="whitespace-nowrap">الكود</th>
                            <th class="whitespace-nowrap">الفرع</th>
                            <th class="whitespace-nowrap">مكان الشحنه</th>
                            <th class="whitespace-nowrap">رقم الوصل</th>
                            <th class="whitespace-nowrap">تاريخ الشحنه</th>
                            <th class="whitespace-nowrap">الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all->items() as $shipment)
                        <tr>
                            <td class="whitespace-nowrap">{{$shipment->code_}}</td>
                            <td class="whitespace-nowrap">{{$shipment->branch_}}</td>
                            <td class="whitespace-nowrap">{{$shipment->el3nwan}}</td>
                            <td class="whitespace-nowrap">{{$shipment->Wasl_rkm}}</td>
                            <td class="whitespace-nowrap">{{$shipment->tarikh_el7ala}}</td>
                            <td class="whitespace-nowrap">{{$shipment->Shipment_status->name_}}</td>
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
    <div class="mt-5">
        {!! $all->render() !!}
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
          
            </script>
@endsection
