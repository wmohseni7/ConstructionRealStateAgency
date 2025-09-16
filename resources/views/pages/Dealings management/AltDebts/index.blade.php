@extends('layouts.master')
@section('content')
{{-- Alternative claims collapse --}}
<div class="row collapse " id="collapsable" >
    <div class="col-lg-12">
        <div class="card-box">
            <center>
                <h3 class=" m-t-0 m-b-30" id="AltDebts_title">ثبت قرض جدید</h3>
            </center>
            <div class="row" style="display: flex; justify-content: center;">
                <div class="row col-12 col-sm-12 col-md-10 col-lg-8">
                    <form id="AltDebtsForm" >
                        @csrf
                        <input type="hidden" id="toEdit_id" name="toEdit_id">
                        <div class="form-group  col-md-6 col-md-6 col-lg-6 col-xl-6 ">
                            <label for="name">اسم شخص</label>
                            <input type="text" id="name" name="name" placeholder="اسم شخص را وارد کنید" required
                                class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-md-6 col-lg-6 col-xl-6 ">
                            <label for="amount">مبلغ قرض</label>
                            <input id="amount" name="amount" type="number" placeholder="مبلغ قرض را وارد کنید" required
                                class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-md-6 col-lg-6 col-xl-6 ">
                            <label for="date">تاریخ</label>
                            <input id="date" name="date" type="date" placeholder="مبلغ قرض را وارد کنید" required
                                class="form-control">
                        </div>
                        <div class="form-group  col-md-12 col-lg-12 col-xl-12 ">
                            <label for="description">توضیحات </label>
                                <textarea id="description" class="form-control" name="description" rows="3" style="resize: none" placeholder="توضیحات قرض را وارد کنید"></textarea>
                        </div>
                        <div class="row col-lg-12">
                            <div class="form-group text-right ">
                                <button id="saveOrUpdate" class="btn btn-primary btn-rounded waves-effect waves-light" >
                                    ثبت
                                </button>              
                                <button type="reset" data-toggle="collapse" data-target="#collapsable"  class="btn-danger collapse btn-rounded btn btn-default waves-effect waves-light">
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
            <button class="btn-rounded btn-primary fa fa-plus-circle" data-toggle="collapse" data-target="#collapsable" style="float: left">&nbsp;&nbsp; ثبت قرض جدید
            </button>
            
            <h4 class="header-title m-t-0 m-b-30"><span class="fa fa-list-ul"></span>&nbsp &nbspلیست قروض جانبی </h4>
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>شماره</th>
                        <th>اسم شخص</th>
                        <th>مبلغ</th>
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
    @include('pages.Dealings management.AltDebts.js')
@endpush