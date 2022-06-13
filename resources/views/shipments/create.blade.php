@extends('layout.app')

@section('content')

<div class="content">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.3/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.3/dist/js/tom-select.complete.min.js"></script>
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
                           
                                <div id='msgs' class="alert ">
                                    <p></p>
                                    <ul class="cerror" id='cerror'>
                                        @if($errors->any())
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                           
                            <div class="post__content tab-content">
                                <form action="{{route('shiments.store')}}" method="POST" id="shipment_form">
                                    @csrf
                                    <div id="content" class="tab-pane p-5 active" role="tabpanel" aria-labelledby=	"content-tab">
                                    <div class="form-inline">
                                        <label for="date" class="form-label sm:w-20">التاريخ</label>
                                        <input type="text" name="date" class="form-control"   value="{{$now}}" disabled> 
                                        <input type="hidden" name="date" class="form-control"   value="{{$now}}" > 
                                       
                                    </div>
                                    @if(!$code_ai)
                                    <div class="form-inline mt-3">
                                        <label for="rakam-wasl" class="form-label sm:w-20">رقم الوصل</label>
                                        <input id="rakam-wasl" type="text" class="form-control"  name="code"/>
                                        
                                    </div>
                                    <small class="warring " style="margin-right: 100px;"></small>
                                    @endif
                                    <div class="form-inline mt-3">
                                        <label for="3amil-name" class="form-label sm:w-20">اسم العميل</label>
                                        <select class="form-control client_id " id='client_id' name="client_id">
                                            @foreach ($clients as $client)
                                             <option value="{{$client->code_}}">{{$client->name_}}</option>
                                             @endforeach
                                        </select>
                                        <script>
                                            new TomSelect(".client_id",{});
                                        </script>
                                    </div>
                                    <div class="form-inline mt-3">
                                        <label for="commercial-name" class="form-label sm:w-20 ">الاسم التجارى</label>
                                        <select class="Commercial_name form-control" id='Commercial_name' name="Commercial_name" >     
                                        </select>
                                    </div>
                                    <div class="form-inline mt-3">
                                        <label for="phone" class="form-label sm:w-20">هاتف المستلم</label>
                                        <input id="phone" type="text" class="form-control"  name="reciver_phone_" />
                                    </div>
                                    <div class="form-inline mt-3">
                                        <label for="phone" class="form-label sm:w-20">اسم المستلم</label>
                                        <input id="phone" type="text" class="form-control"  name="reciver_name_" />
                                    </div>
                                    <div class="form-inline mt-3">
                                        <label for="mo7afaza" class="form-label sm:w-20 ">المحافظة</label>
                                        <select name="mo7afza" id='mo7afza' class="form-control mo7afza" >
                                            
                                            @foreach($mo7afazat as $mo7afaza)
                                            <option value="{{$mo7afaza->code}}"  >{{$mo7afaza->name}}</option>
                                            @endforeach
                                        </select>
                                        <script>
                                            new TomSelect(".mo7afza",{});
                                        </script>
                                    </div>
                                    <div class="form-inline mt-3">
                                        <label for="horizontal-form-1" class="form-label sm:w-20">المنطقة</label>
                                        <select name="manteka" id='manteka'  class="form-control   mr-1"  style=" width:200px; margin-right:20px;">
                                            
                                           
                                        </select>
                                        <label for="horizontal-form-1" class="form-label sm:w-20">العنوان</label>
                                        <input type="text" name="el3nwan" id="" class="form-select form-select-sm mr-1" style=" width:400px; ">
                                    </div>

                                    <div class="form-inline mt-3">
                                        <label for="horizontal-form-1" class="form-label sm:w-20">مبلغ الشحنه</label>
                                        
                                        <input id="shipment_cost" type="text" class="form-control   mr-1" name="shipment_coast_" aria-label="default input inline 1"> 

                                        <label for="horizontal-form-1" class="form-label sm:w-20">مبلغ التوصيل</label>
                                        <input id="tawsil_cost" type="text" class="form-control col-span-2" name="tawsil_coast_"  aria-label="default input inline 1"> 
                                        <label for="horizontal-form-1" class="form-label sm:w-20">الصافى</label>
                                        <input  id="total" type="text" class="form-control col-span-2"  aria-label="default input inline 1" name="total_"> 


                                    </div>
                                    
                                  

                                    <div class="form-inline mt-3">
                                        <label for="horizontal-form-1" class="form-label sm:w-20">ملاحظات</label>
                                        <input id="horizontal-form-1" type="text" class="form-control"   name="notes_"/>
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

var  comName =new TomSelect(".Commercial_name",{
	valueField: 'id',
	labelField: 'title',
	searchField: 'title',
	create: false
});
var  manteka =new TomSelect("#manteka",{
	valueField: 'id',
	labelField: 'title',
	searchField: 'title',
	create: false
});
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
                         
                          comName.clearOptions();
                          $.each(result.all,function(key,value){
                              comName.addOption({
                                id: value.name_,
                                title: value.name_,
                              
                            });
                              
                          });
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
                          manteka.clearOptions();
                          $.each(result.all,function(key,value){
                            manteka.addOption({
                                id: value.code,
                                title: value.name,
                                
                            });
                            });
                          }
                      });
    }); 
    $('#manteka').on('change', function() {
                  
                    var manteka_id = this.value;
                    var client_id  = $('#client_id ').find(":selected").val();
                    var mo7afza_id  = $('#mo7afza ').find(":selected").val();
                     
                        $("#tawsil_cost").html('');
                        $.ajax({ 
                            url:"{{url('getTawsilByManteka')}}?bycode=1&client_id="+client_id+'&mo7afza_id='+ mo7afza_id+'&manteka_id='+manteka_id ,
                            type: "get",
                            success: function(result){
                                console.log(result.all)
                                  $('#tawsil_cost').val(result.all);
                                  if($('#shipment_cost').val() !='')
                                  $('#total').val( parseInt($('#shipment_cost').val()) - parseInt($('#tawsil_cost').val())   )
                            }
                        });
      }); 
    $('#shipment_cost').on('keyup',function(){
        
        $('#total').val( parseInt($('#shipment_cost').val()) - parseInt($('#tawsil_cost').val())   )
    })

    
    $('#shipment_form').on("submit",function(e){
        e.preventDefault();
        save_shipment()
    } );
    $('#shipment_cost').on("keyup",function(e){
        if(e.keyCode == 13){
            save_shipment()
        }
    } )

    $('#rakam-wasl').on("keyup",function(e){
        let code= $(this).val();
        $.ajax({ 
        url:"{{route('shiments.isCodeUsed')}}?code="+code,
        type: "get",
        success: function(result){
           if(result.data == true)
            $('.warring').css('color','red').text('هذا الرقم غير متاح');
            else
            $('.warring').css('color','green').text('هذا الرقم  متاح');

        }
    });
        
    } )
    
    function save_shipment() {
        // var formData = new FormData($('#shipment_form')[0]);
        var formData = $('#shipment_form').serializeArray();
        var data={}
        var flg=0;
        formData.forEach(element => 
        {   if(element['name']=='notes_'){
            
            }else{
            data[element['name']]= element['value'] ;
            if(element['value'] =='' || element['value'] == null)
            {flg=1; $("#cerror").append('<li>'+element['name'] +' is required</li>');}
            }
        });
       if(flg) {
        $('msgs').addClass( "alert alert-danger" );
        return;
    };
        $.ajax({
                    url:"{{route('shiments.store')}}",
                    type: "post",
                    data: data,
                    
                    success: function(result){
                        console.log(result)
                        $('#rakam-wasl').val('');
                        document.getElementById("rakam-wasl").focus();
                        $('.warring').text('');
                        $("#cerror").text('');
                        $("#cerror").append('<li> تم الحفظ بنجاح</li>');
                    
                    },
                    fail: function(result){
                        alert('f');
                        result.errors.forEach(element => {
                            console.log(element)
                        });
                    }
                });
    }
</script>
@endsection
