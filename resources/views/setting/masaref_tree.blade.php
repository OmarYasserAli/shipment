
@extends('layout.app')

@section('content')
<style>/*
    Only custom marker for summary/details
    For cross browser compatible styling hide Firefox's marker by setting summary { display: block }
    and Chrome and Safari's marker by setting ::-webkit-details-marker {display: none;}
   */
   summary {
     display: block;
     cursor: pointer;
     outline: 0; 
   }
   
   summary::-webkit-details-marker {
       display: none;
     }
   

   .tree-nav{
    direction: rtl;
   }
   .tree-nav__item {
     display: block;
     white-space: nowrap;
     color: #ccc;
     position: relative;
   }
   .tree-nav__item.is-expandable::before {
     border-right: 1px solid #333;
     content: "";
     height: 100%;
     right: 0.8rem;
     position: absolute;
     top: 2.4rem;
     height: calc(100% - 2.4rem);
   }
   .tree-nav__item .tree-nav__item {
     margin-right: 2.4rem;
   }
   .tree-nav__item.is-expandable[open] > .tree-nav__item-title::before {
     font-family: "ionicons";
     transform: rotate(90deg);
   }
   .tree-nav__item.is-expandable > .tree-nav__item-title {
     padding-right: 2.4rem;
   }
   .tree-nav__item.is-expandable > .tree-nav__item-title::before {
     position: absolute;
     will-change: transform;
     transition: transform 300ms ease;
     font-family: "ionicons";
     color: #0000;
     font-size: 1.1rem;
     content: "\f125";
     right: 0;
     display: inline-block;
     width: 1.6rem;
     text-align: center;
   }
   
   .tree-nav__item-title {
     cursor: pointer;
     display: block;
     outline: 0;
     color: black;
     font-size: 1.5rem;
     line-height: 3.2rem;
   }
   .tree-nav__item-title .icon {
     display: inline;
     padding-right: 1.6rem;
     margin-right: 0.8rem;
     color: #666;
     font-size: 1.4rem;
     position: relative;
   }
   .tree-nav__item-title .icon::before {
     top: 0;
     position: absolute;
     right: 0;
     display: inline-block;
     width: 1.6rem;
     text-align: center;
   }
   
   .tree-nav__item-title::-webkit-details-marker {
     display: none;
   }
</style>
<div class="content">
    <div id="type_modal" class="modal" data-tw-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body px-5 py-10">
                    <div class="text-center">
                        <div class="mb-5" style="font-size: 25px">الاسم</div>
                        <div class="form-inline">
    
                            <input type="text" class=" form-select" id='name' >
                               
                           
                        </div>
                         
                         <button type="button" data-tw-dismiss="" id='modal_close' class="btn btn-primary w-24 mt-5">استمرار</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BEGIN: Top Bar -->
    @include('layout.partial.topbar')
    <!-- END: Top Bar -->
    

        <div class="col-md-8 col-md-offset-2">

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            
               
            </div>

            <div>
                <nav class="tree-nav">

                    {{-- <a class="tree-nav__item-title">
                      <i class="icon ion-scissors"></i>
                      THE INHERITANCE
                    </a> --}}
                    <a class="tree-nav__item-title">
                      <i class="icon ion-android-star"></i>
                      شجرة المصاريف
                    </a>
                   
                    @foreach ($tree as $key => $item)
                        {!! \app\helpers::put_tree_item($item) !!}
                    @endforeach
                     <details class="tree-nav__item is-expandable">
                        <summary class="tree-nav__item-title"><apan class='add' data-parent='0'>+اضافة</span></summary>

                            </details>



                  </nav>
            </div>
            </div>
     <script>
        let parent='';
        $('.add').on('click',function(){
             parent = $(this).data('parent');
            const myModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#type_modal"));
            myModal.show();
        });

        $( "#modal_close" ).click(function() {
            const myModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#type_modal"));
            var name = $('#name').val();
            $( "#modal_close" ).prop('disabled', false);
            // console.log(name, parent);
            $.ajax({
                        url: "{{route('setting.masaref_tree.store')}}" ,
                        type: 'post',
                        data:{ name:name, parent:parent, _token: "{{ csrf_token() }}"},
                        error: function(e){
                            console.log(e);
                        },
                        success: function(res) {
                            myModal.hide();
                            location.reload();


                        }
                    });
            // myModal.hide();
        });
     </script>
@endsection
