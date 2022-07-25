@extends('layout.app')
<style>
    .Khazna .ts-dropdown{
        position: relative !important;
    }
</style>
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.3/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.3/dist/js/tom-select.complete.min.js"></script>
    <div class="content">
        <!-- BEGIN: Top Bar -->
    @include('layout.partial.topbar')
    <!-- END: Top Bar -->


        <div class="col-md-12 col-md-offset-2">

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
            @if($errors->any())
                <div class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif



            <div class="intro-y col-span-12 lg:col-span-8">

                <div class="post intro-y overflow-hidden box mt-5">

                    <div class="post__content tab-content">
                        <div id="content" class="tab-pane p-5 active" role="tabpanel" aria-labelledby=	"content-tab">
                            <form method="post" action="{{ route('accounting.coppany.SaveSanad') }}" role="form">
                                {!! csrf_field() !!}
                                <input type="hidden" value="صرف" name="page_type">
                                <div class="mt-3">
                                    <label for="regular-form-2" class="form-label">تاريخ السند</label>
                                    <input id="regular-form-2" value="{{Carbon\Carbon::now()->format('Y-m-d  g:i:s A')}}"  type="text" class="form-control" disabled >
                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-2" class="form-label">نوع المستفيد</label>
                                    <select  id='mostafed_type' class="form-control mostafed_type" name="mostafed_type">
                                        <option value="">...</option>
                                        <option value="عميل">عميل</option>
                                        <option value="مندوب">مندوب</option>
                                        <option value="فرع">فرع</option>
                                        <option value="مصاريف">مصاريف</option>
                                        <option value="اخرى">اخرى</option>

                                    </select>

                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-2" class="form-label">المستفيد</label>
                                    <select  id='mostafed_name' class="form-control mostafed_name" name="mostafed_name">
                                        <option value=""></option>

                                    </select>

                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-2" class="form-label">الخزنة</label>
                                    <select  id='khazna_id' class="form-control mostafed_name" name="khazna_id">
                                       
                                        @foreach($khaznat as $khazna)
                                            <option value="{{$khazna->id}}"  >{{$khazna->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="mt-3">
                                    <label for="regular-form-2" class="form-label">المبلغ</label>
                                    <input id="regular-form-2"  type="text" class="form-control" name="amount" >
                                </div>
                                <button class="btn btn-primary mt-5">Save</button>
                            </form>
                        </div>


                    </div>

                </div>
            </div>
        </div>



    </div>

    <script type="text/javascript">
        var mostafed_name =new TomSelect("#mostafed_name",{
            valueField: 'id',
            labelField: 'title',
            searchField: 'title',
            create: false
        });
        var mostafed_type =new TomSelect("#mostafed_type",{
            valueField: 'id',
            labelField: 'title',
            searchField: 'title',
            create: false
        });


        $('#mostafed_type').change(function () {
            var selectedVal = $("#mostafed_type option:selected").val();

            // AJAX request
            $.ajax({
                url: "{{route('accounting.coppany.mostafed_name')}}"+"?mostafed_type="+selectedVal,
                type: 'get',
                data: "json",
                success: function (data) {
                    // $('select[name="mostafed_name"]').empty();
                    // $('select[name="mostafed_name"]').append('<option value="">اختار اسم المستفيد</option>')
                    mostafed_name.clearOptions();


                    $.each(data.data, function (key, value) {
                        // console.log(value.code_);
                        mostafed_name.addOption({
                            id: value.code_,
                            title: value.name_,

                        });
                    });

                }
            });
        });
    </script>

@endsection
