<!DOCTYPE html>
<!--
Template Name: Midone - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
@php
$companyMainData = \App\Models\CompanyInfo::where('branch_','الفرع الرئيسى')->first();
@endphp
<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="dist/images/logo.svg" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Midone Admin Template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">
        <title>Login - Midone - Tailwind HTML Admin Template</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{asset('css/_app.css')}}" />
        <!-- END: CSS Assets-->
        <style>
            body{
                font-family: 'Cairo', sans-serif !important;

            }
            .login_form{
                margin: auto 0px;
            }
            .w-1\/2 {
                width: 69%;
            }
        </style>
    </head>
    <!-- END: Head -->
    <body class="login">
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col min-h-screen">

                    <div class="my-auto">
                        <img alt="Midone - HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="{{asset('assets/logo/logo.png')}}">
                        <div class="-intro-x text-white font-medium text-2xl leading-tight mt-10">
                          برنامج كاش بوكس لإدارة شركات التوصيل
                            <br>

                        </div>

                         <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">   Powered By <a href="UST.CENTER"> UST.CENTER</a></div>
                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <form method="POST" class="login_form" action="{{ route('login') }}">
                    <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                        <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                            <h2 class="intro-x font-bold text-2xl xl:text-3xl text-right xl:text-right">
                                تسجيل الدخول
                            </h2>
                            <strong>{{ $errors->first('USERNAME') }}</strong>
                            @if($errors->any())
                            {!! implode('', $errors->all('<div class="mt-5 text-danger text-right">:message</div>')) !!}
                        @endif
                            @csrf
                            <div class="intro-x mt-8">
                                <input type="text" class="intro-x login__input form-control py-3 px-4 block" placeholder="اسم المستخدم" name="username">
                                <input type="password" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="كلمة المرور" name="password">
                            </div>
                            <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">


                            </div>
                            <div class="intro-x mt-5 xl:mt-8 text-right xl:text-right">
                                <button class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">دخول</button>
                                {{-- <button class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Register</button> --}}
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END: Login Form -->
            </div>
        </div>
        <!-- BEGIN: Dark Mode Switcher-->
        <div data-url="login-dark-login.html" class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 right-0 box border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">
            <div class="mr-4 text-slate-600 dark:text-slate-200">Dark Mode</div>
            <div class="dark-mode-switcher__toggle border"></div>
        </div>
        <!-- END: Dark Mode Switcher-->

        <!-- BEGIN: JS Assets-->
        <script src="{{asset('js/app.js')}}"></script>
        <!-- END: JS Assets-->
    </body>
</html>