@extends('layout.app')

@section('content')
<div class="content">
                <!-- BEGIN: Top Bar -->

                <!-- END: Top Bar -->
    <!-- BEGIN: Top Bar -->
@include('layout.partial.topbar')
<!-- END: Top Bar -->
    <div class="intro-y   mt-8" >
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
                <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
                    <!-- BEGIN: Post Content -->
                    <div class="intro-y col-span-12 lg:col-span-8">

                        <div class="post intro-y overflow-hidden box mt-5">

                            <div class="post__content tab-content">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                <div id="content" class="tab-pane p-5 active" role="tabpanel" aria-labelledby="content-tab">
                                    <div class="mt-3">
                                        <label for="regular-form-2" class="form-label">الاسم </label>
                                        <input id="regular-form-2" name="name" type="text" class="form-control" >
                                    </div>
                                    <div class="mt-3">

                                        <label for="regular-form-1" class="form-label">الاعلان</label>
{{--                                        @if ($company->image_data)--}}
                                            <img src="" height="80px" alt="" class="ml-auto" style="height: 80px!important; margin-bottom: 30px">
{{--                                        @endif--}}
                                        <input type="file" name="ads" class="form-control credit-card-mask" placeholder="الشعار"  />
                                        @error('logo')<span class="text-danger"></span>@enderror </div>




							    <button class="btn btn-primary mt-5">حفظ</button>
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
@endsection
