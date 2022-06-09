@extends('layout.app')

@section('content')
<div class="content">
                <!-- BEGIN: Top Bar -->
                @include('layout.partial.topbar')
                <!-- END: Top Bar -->
                
                <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
                    <!-- BEGIN: Post Content -->
                    <div class="intro-y col-span-12 lg:col-span-8">
                        
                        <div class="post intro-y overflow-hidden box mt-5">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <p><strong>Opps Something went wrong</strong></p>
                                    <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="post__content tab-content">
                                <form action="{{route('shiments.store')}}" method="POST">
                                    @csrf;
                                    <div id="content" class="tab-pane p-5 active" role="tabpanel" aria-labelledby=	"content-tab">
                                    <div class="form-inline">
                                        <label for="date" class="form-label sm:w-20">التاريخ</label>
                                        <input type="text" name="date" class="form-control"   value="{{$now}}" disabled> 
                                       
                                    </div>
                                    @if($code_ai)
                                    <div class="form-inline mt-3">
                                        <label for="rakam-wasl" class="form-label sm:w-20">رقم الوصل</label>
                                        <input id="rakam-wasl" type="text" class="form-control"  />
                                    </div>
                                    @endif
                                    <div class="form-inline mt-3">
                                        <label for="3amil-name" class="form-label sm:w-20">اسم العميل</label>
                                        <select class="form-control  tom-select  w-full" id='client_id' name="client_id">
                                            @foreach ($clients as $client)
                                             <option value="{{$client->code_}}">{{$client->name_}}</option>
                                             @endforeach
                                        </select>
                                    </div>
                                    <div class="form-inline mt-3">
                                        <label for="commercial-name" class="form-label sm:w-20 ">الاسم التجارى</label>
                                        <select class="form-control tom-select  w-full" id='Commercial_name' name="Commercial_name" >
                                             
                                             
                                        </select>
                                    </div>
                                    <div class="form-inline mt-3">
                                        <label for="phone" class="form-label sm:w-20">هاتف المستلم</label>
                                        <input id="phone" type="text" class="form-control"  name="reciver_name_" />
                                    </div>
                                    <div class="form-inline mt-3">
                                        <label for="phone" class="form-label sm:w-20">اسم المستلم</label>
                                        <input id="phone" type="text" class="form-control"  name="reciver_name" />
                                    </div>
                                    <div class="form-inline mt-3">
                                        <label for="mo7afaza" class="form-label sm:w-20 tom-">المحافظة</label>
                                        <select name="mo7afza" id='mo7afza' class="form-select tom-select  w-full" >
                                            
                                            @foreach($mo7afazat as $mo7afaza)
                                            <option value="{{$mo7afaza->code}}"  @if(request()->get('mo7afza') ==$mo7afaza->code) selected @endif>{{$mo7afaza->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-inline mt-3">
                                        <label for="horizontal-form-1" class="form-label sm:w-20">المنطقة</label>
                                        <select name="manteka" id='manteka' disabled class="form-select form-select-sm tom-select  w-full mr-1" aria-label=".form-select-sm example" style=" width:200px; margin-right:20px;">
                                            
                                           
                                        </select>
                                        <label for="horizontal-form-1" class="form-label sm:w-20">العنوان</label>
                                        <input type="text" name="el3nwan" id="" class="form-select form-select-sm mr-1">
                                    </div>
                                    <div class="form-inline mt-3">
                                        <label for="horizontal-form-1" class="form-label sm:w-20"></label>
                                        <div class="grid grid-cols-12  mr-10"> 
                                            <label for="horizontal-form-1" class="form-label col-span-2" style=" text-align:left; margin-left:15px; margin-top:8px;  ">مبلغ الشحنه</label>
                                            <input id="shipment_cost" type="text" class="form-control col-span-2"  aria-label="default input inline 1"> 
                                            <label  name='tawsil_cost' for="horizontal-form-1" class="form-label col-span-2" style="text-align:left; margin-left:15px; margin-top:8px; ">مبلغ التوصيل</label>
                                            <input id="tawsil_cost" type="text" class="form-control col-span-2"  aria-label="default input inline 1"> 
                                            <label for="horizontal-form-1" class="form-label col-span-2" style=" text-align:left; margin-left:15px; margin-top:8px;  ">الصافى </label>
                                            <input  id="total" type="text" class="form-control col-span-2"  aria-label="default input inline 1"> 
                                        </div> 
                                        
                                    </div>

                                    <div class="form-inline mt-3">
                                        <label for="horizontal-form-1" class="form-label sm:w-20">ملاحظات</label>
                                        <input id="horizontal-form-1" type="text" class="form-control"  />
                                    </div>
                                   
                                   
                                    <div class="sm:ml-20 sm:pl-5 mt-5">
                                        <button class="btn btn-primary">حفظ</button>
                                    </div>
							    </div>
                            </form>
							                         
							</div>
                        </div>
                    </div>
                    <!-- END: Post Content -->
                    <!-- BEGIN: Post Info -->
                    
                    <!-- END: Post Info -->
                </div>
</div>

<script>
    $('#client_id').on('change', function() {
                  
                  var client_id = this.value;
                      $("#Commercial_name").html('');
                      $.ajax({
                          url:"{{url('getCommertialnameBy3amil')}}?client_id="+client_id+"&bycode=1",
                          type: "get",
                          data: {
                              
                          },
                          dataType : 'json',
                          success: function(result){
                              console.log(result)
                          $('#Commercial_name').prop('disabled', false);
                          //$('#Commercial_name').html('<option value="">...</option>');
                          console.log(result); 
                          $.each(result.all,function(key,value){
                              $("#Commercial_name").append('<option value="'+value.name_+'">'+value.name_+'</option>');
                          });
                          //$('#city_id').html('<option value="">Select city</option>'); 
                          }
                      });
    }); 
    $('#mo7afza').on('change', function() {
                  
                  var mo7afza_id = this.value;
                      $("#manteka").html('');
                      $.ajax({
                          url:"{{url('getManateqByMa7afza')}}?mo7afza="+mo7afza_id+"&bycode=1",
                          type: "get",
                          data: {
                          },
                          dataType : 'json',
                          success: function(result){
                              console.log(result.all)
                          $('#manteka').prop('disabled', false);
                          //$('#manteka').html('<option value="">...</option>');
                          console.log(result); 
                          $.each(result.all,function(key,value){
                              $("#manteka").append('<option value="'+value.code+'">'+value.name+'</option>');
                          });
                          //$('#city_id').html('<option value="">Select city</option>'); 
                          }
                      });
    }); 
    $('#manteka').on('change', function() {
                  
                  var manteka_id = this.value;
                  var mo7afza_id = $('#mo7afza').find(":selected").val();
                  console.log();
                      $("#tawsil_cost").html('');
                      $.ajax({ 
                          url:"{{url('getTawsilByManteka')}}?manteka_id="+manteka_id+"&bycode=1&mo7afza_id="+mo7afza_id,
                          type: "get",
                          data: {
                          },
                          
                          success: function(result){
                              console.log(result.all)
                                $('#tawsil_cost').val(result.all);
                         
                          }
                      });
    }); 
    $('#shipment_cost').on('keyup',function(){
        
        $('#total').val( parseInt($('#shipment_cost').val()) - parseInt($('#tawsil_cost').val())   )
    })

    
</script>
@endsection
