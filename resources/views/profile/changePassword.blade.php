@extends('layout.app')

@section('content')
<div class="content">
                <!-- BEGIN: Top Bar -->
                @include('layout.partial.topbar')

                <!-- END: Top Bar -->
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
    <div class="grid grid-cols-12 gap-6">

        <div class="col-span-12 lg:col-span-12 2xl:col-span-12">
            <!-- BEGIN: Change Password -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base ml-auto">
                       تغير كلمة المرور
                    </h2>
                </div>
                <div class="p-5">
                    <form action="{{route("passwordChange.store")}}" method="POST">
                        @csrf
                    <div>
                        <label for="change-password-form-1" class="form-label">كلمة المرور الحالية</label>
                        <input id="change-password-form-1" type="password" name="old_password" class="form-control" placeholder="">
                    </div>
                    <div class="mt-3">
                        <label for="change-password-form-2" class="form-label">كلمة المرور الجديد</label>
                        <input id="change-password-form-2" name="password" type="password" class="form-control" placeholder="">
                    </div>
                    <div class="mt-3">
                        <label for="change-password-form-3"  class="form-label">تاكيد كلمة المرور</label>
                        <input id="change-password-form-3" name="confirm_password" type="password" class="form-control" placeholder="">
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">حفظ</button>
                    </form>
                </div>
            </div>
            <!-- END: Change Password -->
        </div>
    </div>
</div>
@endsection
