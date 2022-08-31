<!DOCTYPE html>

<html lang="en" class="light">
    
    <!-- BEGIN: Head -->
    <head>
      
        @php
            $companyMainData = \App\Models\CompanyInfo::where('branch_','الفرع الرئيسى')->first();
        @endphp
        <meta charset="utf-8">
        <link href="{{asset('assets/'.$companyMainData->image_data)}}" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Midone Admin Template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">
        <title> 
           
        @if(isset($page_title))
            {{$page_title}}
        @endif
        -  {{$companyMainData->name_}} 
        </title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{asset('css/_app.css')}}" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
        <style>
            .switch {
                position: relative;
                display: inline-block;
                width: 47px;
                height: 27px;
            }
            
            .switch input { 
              opacity: 0;
              width: 0;
              height: 0;
            }
            
            .slider {
              position: absolute;
              cursor: pointer;
              top: 0;
              left: 0;
              right: 0;
              bottom: 0;
              background-color: #ccc;
              -webkit-transition: .4s;
              transition: .4s;
            }
            
            .slider:before {
                position: absolute;
                content: "";
                height: 18px;
                width: 18px;
                left: 4px;
                bottom: 4px;
                background-color: white;
                -webkit-transition: .4s;
                transition: .4s;
            }
            
            input:checked + .slider {
              background-color: #2196F3;
            }
            
            input:focus + .slider {
              box-shadow: 0 0 1px #2196F3;
            }
            
            input:checked + .slider:before {
              -webkit-transform: translateX(26px);
              -ms-transform: translateX(26px);
              transform: translateX(26px);
            }
            
            /* Rounded sliders */
            .slider.round {
              border-radius: 34px;
            }
            
            .slider.round:before {
              border-radius: 50%;
            }
            </style>
        <!-- END: CSS Assets-->
        <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
    </head>
    <!-- END: Head -->
    <body class="py-5">
        <!-- BEGIN: Mobile Menu -->

         @include('layout.partial.mob-menu')
        <!-- END: Mobile Menu -->
        <div class="flex" style="direction:  rtl;">
            <!-- BEGIN: Side Menu -->
            @include('layout.partial.nav')
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            @yield('content')

            <!-- END: Content -->
        </div>
        <!-- BEGIN: Dark Mode Switcher-->
        <div data-url="side-menu-dark-dashboard-overview-1.html" class="cursor-pointer shadow-md fixed bottom-0 left-0 box border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">
            <div class="mr-4 text-slate-600 dark:text-slate-200">Dark Mode</div>
            <label class="switch">
                <input type="checkbox" onclick="toggleDarkMode()" id='darkBTN' >
                <span class="slider round"></span>
              </label>
        </div>
        <!-- END: Dark Mode Switcher-->

        <!-- BEGIN: JS Assets-->
        <script src="{{asset('js/markerclusterer.js')}}"></script>

        <script src="{{asset('js/app.js')}}"></script>
        <script
          src="{{asset('js/jquery-3.6.0.min.js')}}"

          ></script>
        <!-- END: JS Assets-->
        <script>
            getMode()
           
       
            function toggleDarkMode(){
                if(sessionStorage.getItem("darkMode") == 1){
                  
                    sessionStorage.setItem("darkMode", 0);
                    $('html').removeClass('dark').addClass( 'light' );
                }else{
                    sessionStorage.setItem("darkMode", 1)
                    $('html').removeClass('light').addClass( 'dark' );
                }
            }

            function getMode(){
                if(sessionStorage.getItem("darkMode") == 1){
                    $('html').removeClass('light').addClass( 'dark' );
                    $('#darkBTN').prop('checked', true);
                }
                
            }
        </script>
    </body>
</html>
