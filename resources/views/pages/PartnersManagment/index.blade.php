@extends('layouts.master')
@section('content')
 {{-- partners collapse --}}
    <div class="row collapse" id="collapsable" >
        <div class="col-lg-12">
            <div class="card-box">
                <center>
                    <h3 class=" m-t-0 m-b-30" id="partner_title">ثبت شریک جدید</h3>
                </center>
                <div class="row" style="display: flex; justify-content: center;">
                    <div class="row col-12 col-sm-12 col-md-10 col-lg-8">
                        <form id="partnerForm" >
                            @csrf
                            <input type="hidden" class="form-group" id="partner_id" name="partner_id">
                        
                            <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                                <label for="name">اسم </label>
                                <input id="name" type="text" name="name" parsley-trigger="change" required
                                    placeholder="اسم شریک را وارد کنید" class="form-control">
                            </div>
                            <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                                <label for="last_name">تخلص </label>
                                <input id="last_name" type="text" name="last_name" parsley-trigger="change" required
                                    placeholder="تخلص شریک را وارد کنید" class="form-control">
                            </div>
                            <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                                <label for="phone_number">شماره تماس </label>
                                <input id="phone_number" type="tel" name="phone_number" parsley-trigger="change" required
                                    placeholder="شماره تماس شریک را وارد کنید" class="form-control">
                            </div>
                            <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                                <label for="email">ایمیل </label>
                                <input id="email" type="email" name="email" parsley-trigger="change" required
                                    placeholder="ایمیل شریک را وارد کنید" class="form-control">
                            </div>  
                            <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                                <label for="address">آدرس </label>
                                <input id="address" type="text" name="address" parsley-trigger="change" required
                                    placeholder="محل سکونت شریک را وارد کنید" class="form-control">
                            </div>
                            <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                                <label for="date">تاریخ </label>
                                <input id="date" type="date" name="date" parsley-trigger="change" required
                                class="form-control">
                            </div>
                            <div class="form-group  col-md-12 col-lg-12 col-xl-12 ">
                                <label for="description">توضیحات </label>
                                    <textarea id="description" class="form-control" name="description" rows="3" style="resize: none" placeholder="توضیحات شریک را وارد کنید"></textarea>
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
                <button class="btn-rounded btn-primary fa fa-plus-circle" data-toggle="collapse" data-target="#collapsable" style="float: left"> &nbsp;&nbsp;ثبت شریک جدید
                </button>
                
                <h4 class="header-title m-t-0 m-b-30"><span class="fa fa-list-ul"></span>&nbsp &nbspلیست شرکا</h4>
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>شماره</th>
                            <th>اسم </th>
                            <th>تخلص </th>
                            <th>شماره تماس</th>
                            <th>ایمیل</th>
                            <th>آدرس</th>
                            <th>تاریخ</th>
                            <th>توضیحات</th>
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
    @include('pages.PartnersManagment.js')
@endpush