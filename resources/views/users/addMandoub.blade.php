@extends('layout.app')

@section('content')
<div class="content">
                <!-- BEGIN: Top Bar -->
                @include('layout.partial.topbar')
                <!-- END: Top Bar -->
                
                <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
                    <!-- BEGIN: Post Content -->
                    <div class="intro-y col-span-12 lg:col-span-8">
                        
                        <div class="post intro-y overflow-hidden box mt-5">
                            
                            <div class="post__content tab-content">
                                <div id="content" class="tab-pane p-5 active" role="tabpanel" aria-labelledby=	"content-tab">
                                    <div class="form-inline">
                                        <label for="date" class="form-label sm:w-20">اسم العميل</label>
                                        <div class="grid grid-cols-12 gap-2"> 
                                            <input type="text" class="form-control col-span-4"   aria-label="default input inline 1"> 
                                        </div> 
                                    </div>

                                    <div class="form-inline mt-3">
                                        <label for="date" class="form-label sm:w-20">الاسم التجارى</label>
                                        <div class="grid grid-cols-12 gap-2"> 
                                             
                                            <select class="form-control col-span-4"> 
                                                <option value=""> </option>
                                            </select>
                                        </div> 
                                    </div>
                                  
                                   <div class="form-inline mt-3">
                                    <label for="date" class="form-label sm:w-20">الوظيفة</label>
                                    <div class="grid grid-cols-12 gap-2"> 
                                         
                                        <select class="form-control col-span-4"> 
                                            <option value=""> </option>
                                        </select>
                                    </div> 
                                </div>
                                    <div class="form-inline mt-3">
                                        <label for="username" class="form-label sm:w-20">اسم المستخدم</label>
                                        <input id="username" type="text" class="form-control"  name='username' autocomplete="off"/>
                                    </div>
                                    <div class="form-inline mt-3">
                                        <label for="password" class="form-label sm:w-20">الباسورد</label>
                                        <input id="password" type="password" class="form-control"   name='password'/>
                                    </div>
                                    <div class="form-inline mt-3">
                                        <label for="date" class="form-label sm:w-20">رقم الهوية</label>
                                        <div class="grid grid-cols-12 gap-2"> 
                                            <input type="text" class="form-control col-span-4"   aria-label="default input inline 1"> 
                                            <label for="date" class="form-label col-span-4" style="text-align: left; margin-top:8px;">رقم الاهاتف</label>
                                            <input type="text" class="form-control col-span-4"   aria-label="default input inline 1"> 
                                        </div> 
                                    </div>
                                    <div class="form-inline mt-3">
                                        <label for="phone" class="form-label sm:w-20">عنوان العميل</label>
                                        <input id="phone" type="text" class="form-control"  />
                                    </div>
                                    <div class="form-inline mt-3">
                                        <label for="date" class="form-label sm:w-20">المحافظة</label>
                                        <div class="grid grid-cols-12 gap-2"> 
                                            <select class="form-control col-span-4"> 
                                                <option value=""> </option>
                                            </select>
                                            <label for="date" class="form-label col-span-4" style="text-align: left; margin-top:8px;">المفتاح</label>
                                            <input type="text" class="form-control col-span-4"   aria-label="default input inline 1"> 
                                        </div> 
                                    </div>
                                    <div class="form-inline mt-3">
                                        <label for="mo7afaza" class="form-label sm:w-20">المحافظة</label>
                                        <input id="mo7afaza" type="text" class="form-control"  />
                                    </div>
                                    <div class="form-inline mt-3">
                                        <label for="horizontal-form-1" class="form-label sm:w-20">المنطقة</label>
                                        <input id="horizontal-form-1" type="text" class="form-control"  />
                                    </div>
                                    

                                   
                                   
                                   
                                    <div class="sm:ml-20 sm:pl-5 mt-5">
                                        <button class="btn btn-primary">حفظ</button>
                                    </div>
							    </div>
							                         
							</div>
                        </div>
                    </div>
                    <!-- END: Post Content -->
                    <!-- BEGIN: Post Info -->
                    
                    <!-- END: Post Info -->
                </div>
</div>
@endsection
