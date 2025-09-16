@extends('layouts.master')
@section('content')
{{-- partners collapse --}}
<div class="row collapse" id="collapsable" >
    <div class="col-lg-12">
        <div class="card-box">
            <center>
                <h3 class=" m-t-0 m-b-30" id="EmployeesTitle">ثبت کارمند جدید</h3>
            </center>
            <div class="row" style="display: flex; justify-content: center;">
                <div class="row col-12 col-sm-12 col-md-10 col-lg-8">
                    <form id="EmployeeForm" >
                        @csrf
                        <input type="hidden" class="form-group" id="Employee_id" name="Employee_id">
                        <div class="form-group col-md-6 col-lg-6 col-xl-6">
                            <label for="agency">نمایندگی</label>
                            <select name="agency" id="agency"  class="form-control">
                                <option selected disabled>نمایندگی را انتخاب کنید</option>
                                @foreach ( $agencies as $agency )
                                    <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-lg-6 col-xl-6">
                            <label for="project">پروژه</label>
                            <select name="project" id="project"  class="form-control">
                                <option selected disabled>پروژه را انتخاب کنید</option>
                                @foreach ( $projects as $project )
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="name">اسم </label>
                            <input id="name" type="text" name="name" parsley-trigger="change" required
                                placeholder="اسم کارمند را وارد کنید" class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="phone_number">شماره تماس </label>
                            <input id="phone_number" type="tel" name="phone_number" parsley-trigger="change" required
                                placeholder="شماره تماس کارمند را وارد کنید" class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="address">آدرس </label>
                            <input id="address" type="text" name="address" parsley-trigger="change" required
                                placeholder="محل سکونت کارمند را وارد کنید" class="form-control">
                        </div>
                        <div class="form-group col-md-6 col-lg-6 col-xl-6">
                            <label for="title">عنوان شغل</label>
                            <select name="title" id="title"  class="form-control">
                                <option selected disabled>عنوان شغل را انتخاب کنید</option>
                                <option value="1">سرکارگر</option>
                                <option value="2">کارگر نیمه وقت</option>
                                <option value="3">کارگر تمام وقت</option>
                            </select>
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="total">مقدار قرارداد </label>
                            <input id="total" type="number" name="total" parsley-trigger="change" required
                                placeholder="مقدار معاش کارمند را وارد کنید" class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="paid">پرداخت شده </label>
                            <input id="paid" type="number" name="paid" parsley-trigger="change" required
                                placeholder="مقدار پرداخت شده را وارد کنید" class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="remain">باقی </label>
                            <input id="remain" type="number" name="remain" parsley-trigger="change" required
                                placeholder="مقدار باقی را وارد کنید" class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="date">تاریخ </label>
                            <input id="date" type="date" name="date" parsley-trigger="change" required
                            class="form-control">
                        </div>
                        <div class="row col-lg-12">
                            <div class="form-group text-right " style="margin-left:10px !important">
                                <button id="saveOrUpdate" class="btn btn-primary btn-rounded waves-effect waves-light" >
                                    ثبت
                                </button>              
                                <button type="reset" data-toggle="collapse" data-target="#collapsable"  class="btn-danger collapse btn-rounded btn btn-default waves-effect waves-light m-l-5">
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

{{-- datatable --}}
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive" >
            <button class="btn-rounded btn-primary fa fa-plus-circle" data-toggle="collapse" data-target="#collapsable" style="float: left"> &nbsp;&nbsp;ثبت کارمند جدید
            </button>
            
            <h4 class="header-title m-t-0 m-b-30"><span class="fa fa-list-ul"></span>&nbsp &nbspلیست کارمندان</h4>
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>شماره</th>
                        <th>نمایندگی </th>
                        <th>پروژه  </th>
                        <th>اسم کارمند</th>
                        <th>شماره تماس</th>
                        <th>آدرس</th>
                        <th>عنوان</th>
                        <th>مجموع معاش</th>
                        <th>پرداخت شده</th>
                        <th>باقی</th>
                        <th>تاریخ</th>
                        <th colspan="2" style="padding: 0%">عملیه ها</th>
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
    @include('pages.EmployeesManagement.js')
@endpush