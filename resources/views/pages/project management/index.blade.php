@extends('layouts.master')
@section('content')
{{-- insert projects collapse --}}
<div class="row collapse" id="collapsable" >
    <div class="col-lg-12">
        <div class="card-box">
            <center>
                <h3 class=" m-t-0 m-b-30" id="projectManagementTitle">ثبت پروژه جدید</h3>
            </center>
            <div class="row" style="display: flex; justify-content: center;">
                <div class="col-12 col-sm-12 col-md-10 col-lg-8" >
                    <form id="ProjectsForm" >
                        @csrf
                        <input type="hidden" id="project_id" name="project_id">
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="agency_id">انتخاب نمایندگی</label>
                            <select type="button" name="agency_id" id="agency_id" class="btn btn-default form-control dropdown-toggle">
                                <option selected disabled> نمایندگی را انتخاب کنید</option>
                                @foreach ($agencies as $agency )
                                    <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="name"> اسم پروژه</label>
                            <input id="name" type="text" type="text" name="name" parsley-trigger="change" required
                                placeholder="اسم پروژه را وارد کنید" class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="address">آدرس</label>
                            <input id="address" type="text" name="address" placeholder="آدرس پروژه را وارد کنید" required
                                class="form-control">
                        </div>
                        <div class="form-group mt-5">
                            <div class="form-group  col-md-6 col-lg-6 col-xl-6">
                                <label for="type">نوعیت پروژه </label>
                                <select Type="button" name="type" id="type" class="btn btn-default form-control dropdown-toggle">
                                    <option selected disabled> انتخاب کنید</option>
                                    <option value="1">شخصی</option>
                                    <option value="0">اجاره‌ای</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="area">مساحت </label>
                            <input id="area" type="number" name="area" parsley-trigger="change" required
                                placeholder="مقدار را وارد کنید" class="form-control">
                        </div>
                        <div class="form-group mt-5">
                            <div class="form-group  col-md-6 col-lg-6 col-xl-6">
                                <label for="unit">واحد  </label>
                                <select type="button" name="unit" id="unit" class="btn btn-default form-control dropdown-toggle">
                                    <option selected disabled> انتخاب کنید</option>
                                    <option value="1">متر</option>
                                    <option value="0">متر مربع</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="floor">طبقه </label>
                            <input id="floor" type="number" name="floor" parsley-trigger="change" required
                                placeholder="مقدار را وارد کنید" class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="apartment">آپارتمان(در هر طبقه) </label>
                            <input id="apartment" type="number" name="apartment" parsley-trigger="change" required
                                placeholder="مقدار را وارد کنید" class="form-control">
                        </div>
                        <div class="form-group mt-5">
                            <div class="form-group  col-md-6 col-lg-6 col-xl-6">
                                <label for="unitPrice">قیمت فی واحد متراژ پروژه </label>
                                <input type="text" id="unitPrice" name="unitPrice" class="form-control">
                            </div>
                        </div>
                        <div class="form-group mt-5">
                            <div class="form-group  col-md-6 col-lg-6 col-xl-6">
                                <label for="total">قیمت مجموع </label>
                                <input type="text" id="total" name="total" class="form-control">
                            </div>
                        </div>
                        <div class="form-group mt-5">
                            <div class="form-group  col-md-6 col-lg-6 col-xl-6">
                                <label for="paid">مقدار پرداخت شده </label>
                                <input type="text" id="paid" name="paid" class="form-control">
                            </div>
                        </div>
                        <div class="form-group mt-5">
                            <div class="form-group  col-md-6 col-lg-6 col-xl-6">
                                <label for="remain">مقدار باقی </label>
                                <input type="text" id="remain" name="remain" class="form-control">
                            </div>
                        </div>
                        <div class="form-group mt-5">
                            <div class="form-group  col-md-6 col-lg-6 col-xl-6">
                                <label for="date">تاریخ </label>
                                <input type="date" id="date" name="date" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-lg-12 col-xl-12">
                            <label for="description">توضیحات</label>
                            <textarea class="form-control" name="description" id="description" rows="9" style="resize: none" placeholder="توضیحات پروژه را وارد کنید"></textarea>
                        </div>
                        <div class="form-group col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group text-right " style="margin-left:10px !important">
                                <button id="saveOrUpdate" class="btn btn-primary btn-rounded waves-effect waves-light" >
                                    ثبت
                                </button>              
                                <button type="reset" data-toggle="collapse" data-target="#collapsable"  class="btn-danger btn-rounded btn btn-default waves-effect waves-light ">
                                    بستن
                                </button>
                            </div>
                        </div>
    
                    </form>
                </div>
            </div>  
        </div>
    </div>
</div>






{{-- projects datatable --}}
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive" >
            <button class="btn-rounded btn-primary fa fa-plus-circle" data-toggle="collapse" data-target="#collapsable" id="agencyIncomeCollapse" style="float: left">&nbsp;&nbsp; ثبت پروژه جدید
            </button>
            
            <h4 class="header-title m-t-2 m-b-30"><span class="fa fa-list-ul"></span>&nbsp &nbspلیست پروژه های ثبت شده</h4>
            <table id="datatable" class="table table-striped table-bordered">
                <thead> 
                    <tr>
                        <th>شماره</th>
                        <th>نمایندگی</th>
                        <th>اسم</th>
                        <th>آدرس</th>
                        <th>نوعیت </th>
                        <th>مساحت</th>
                        <th>واحد</th>
                        <th>قیمت واحد</th>
                        <th>مجموع</th>
                        <th>پرداخته</th>
                        <th>باقی</th>
                        <th>تاریخ</th>
                        <th>توضیحات</th>
                        <th colspan="4">عملیه ها</th>
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
    @include('pages.project management.js');
@endpush