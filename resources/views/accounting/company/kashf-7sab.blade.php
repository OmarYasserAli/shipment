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
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-6">
                <!-- BEGIN: Form Layout -->
                 <!-- BEGIN: Inline Form -->
<div class="intro-y box mt-5">
<div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
    <h2 class="font-medium text-base mr-auto">
العميل    </h2>
    <div class="form-check form-switch w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
        <label class="form-check-label ml-0" for="show-example-8">العميل</label>
    </div>
</div>
<div id="inline-form" class="p-5">
    <div class="preview">
        <div class="grid grid-cols-12 gap-2">
            <div class="form-control col-span-2">
        
                <select data-placeholder="اسم العميل" class="tom-select w-full" id="crud-form-2" multiple>
                    <option value="1" selected>Sport & Outdoor</option>
                    <option value="2">PC & Laptop</option>
                    <option value="3" selected>Smartphone & Tablet</option>
                    <option value="4">Photography</option>
                </select>
            </div>
            <input type="date" class="form-control col-span-2" placeholder="التاريخ من " aria-label="default input inline 2">
            <input type="date" class="form-control col-span-2" placeholder="التاريخ الى" aria-label="default input inline 3">
            <div class="form-control col-span-2">
        
                <select data-placeholder="واصل/ كل الشحنات" class="tom-select w-full" id="crud-form-2" multiple>
                    <option value="1" selected>Sport & Outdoor</option>
                    <option value="2">PC & Laptop</option>
                    <option value="3" selected>Smartphone & Tablet</option>
                    <option value="4">Photography</option>
                </select>
            </div>
            <input type="text" class="form-control col-span-2" placeholder="الرصيد" aria-label="default input inline 3">
            <div class="form-control col-span-2">
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


@endsection