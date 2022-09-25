@extends('layout.app')

@section('content')

<div class="content">
    <!-- BEGIN: Top Bar -->
    @include('layout.partial.topbar')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-9" >
          <iframe width="560" height="315" src="" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        
    </div>
</div>
  

</div>

    <script type="text/javascript">


       $( document ).ready(function() {
            $.ajax({
                          url:"https://albahar.live:3000/web",
                          type: "post",
                          data: {role: 'admin',
                                    'email': 'Superuser@gmail.com',
                                    'fcmToken':'',
                                    'password': '123@super',
                                    'branch': 'الفرع الرئيسى',
                                    //imageThumb: String, *allowed
                                    // platform: String, *allowed
                                    //  appLanguage: String *allowed
                                    },
                          dataType : 'json',
                          success: function(result){

                          
                          }
                      });
       });

            </script>
@endsection
