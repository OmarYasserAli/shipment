@extends('layout.app')

@section('content')

    <!-- BEGIN: Content -->
    <div class="content">

        <!-- END: Top Bar -->
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Form Layout
            </h2>
        </div>
        <div class="grid grid-cols-12 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                                <!-- BEGIN: Form Layout -->
                                <!-- BEGIN: Inline Form -->
                <div class="intro-y box mt-5">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base text-right">
                العميل     </h2>
                {{--    <div class="form-check form-switch w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">--}}
                {{--        <label class="form-check-label ml-0" for="show-example-8">العميل</label>--}}
                {{--    </div>--}}
                </div>
                <div id="inline-form" class="p-5">
                    <div class="preview">
                        <div class="grid grid-cols-12 gap-2">
                            <div class="form-control col-span-12 lg:col-span-2 client">
                                <label class="mb-3">اسم العميل</label>

                                <select data-placeholder="اسم العميل" class="tom-select w-full client_id client_el" id="crud-form-2" >
                                    <option value="الكل" >الكل</option>
                                    @foreach ($clients as $client)
                                    <option value="{{$client->name_}}" >{{$client->name_}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-control col-span-12 lg:col-span-2">
                                <label class="mb-3">التاريخ من </label>
                                <input type="date" class="form-control date_from client_el" placeholder="التاريخ من " aria-label="default input inline 2">

                            </div>
                            <div class="form-control col-span-12 lg:col-span-2">
                                <label class="mb-3">التاريخ الى</label>
                                <input type="date" class="form-control date_to client_el" placeholder="التاريخ الى" aria-label="default input inline 3">

                            </div>
                            <div class="form-control col-span-12 lg:col-span-2">
                                <label class="mb-3">واصل/ كل الشحنات</label>
                                <select data-placeholder="واصل/ كل الشحنات" class=" w-full waselOnly client_el" id="crud-form-2" >
                                    <option value="all">كل الشحنات</option>
                                    <option value="wasel" >شحنات الواصل</option>
                                    
                                </select>
                            </div>
                            <div class="form-control col-span-12 lg:col-span-2">
                                <label class="mb-3">الرصيد</label>
                                <input type="text" class="form-control client_net" placeholder="الرصيد" aria-label="default input inline 3">

                            </div>
                            <div class="form-control col-span-12 lg:col-span-2 mt-5">
                                <button type="button" class="btn btn-primary w-24">طباعة</button>

                            </div>


                        </div>
                    </div>
                    <div class="source-code hidden">
                        <button data-target="#copy-inline-form" class="copy-code btn py-1 px-2 btn-outline-secondary"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Copy example code </button>
                        <div class="overflow-y-auto mt-3 rounded-md">
                            <pre id="copy-inline-form" class="source-preview"> <code class="html"> HTMLOpenTagdiv class=&quot;grid grid-cols-12 gap-2&quot;HTMLCloseTag HTMLOpenTaginput type=&quot;text&quot; class=&quot;form-control col-span-4&quot; placeholder=&quot;Input inline 1&quot; aria-label=&quot;default input inline 1&quot;HTMLCloseTag HTMLOpenTaginput type=&quot;text&quot; class=&quot;form-control col-span-4&quot; placeholder=&quot;Input inline 2&quot; aria-label=&quot;default input inline 2&quot;HTMLCloseTag HTMLOpenTaginput type=&quot;text&quot; class=&quot;form-control col-span-4&quot; placeholder=&quot;Input inline 3&quot; aria-label=&quot;default input inline 3&quot;HTMLCloseTag HTMLOpenTag/divHTMLCloseTag </code> </pre>
                        </div>
                    </div>
                </div>
                </div>
                <!-- END: Inline Form -->
                                <!-- END: Form Layout -->
            </div>

            <div class="intro-y col-span-12 lg:col-span-12">
                <!-- BEGIN: Form Layout -->
                <!-- BEGIN: Inline Form -->
                <div class="intro-y box mt-5">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base text-right">
                            الفرع  له  </h2>
                        {{--    <div class="form-check form-switch w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">--}}
                        {{--        <label class="form-check-label ml-0" for="show-example-8">العميل</label>--}}
                        {{--    </div>--}}
                    </div>
                    <div id="inline-form" class="p-5">
                        <div class="preview">
                            <div class="grid grid-cols-12 gap-2">
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">اسم الفرع</label>

                                    <select data-placeholder="اسم العميل" class="tom-select w-full branch_lah_el branch_id" id="crud-form-2" >
                                        <option value="الكل" >الكل</option>
                                        @foreach ($clients as $client)
                                    <option value="{{$client->name_}}" >{{$client->name_}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">التاريخ من </label>
                                    <input type="date" class="form-control branch_lah_el date_from" placeholder="التاريخ من " aria-label="default input inline 2">

                                </div>
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">التاريخ الى</label>
                                    <input type="date" class="form-control branch_lah_el date_to" placeholder="التاريخ الى" aria-label="default input inline 3">

                                </div>
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">واصل/ كل الشحنات</label>
                                    <select data-placeholder="واصل/ كل الشحنات" class="tom-select w-full branch_lah_el waselOnly" id="crud-form-2" >
                                        <option value="all">كل الشحنات</option>
                                    <option value="wasel" >شحنات الواصل</option>
                                        
                                    </select>
                                </div>
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">الرصيد</label>
                                    <input type="text" class="form-control branch_lah_net" placeholder="الرصيد" aria-label="default input inline 3">

                                </div>
                                <div class="form-control col-span-12 lg:col-span-2 mt-5">
                                    <button type="button" class="btn btn-primary w-24">طباعة</button>

                                </div>


                            </div>
                        </div>
                        <div class="source-code hidden">
                            <button data-target="#copy-inline-form" class="copy-code btn py-1 px-2 btn-outline-secondary"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Copy example code </button>
                            <div class="overflow-y-auto mt-3 rounded-md">
                                <pre id="copy-inline-form" class="source-preview"> <code class="html"> HTMLOpenTagdiv class=&quot;grid grid-cols-12 gap-2&quot;HTMLCloseTag HTMLOpenTaginput type=&quot;text&quot; class=&quot;form-control col-span-4&quot; placeholder=&quot;Input inline 1&quot; aria-label=&quot;default input inline 1&quot;HTMLCloseTag HTMLOpenTaginput type=&quot;text&quot; class=&quot;form-control col-span-4&quot; placeholder=&quot;Input inline 2&quot; aria-label=&quot;default input inline 2&quot;HTMLCloseTag HTMLOpenTaginput type=&quot;text&quot; class=&quot;form-control col-span-4&quot; placeholder=&quot;Input inline 3&quot; aria-label=&quot;default input inline 3&quot;HTMLCloseTag HTMLOpenTag/divHTMLCloseTag </code> </pre>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Inline Form -->
                <!-- END: Form Layout -->
            </div>

            <div class="intro-y col-span-12 lg:col-span-12">
                <!-- BEGIN: Form Layout -->
                <!-- BEGIN: Inline Form -->
                <div class="intro-y box mt-5">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base text-right">
                            الفرع عليه    </h2>
                        {{--    <div class="form-check form-switch w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">--}}
                        {{--        <label class="form-check-label ml-0" for="show-example-8">العميل</label>--}}
                        {{--    </div>--}}
                    </div>
                    <div id="inline-form" class="p-5">
                        <div class="preview">
                            <div class="grid grid-cols-12 gap-2">
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">اسم الفرع</label>

                                    <select data-placeholder="اسم العميل" class="tom-select w-full" id="crud-form-2" multiple>
                                        <option value="1" >Sport & Outdoor</option>
                                        <option value="2">PC & Laptop</option>
                                        <option value="3" >Smartphone & Tablet</option>
                                        <option value="4">Photography</option>
                                    </select>
                                </div>
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">التاريخ من </label>
                                    <input type="date" class="form-control " placeholder="التاريخ من " aria-label="default input inline 2">

                                </div>
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">التاريخ الى</label>
                                    <input type="date" class="form-control" placeholder="التاريخ الى" aria-label="default input inline 3">

                                </div>
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">واصل/ كل الشحنات</label>
                                    <select data-placeholder="واصل/ كل الشحنات" class="tom-select w-full" id="crud-form-2" multiple>
                                        <option value="1" >Sport & Outdoor</option>
                                        <option value="2">PC & Laptop</option>
                                        <option value="3" >Smartphone & Tablet</option>
                                        <option value="4">Photography</option>
                                    </select>
                                </div>
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">الرصيد</label>
                                    <input type="text" class="form-control " placeholder="الرصيد" aria-label="default input inline 3">

                                </div>
                                <div class="form-control col-span-12 lg:col-span-2 mt-5">
                                    <button type="button" class="btn btn-primary w-24">طباعة</button>

                                </div>


                            </div>
                        </div>
                        <div class="source-code hidden">
                            <button data-target="#copy-inline-form" class="copy-code btn py-1 px-2 btn-outline-secondary"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Copy example code </button>
                            <div class="overflow-y-auto mt-3 rounded-md">
                                <pre id="copy-inline-form" class="source-preview"> <code class="html"> HTMLOpenTagdiv class=&quot;grid grid-cols-12 gap-2&quot;HTMLCloseTag HTMLOpenTaginput type=&quot;text&quot; class=&quot;form-control col-span-4&quot; placeholder=&quot;Input inline 1&quot; aria-label=&quot;default input inline 1&quot;HTMLCloseTag HTMLOpenTaginput type=&quot;text&quot; class=&quot;form-control col-span-4&quot; placeholder=&quot;Input inline 2&quot; aria-label=&quot;default input inline 2&quot;HTMLCloseTag HTMLOpenTaginput type=&quot;text&quot; class=&quot;form-control col-span-4&quot; placeholder=&quot;Input inline 3&quot; aria-label=&quot;default input inline 3&quot;HTMLCloseTag HTMLOpenTag/divHTMLCloseTag </code> </pre>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Inline Form -->
                <!-- END: Form Layout -->
            </div>

            <div class="intro-y col-span-12 lg:col-span-12">
                <!-- BEGIN: Form Layout -->
                <!-- BEGIN: Inline Form -->
                <div class="intro-y box mt-5">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base text-right">
                            المندوب عليه     </h2>
                        {{--    <div class="form-check form-switch w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">--}}
                        {{--        <label class="form-check-label ml-0" for="show-example-8">العميل</label>--}}
                        {{--    </div>--}}
                    </div>
                    <div id="inline-form" class="p-5">
                        <div class="preview">
                            <div class="grid grid-cols-12 gap-2">
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">اسم المندوب</label>

                                    <select data-placeholder="اسم العميل" class="tom-select w-full" id="crud-form-2" multiple>
                                        <option value="1" >Sport & Outdoor</option>
                                        <option value="2">PC & Laptop</option>
                                        <option value="3" >Smartphone & Tablet</option>
                                        <option value="4">Photography</option>
                                    </select>
                                </div>
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">التاريخ من </label>
                                    <input type="date" class="form-control " placeholder="التاريخ من " aria-label="default input inline 2">

                                </div>
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">التاريخ الى</label>
                                    <input type="date" class="form-control" placeholder="التاريخ الى" aria-label="default input inline 3">

                                </div>
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">واصل/ كل الشحنات</label>
                                    <select data-placeholder="واصل/ كل الشحنات" class="tom-select w-full" id="crud-form-2" multiple>
                                        <option value="1" >Sport & Outdoor</option>
                                        <option value="2">PC & Laptop</option>
                                        <option value="3" >Smartphone & Tablet</option>
                                        <option value="4">Photography</option>
                                    </select>
                                </div>
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">الرصيد</label>
                                    <input type="text" class="form-control " placeholder="الرصيد" aria-label="default input inline 3">

                                </div>
                                <div class="form-control col-span-12 lg:col-span-2 mt-5">
                                    <button type="button" class="btn btn-primary w-24">طباعة</button>

                                </div>


                            </div>
                        </div>
                        <div class="source-code hidden">
                            <button data-target="#copy-inline-form" class="copy-code btn py-1 px-2 btn-outline-secondary"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Copy example code </button>
                            <div class="overflow-y-auto mt-3 rounded-md">
                                <pre id="copy-inline-form" class="source-preview"> <code class="html"> HTMLOpenTagdiv class=&quot;grid grid-cols-12 gap-2&quot;HTMLCloseTag HTMLOpenTaginput type=&quot;text&quot; class=&quot;form-control col-span-4&quot; placeholder=&quot;Input inline 1&quot; aria-label=&quot;default input inline 1&quot;HTMLCloseTag HTMLOpenTaginput type=&quot;text&quot; class=&quot;form-control col-span-4&quot; placeholder=&quot;Input inline 2&quot; aria-label=&quot;default input inline 2&quot;HTMLCloseTag HTMLOpenTaginput type=&quot;text&quot; class=&quot;form-control col-span-4&quot; placeholder=&quot;Input inline 3&quot; aria-label=&quot;default input inline 3&quot;HTMLCloseTag HTMLOpenTag/divHTMLCloseTag </code> </pre>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Inline Form -->
                <!-- END: Form Layout -->
            </div>

            <div class="intro-y col-span-12 lg:col-span-12">
                <!-- BEGIN: Form Layout -->
                <!-- BEGIN: Inline Form -->
                <div class="intro-y box mt-5">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base text-right">
                            المجاميع     </h2>
                        {{--    <div class="form-check form-switch w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">--}}
                        {{--        <label class="form-check-label ml-0" for="show-example-8">العميل</label>--}}
                        {{--    </div>--}}
                    </div>
                    <div id="inline-form" class="p-5">
                        <div class="preview">
                            <div class="grid grid-cols-12 gap-2">
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">اسم المندوب</label>

                                    <select data-placeholder="اسم العميل" class="tom-select w-full" id="crud-form-2" multiple>
                                        <option value="1" >Sport & Outdoor</option>
                                        <option value="2">PC & Laptop</option>
                                        <option value="3" >Smartphone & Tablet</option>
                                        <option value="4">Photography</option>
                                    </select>
                                </div>
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">التاريخ من </label>
                                    <input type="date" class="form-control " placeholder="التاريخ من " aria-label="default input inline 2">

                                </div>
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">التاريخ الى</label>
                                    <input type="date" class="form-control" placeholder="التاريخ الى" aria-label="default input inline 3">

                                </div>
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">واصل/ كل الشحنات</label>
                                    <select data-placeholder="واصل/ كل الشحنات" class="tom-select w-full" id="crud-form-2" multiple>
                                        <option value="1" >Sport & Outdoor</option>
                                        <option value="2">PC & Laptop</option>
                                        <option value="3" >Smartphone & Tablet</option>
                                        <option value="4">Photography</option>
                                    </select>
                                </div>
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">الرصيد</label>
                                    <input type="text" class="form-control " placeholder="الرصيد" aria-label="default input inline 3">

                                </div>
                                <div class="form-control col-span-12 lg:col-span-2 mt-5">
                                    <button type="button" class="btn btn-primary w-24">طباعة</button>

                                </div>


                            </div>
                        </div>
                        <div class="source-code hidden">
                            <button data-target="#copy-inline-form" class="copy-code btn py-1 px-2 btn-outline-secondary"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Copy example code </button>
                            <div class="overflow-y-auto mt-3 rounded-md">
                                <pre id="copy-inline-form" class="source-preview"> <code class="html"> HTMLOpenTagdiv class=&quot;grid grid-cols-12 gap-2&quot;HTMLCloseTag HTMLOpenTaginput type=&quot;text&quot; class=&quot;form-control col-span-4&quot; placeholder=&quot;Input inline 1&quot; aria-label=&quot;default input inline 1&quot;HTMLCloseTag HTMLOpenTaginput type=&quot;text&quot; class=&quot;form-control col-span-4&quot; placeholder=&quot;Input inline 2&quot; aria-label=&quot;default input inline 2&quot;HTMLCloseTag HTMLOpenTaginput type=&quot;text&quot; class=&quot;form-control col-span-4&quot; placeholder=&quot;Input inline 3&quot; aria-label=&quot;default input inline 3&quot;HTMLCloseTag HTMLOpenTag/divHTMLCloseTag </code> </pre>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Inline Form -->
                <!-- END: Form Layout -->
            </div>
        </div>
    </div>
    <!-- END: Content -->

</div>

<script>

    $('.client_el').on('change', function() {
        var client_id = $('.client_id').val();
        var date_from = $('.date_from').val();
        var date_to = $('.date_to').val();
        var type = ($('.waselOnly').val()=='wasel')?1:'';
        if(client_id =='' ) return ;
        $.ajax({
                    url: "{{route('accounting.3amil.notmosadad')}}"+ "?arba7=1&date_from="+date_from+"&date_to="+date_to+"&client_id="+client_id+'&waselOnly='+type,
                    type: "get",
                })
                .done(function (response) {
                    $('.client_net').val(response.sums['netCost'])
                   console.log(response);
                })
    });

    $('.branch_lah_el').on('change', function() {
        var branch_id = $('.branch_id').val();
        var date_from = $('.date_from').val();
        var date_to = $('.date_to').val();
        var type = ($('.waselOnly').val()=='wasel')?1:'';
        if(branch_id =='' ) return ;
        $.ajax({
                    url: "{{route('accounting.3amil.notmosadad')}}"+ "?arba7=1&date_from="+date_from+"&date_to="+date_to+"&client_id="+client_id+'&waselOnly='+type,
                    type: "get",
                })
                .done(function (response) {
                    $('.branch_lah_net').val(response.sums['netCost'])
                   console.log(response);
                })
    });

    
</script>
@endsection
