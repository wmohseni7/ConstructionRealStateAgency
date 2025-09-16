@extends('layouts.master')
@section('content')
{{-- property registeration collapse --}}
<div class="row collapse" id="collapsable" >
    <div class="col-lg-12">
        <div class="card-box" >
            <center>
                <h3 class="m-t-0 m-b-30" id="PropertiesTitle">
                    ثبت خانه جدید
                </h3>
            </center>
            <div class="row" style="display: flex; justify-content: center;">
                <div class="row col-12 col-sm-12 col-md-10 col-lg-8"  >
                    <form id="propertiesForm" enctype="multipart/form-data" >
                        @csrf
                        <input type="hidden" class="form-group" id="property_id" name="property_id">
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="agency_id">نمایندگی ها </label>
                            <select name="agency_id" id="agency_id" class="btn btn-default form-control dropdown-toggle">
                                <option selected disabled id="propertyDisabledItem">نمایندگی مورد نظر را انتخاب کنید</option>
                                @foreach ($agencies as $agency)
                                    <option value="{{ $agency->id }}">{{ $agency->name }}</option>                                
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="name">اسم خانه </label>
                            <input id="name" type="text" name="name" parsley-trigger="change" required
                                placeholder="اسم خانه را وارد کنید" class="form-control">
                        </div>

                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="address">آدرس </label>
                            <input id="address" type="tel" name="address" parsley-trigger="change"
                                placeholder="آدرس خانه را وارد کنید" class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="floor">تعداد طبقات </label>
                            <input id="floor" type="number" name="floor" parsley-trigger="change" required
                                placeholder="تعداد طبقات را وارد کنید" class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="apartment">تعداد واحد ها</label>
                            <input id="apartment" type="number" name="apartment" parsley-trigger="change" required
                                placeholder="تعداد واحد ها را وارد کنید " class="form-control">
                        </div>
                        <div class="form-group text-right col-lg-12" style="margin-left:10px !important">
                            <button id="saveOrUpdate" type="button" class="btn btn-primary btn-rounded waves-effect waves-light" >
                                ثبت
                            </button>              
                            <button type="reset" data-toggle="collapse" data-target="#collapsable"  class="btn-danger collapse btn-rounded btn btn-default waves-effect waves-light">
                                بستن
                            </button>
                        </div>
                    </form>
                </div>  
            </div>    
        </div>
    </div>
</div>






{{-- property registeration datatable --}}
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive" >
            <button class="fa fa-plus-circle btn-rounded btn-primary " data-toggle="collapse" data-target="#collapsable" id="agencyIncomeCollapse" style="float: left">&nbsp &nbspثبت خانه جدید 
            </button>
            
            <h4 class="header-title m-t-2 m-b-30"><span class="fa fa-list-ul"></span>&nbsp &nbspلیست خانه های ثبت شده</h4>
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>شماره</th>
                        <th>نمایندگی</th>
                        <th>اسم خانه</th>
                        <th>تعداد طبقات</th>
                        <th>تعداد واحد ها</th>
                        <th>آدرس</th>
                        <th colspan="3" style="padding: 0%"><center> عملیه ها</center></th>
                    </tr>
                </thead>

                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@push('js')
    @include('pages.Properties.js');
@endpush