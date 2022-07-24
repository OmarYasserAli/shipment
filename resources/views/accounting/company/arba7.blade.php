@extends('layout.app')

@section('content')

    <!-- BEGIN: Content -->
    <div class="content">

        <!-- END: Top Bar -->
        <div class="intro-y flex items-center mt-8">
            
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
                                    <option value="-1">...</option>
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
                                <button type="button" class="btn btn-primary w-24 print" data-type='3amil'>طباعة</button>

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
                            الفرع له  </h2>
                        {{--    <div class="form-check form-switch w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">--}}
                        {{--        <label class="form-check-label ml-0" for="show-example-8">العميل</label>--}}
                        {{--    </div>--}}
                    </div>
                    <div id="inline-form" class="p-5">
                        <div class="preview">
                            <div class="grid grid-cols-12 gap-2">
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">اسم الفرع</label>

                                    <select data-placeholder="اسم العميل" class="tom-select w-full branch_3leh_el branch_id_3" id="crud-form-2" >
                                        <option value="-1">...</option>
                                        <option value="الكل" >الكل</option>
                                        @foreach ($branches as $branch)
                                    <option value="{{$branch->name_}}" >{{$branch->name_}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">التاريخ من </label>
                                    <input type="date" class="form-control branch_3leh_el date_from_3" placeholder="التاريخ من " aria-label="default input inline 2">

                                </div>
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">التاريخ الى</label>
                                    <input type="date" class="form-control branch_3leh_el date_to_3" placeholder="التاريخ الى" aria-label="default input inline 3">

                                </div>
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">واصل/ كل الشحنات</label>
                                    <select data-placeholder="واصل/ كل الشحنات" class="tom-select w-full branch_3leh_el waselOnly_3" id="crud-form-2" >
                                        <option value="all">كل الشحنات</option>
                                    <option value="wasel" >شحنات الواصل</option>
                                        
                                    </select>
                                </div>
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">الرصيد</label>
                                    <input type="text" class="form-control branch_3leh_net" placeholder="الرصيد" aria-label="default input inline 3">

                                </div>
                                <div class="form-control col-span-12 lg:col-span-2 mt-5">
                                    <button type="button" class="btn btn-primary w-24 print" data-type='fro32'>طباعة</button>

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
                            الفرع  علية  </h2>
                        {{--    <div class="form-check form-switch w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">--}}
                        {{--        <label class="form-check-label ml-0" for="show-example-8">العميل</label>--}}
                        {{--    </div>--}}
                    </div>
                    <div id="inline-form" class="p-5">
                        <div class="preview">
                            <div class="grid grid-cols-12 gap-2">
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">اسم الفرع</label>

                                    <select data-placeholder="اسم العميل" class="tom-select w-full branch_lah_el branch_id_2" id="crud-form-2" >
                                        <option value="-1">...</option>
                                        <option value="الكل" >الكل</option>
                                        @foreach ($branches as $branch)
                                    <option value="{{$branch->name_}}" >{{$branch->name_}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">التاريخ من </label>
                                    <input type="date" class="form-control branch_lah_el date_from_2" placeholder="التاريخ من " aria-label="default input inline 2">

                                </div>
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">التاريخ الى</label>
                                    <input type="date" class="form-control branch_lah_el date_to_2" placeholder="التاريخ الى" aria-label="default input inline 3">

                                </div>
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">واصل/ كل الشحنات</label>
                                    <select data-placeholder="واصل/ كل الشحنات" class="tom-select w-full branch_lah_el waselOnly_2" id="crud-form-2" >
                                        <option value="all">كل الشحنات</option>
                                    <option value="wasel" >شحنات الواصل</option>
                                        
                                    </select>
                                </div>
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">الرصيد</label>
                                    <input type="text" class="form-control branch_lah_net" placeholder="الرصيد" aria-label="default input inline 3">

                                </div>
                                <div class="form-control col-span-12 lg:col-span-2 mt-5">
                                    <input type="hidden" id='3amil_print_val' data-title='العميل' data-codes='' value="">
                                    <button type="button" class="btn btn-primary w-24 print" data-type='fro3'>طباعة</button>

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
                المندوب     </h2>
                {{--    <div class="form-check form-switch w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">--}}
                {{--        <label class="form-check-label ml-0" for="show-example-8">العميل</label>--}}
                {{--    </div>--}}
                </div>
                <div id="inline-form" class="p-5">
                    <div class="preview">
                        <div class="grid grid-cols-12 gap-2">
                            <div class="form-control col-span-12 lg:col-span-2 client">
                                <label class="mb-3">اسم المندوب</label>

                                <select data-placeholder="اسم المندوب" class="tom-select w-full mandoub_id_4 mandoub_el" id="crud-form-2" >
                                    <option value="-1">...</option>
                                    <option value="الكل" >الكل</option>
                                    @foreach ($mandoubs as $client)
                                    <option value="{{$client->name_}}" >{{$client->name_}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-control col-span-12 lg:col-span-2">
                                <label class="mb-3">التاريخ من </label>
                                <input type="date" class="form-control date_from_4 mandoub_el" placeholder="التاريخ من " aria-label="default input inline 2">

                            </div>
                            <div class="form-control col-span-12 lg:col-span-2">
                                <label class="mb-3">التاريخ الى</label>
                                <input type="date" class="form-control date_to_4 mandoub_el" placeholder="التاريخ الى" aria-label="default input inline 3">

                            </div>
                            <div class="form-control col-span-12 lg:col-span-2">
                                <label class="mb-3">واصل/ كل الشحنات</label>
                                <select data-placeholder="واصل/ كل الشحنات" class=" w-full waselOnly_4 mandoub_el" id="crud-form-2" >
                                    <option value="all">كل الشحنات</option>
                                    <option value="wasel" >شحنات الواصل</option>
                                    
                                </select>
                            </div>
                            <div class="form-control col-span-12 lg:col-span-2">
                                <label class="mb-3">الرصيد</label>
                                <input type="text" class="form-control mandoub_net" placeholder="الرصيد" aria-label="default input inline 3">

                            </div>
                            <div class="form-control col-span-12 lg:col-span-2 mt-5">
                                <button type="button" class="btn btn-primary w-24 print" data-type='mandoub_taslim'>طباعة</button>

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
                            الديون     </h2>
                        {{--    <div class="form-check form-switch w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">--}}
                        {{--        <label class="form-check-label ml-0" for="show-example-8">العميل</label>--}}
                        {{--    </div>--}}
                    </div>
                    <div id="inline-form" class="p-5">
                        <div class="preview">
                            <div class="grid grid-cols-12 gap-2">
                                
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">رصيد الديون</label>
                                    <input type="text" class="form-control total_raseed" placeholder="الرصيد" aria-label="default input inline 3">
                                    

                                </div>
                                
                                {{-- <div class="form-control col-span-12 lg:col-span-2 mt-5">
                                    <button type="button" class="btn btn-primary w-24">طباعة</button>

                                </div> --}}
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
                            الخزينة     </h2>
                        {{--    <div class="form-check form-switch w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">--}}
                        {{--        <label class="form-check-label ml-0" for="show-example-8">العميل</label>--}}
                        {{--    </div>--}}
                    </div>
                    <div id="inline-form" class="p-5">
                        <div class="preview">
                            <div class="grid grid-cols-12 gap-2">
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">اسم الخزينة</label>

                                    <select data-placeholder="اسم الخزينة" class="tom-select w-full knazna_id khazna_el" id="crud-form-2" >
                                        <option value="-1">...</option>
                                        @foreach ($khaznat as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">التاريخ من </label>
                                    <input type="date" class="form-control " placeholder="التاريخ من " aria-label="default input inline 2">

                                </div>
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">التاريخ الى</label>
                                    <input type="date" class="form-control" placeholder="التاريخ الى" aria-label="default input inline 3">

                                </div> --}}
                                {{-- <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">واصل/ كل الشحنات</label>
                                    <select data-placeholder="واصل/ كل الشحنات" class="tom-select w-full" id="crud-form-2" multiple>
                                        <option value="1" >Sport & Outdoor</option>
                                        <option value="2">PC & Laptop</option>
                                        <option value="3" >Smartphone & Tablet</option>
                                        <option value="4">Photography</option>
                                    </select>
                                </div> --}}
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">الرصيد</label>
                                    <input type="text" class="form-control kazna_net " placeholder="الرصيد" aria-label="default input inline 3">

                                </div>
                                {{-- <div class="form-control col-span-12 lg:col-span-2 mt-5">
                                    <button type="button" class="btn btn-primary w-24">طباعة</button>

                                </div> --}}


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
                            الارباح     </h2>
                       
                    </div>
                    <div id="inline-form" class="p-5">
                        <div class="preview">
                            <div class="grid grid-cols-12 gap-2">
                                
                                <div class="form-control col-span-12 lg:col-span-2">
                                    <label class="mb-3">الرصيد</label>
                                    <input type="text" class="form-control arba7_raseed" placeholder="الرصيد" aria-label="default input inline 3">
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
    let client_net=0;
    let branch_lah_net=0;
    let branch_3leh_net=0;
    let mandoub_net=0;
    let khazna_net=0;

    let print={amil:{
        title:'الشحنات الغير مسددة للعميل', codes:''},
        mandoub:{
        title:'الشحنات الغير مسددة لمندوب التسليم', codes:''},
        fro3:{
        title:'الشحنات الغير مسدده للفرع', codes:''},
        
        fro32:{
        title:'الشحنات الواردة للفرع الغير مسدده', codes:''},
    }
    $('.client_el').on('change', function() {
        var client_id = $('.client_id').val();
        var date_from = $('.date_from').val();
        var date_to = $('.date_to').val();
        var type = ($('.waselOnly').val()=='wasel')?1:'';
        if(client_id =='-1' ) return ;
        $.ajax({
                    url: "{{route('accounting.3amil.notmosadad')}}"+ "?arba7=1&date_from="+date_from+"&date_to="+date_to+"&client_id="+client_id+'&waselOnly='+type,
                    type: "get",
                })
                .done(function (response) {
                    $('.client_net').val(response.sums['netCost'].toLocaleString('en-US'))
                    client_net = response.sums['netCost'];
                    print.amil.codes= response.codes;
                   
                    raseedTotal()
                    arba7Total()
                })
    });

    $('.branch_lah_el').on('change', function() {
        var branch_id = $('.branch_id_2').val();
        var date_from = $('.date_from_2').val();
        var date_to = $('.date_to_2').val();
        var type = ($('.waselOnly_2').val()=='wasel')?1:'';
        if(branch_id =='-1' ) return ;
        $.ajax({
                    url: "{{route('accounting.notmosadad')}}"+ "?arba7=1&date_from="+date_from+"&date_to="+date_to+"&branch_="+branch_id+'&waselOnly='+type,
                    type: "get",
                })
                .done(function (response) {
                    $('.branch_lah_net').val(response.sums['netCost'].toLocaleString('en-US'))
                    branch_lah_net = response.sums['netCost']
                    print.fro3.codes= response.codes;
                    raseedTotal()
                    arba7Total()
                })
    });

    $('.branch_3leh_el').on('change', function() {
        var branch_id = $('.branch_id_3').val();
        var date_from = $('.date_from_3').val();
        var date_to = $('.date_to_3').val();
        var type = ($('.waselOnly_3').val()=='wasel')?1:'';
        if(branch_id =='-1' ) return ;
        console.log(branch_id);
        $.ajax({
                    url: "{{route('frou3.import')}}"+ "?arba7=1&date_from="+date_from+"&date_to="+date_to+"&branch_="+branch_id+'&waselOnly='+type,
                    type: "get",
                })
                .done(function (response) {
                    $('.branch_3leh_net').val(response.sums['netCost'].toLocaleString('en-US'))
                    branch_3leh_net = response.sums['netCost']
                    print.fro32.codes= response.codes;
                    raseedTotal()
                    arba7Total()
                })
    });

    $('.mandoub_el').on('change', function() {
        var branch_id = $('.mandoub_id_4').val();
        var date_from = $('.date_from_4').val();
        var date_to = $('.date_to_4').val();
        var type = ($('.waselOnly_4').val()=='wasel')?1:'';
        if(branch_id =='-1' ) return ;
        $.ajax({
                    url: "{{route('accounting.mandoubtaslim.notmosadad')}}"+ "?arba7=1&date_from="+date_from+"&date_to="+date_to+"&client_id="+branch_id+'&waselOnly='+type,
                    type: "get",
                })
                .done(function (response) {
                    $('.mandoub_net').val(response.sums['netCost'].toLocaleString('en-US'))
                    mandoub_net=response.sums['netCost']
                    print.mandoub.codes= response.codes;
                    raseedTotal()
                    arba7Total()
                })
    });
    $('.khazna_el').on('change', function() {
        var knazna_id = $('.knazna_id').val();
        // var date_from = $('.date_from_6').val();
        // var date_to = $('.date_to_6').val();
        var type = ($('.waselOnly_6').val()=='wasel')?1:'';
        if(knazna_id =='-1' ) return ;
        $.ajax({  
                    url: "{{route('accounting.coppany.kashf_5azna')}}"+ "?arba7=1&khazna_id="+knazna_id,
                    type: "get",
                })
                .done(function (response) {
                    $('.kazna_net').val(response.safiKhazna.toLocaleString('en-US'))
                    khazna_net = response.safiKhazna;
                    arba7Total()
                })
    });
    


    function raseedTotal(){
        if($('.client_net').val()!=''  && $('.branch_3leh_net').val()!=''  && $('.branch_lah_net').val()!=''  && $('.mandoub_net').val()!='' ){
            var net =branch_lah_net +mandoub_net - (client_net+branch_3leh_net);
            var label = 'لنا';
            if(net <0) label ='علينا';
            //Math.abs()
            $('.total_raseed').val((Math.abs(net)).toLocaleString('en-US') + '   '+ label);
        }
    }

    function arba7Total(){
        if($('.client_net').val()!=''  && $('.branch_3leh_net').val()!=''  && $('.branch_lah_net').val()!=''  && $('.mandoub_net').val()!='' && $('.kazna_net').val()!='' ){
            var net =branch_lah_net +mandoub_net - (client_net+branch_3leh_net);
            var arba7 = net + khazna_net;
            var label = 'ربح';
            if(arba7 <0) label ='عجز';
            $('.arba7_raseed').val((Math.abs(arba7)).toLocaleString('en-US') + '   '+ label);
        }
    }


    $('.print').click(function(){
        var type = ($(this).data('type'));
        if(type == '3amil'){
            var code=print.amil.codes;
            var title=print.amil.title;
        }
        if(type == 'fro3'){
            var code=print.fro3.codes;
            var title=print.fro3.title;
        }
        if(type == 'fro32'){
            type = 'fro3'
            var code=print.fro32.codes;
            var title=print.fro32.title;
        }
        if(type == 'mandoub_taslim'){
            var code=print.mandoub.codes;
            var title=print.mandoub.title;
        }
        if(code != '')
        window.open("{{route('opretation-print')}}"+'?codes='+code+'&type='+type+'&title='+title+'&branch_='+'فرع كركوك');

            
        
        
    })
</script>
@endsection
