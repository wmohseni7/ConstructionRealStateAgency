@extends('layouts.master')
@section('content')
{{-- insert projects collapse --}}
<div class="row collapse" id="collapsable" >
    <div class="col-lg-12">
        <div class="card-box">
            <center>
                <h3 class=" m-t-0 m-b-30" id="projectManagementTitle">ثبت کمپنی جدید</h3>
            </center>
            <div class="row" style="display: flex; justify-content: center;">
                <div class="col-12 col-sm-12 col-md-10 col-lg-8" >
                    <form id="companiesForm" >
                        @csrf
                        <input type="hidden" id="company_id" name="company_id">
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="agency_id">انتخاب نمایندگی</label>
                            <select type="button" name="agency_id" id="agency_id" class="btn btn-default form-control dropdown-toggle">
                                <option id="disabled" disabled selected>نمایندگی را انتخاب کنید</option>
                                @foreach ( $Agency as $item )
                                    <option id="selectedOption" value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="name"> اسم کمپنی</label>
                            <input id="name" type="text" type="text" name="name" parsley-trigger="change" required
                                placeholder="اسم کمپنی را وارد کنید" class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="phone_number">شماره تماس</label>
                            <input id="phone_number" type="tel" name="phone_number" placeholder="شماره تماس کمپنی را وارد کنید" required
                                class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="address">آدرس</label>
                            <input id="address" type="text" name="address" placeholder="آدرس کمپنی را وارد کنید" required
                                class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="owner">صاحب امتیاز</label>
                            <input id="owner" type="text" name="owner" placeholder="اسم صاحب امتیاز کمپنی را وارد کنید" required
                                class="form-control">
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
            <button class="btn-rounded btn-primary fa fa-plus-circle" data-toggle="collapse" data-target="#collapsable" id="agencyIncomeCollapse" style="float: left">&nbsp; ثبت کمپنی جدید 
            </button>
            
            <h4 class="header-title m-t-2 m-b-30"><span class="fa fa-list-ul"></span>&nbsp &nbspلیست کمپنی های ثبت شده</h4>
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>شماره</th>
                        {{-- <th>نمایندگی</th> --}}
                        <th>اسم شرکت</th>
                        <th>شماره تماس</th>
                        <th>آدرس شرکت </th>
                        <th>صاحب امتیاز</th>
                        <th colspan="2" style="padding: 0%">عملیات</th>
               
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
    @include('pages.Companies.js');
@endpush