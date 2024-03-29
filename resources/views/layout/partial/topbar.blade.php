<div class="top-bar">
    <!-- BEGIN: Breadcrumb -->
    <nav aria-label="breadcrumb" class="-intro-x  hidden sm:flex" style="width: 60%; align-items:center;">

        <div class="search  sm:block " style="float: right;">

        </div>
        @if(isset($page_title))
            <div class="" style="">
                <h1 style="font-size: 20px; " class="pr-5" >{{$page_title}}</h1></div>
        @endif
            {{-- <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"></a></li>
            <li class="breadcrumb-item active" aria-current="page"></li>
        </ol> --}}
    </nav>
    <!-- END: Breadcrumb -->
    <!-- BEGIN: Search -->
    @if(auth()->user()->username =='Superuser')
         @php
             $superUserBranch = App\Models\BranchInfo::all();
         @endphp
        <div class="flex">
            <label style="width: 120px; margin-top:8px; margin-right:10px;">الفرع الحالي</label>
            <select name="" id="current_branch" class="rounded form-control">
               @foreach ($superUserBranch as $item)
                   <option value="{{$item->name_}}" @if(auth()->user()->branch == $item->name_) selected @endif>{{$item->name_}}</option>
               @endforeach
           </select>
        </div>
         @endif

         <script>
            $('#current_branch').on('change',function(){
                $.ajax({
                            url:"{{url('changeAdminBranch')}}?branch="+$('#current_branch').val(),
                            type: "get",

                            dataType : 'json',
                            success: function(result){
                                window.location = window.location.href.split("?")[0];



                        }
                        });

            })
         </script>
    <div class="flex mr-auto">

        <div class="intro-x relative mr-3 sm:mr-6">


            <div class="search hidden sm:block">
                <input type="text" class="search__input form-control" placeholder="Search..." id="shipment_search">
                <i data-lucide="search" class="search__icon dark:text-slate-500"></i>
            </div>
            <script>
                $('#shipment_search').keyup(function(e){
                    if(e.keyCode == 13)
                    {

                        if(($(this).val() !='') && $(this).val() !=null){
                            window.location.replace('{{route('shipment_bar_search')}}?q='+$(this).val())
                        }
                    }
                });
            </script>
            <a class="notification sm:hidden" href=""> <i data-lucide="search" class="notification__icon dark:text-slate-500"></i> </a>

        </div>
        <!-- END: Search -->
        <!-- BEGIN: Notifications -->
        <div class="intro-x dropdown mr-auto sm:mr-6">
            <div class="dropdown-toggle notification notification--bullet cursor-pointer" role="button" aria-expanded="false" data-tw-toggle="dropdown"> <i data-lucide="bell" class="notification__icon dark:text-slate-500"></i> </div>
            <div class="notification-content pt-2 dropdown-menu">
                <div class="notification-content__box dropdown-content">
                    <div class="notification-content__title">Notifications</div>
                    <div class="cursor-pointer relative flex items-center ">
                        <div class="w-12 h-12 flex-none image-fit mr-1">
                            <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{asset('images/profile-1.jpg')}}">
                            <div class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white dark:border-darkmode-600"></div>
                        </div>
                        <div class="ml-2 overflow-hidden">
                            <div class="flex items-center">
                                <a href="javascript:;" class="font-medium truncate mr-5">Russell Crowe</a>
                                <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">01:10 PM</div>
                            </div>
                            <div class="w-full truncate text-slate-500 mt-0.5">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomi</div>
                        </div>
                    </div>




                </div>
            </div>
        </div>
        <!-- END: Notifications -->
        <!-- BEGIN: Account Menu -->
        <div class="intro-x dropdown w-8 h-8">
            <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                <img alt="Midone - HTML Admin Template" src="{{asset('/images/profile-8.jpg')}}">
            </div>
            <div class="dropdown-menu w-56">
                <ul class="dropdown-content bg-primary text-white">
                    <li class="p-2">
                        <div class="font-medium">{{auth()->user()->name_}}</div>
                        <div class="text-xs text-white/70 mt-0.5 dark:text-slate-500">{{auth()->user()->branch}}</div>
                    </li>
                    <li>
                        <hr class="dropdown-divider border-white/[0.08]">
                    </li>
{{--                    <li>--}}
{{--                        <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="user" class="w-4 h-4 mr-2"></i> البروفايل </a>--}}
{{--                    </li>--}}

                    <li>
                        <a href="{{route("passwordChange")}}" class="dropdown-item hover:bg-white/5"> <i data-lucide="lock" class="w-4 h-4 mr-2"></i> تعديل كلمة المرور </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider border-white/[0.08]">
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  class="dropdown-item hover:bg-white/5"> <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> تسجيل خروج </a>

                    </li>
                </ul>
            </div>
        </div>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    <!-- END: Account Menu -->
</div>
