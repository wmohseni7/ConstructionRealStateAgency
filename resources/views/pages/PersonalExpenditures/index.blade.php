@extends('layouts.master')
@section('content')

  {{-- home expenditures collapse --}}
  <div class="row collapse" id="collapsable" >
    <div class="col-lg-12">
        <div class="card-box">
            <center>
                <h3 class=" m-t-0 m-b-30" id="HomeExpTitle">ثبت مصرف جدید</h3>
            </center>
            <div class="row" style="display: flex; justify-content: center;">
                <div class="row col-12 col-sm-12 col-md-10 col-lg-8">
                    <form id="HomeExpForm" >
                        @csrf
                        <input type="hidden" class="form-group" id="agencyHomeExp_id" name="agencyHomeExp_id">
                        <div class="form-group col-md-6 col-lg-6 col-xl-6" >
                            <label for="agency_id">نمایندگی </label>
                            <select  name="agency_id" id="agency_id" class="form-control dropdown-toggle">
                                <option selected disabled id="disabledOption " > نمایندگی مورد نظر را انتخاب کنید</option>
                                @foreach ($agencies as $agency)
                                    <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group  col-md-6 col-md-6 col-lg-6 col-xl-6 ">
                            <label for="sender">فرستنده</label>
                            <input type="text" id="sender" name="sender" type="text" placeholder="اسم فرستنده را وارد کنید" required
                                class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-md-6 col-lg-6 col-xl-6 ">
                            <label for="receiver">گیرنده</label>
                            <input type="text" id="receiver" name="receiver" type="text" placeholder="اسم گیرنده را وارد کنید" required
                                class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-md-6 col-lg-6 col-xl-6 ">
                            <label for="amount">مبلغ </label>
                            <input type="number" id="amount" type="text" name="amount" parsley-trigger="change" required
                                placeholder="مقدار مصرف را وارد کنید" class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-md-6 col-lg-6 col-xl-6 ">
                            <label for="date">تاریخ </label>
                            <input id="date" type="date" name="date" parsley-trigger="change" required
                            class="form-control">
                        </div>
                        <div class="form-group  col-md-12 col-lg-12 col-xl-12 ">
                            <label for="description">توضیحات </label>
                                <textarea id="description" class="form-control" name="description" rows="3" style="resize: none" placeholder="توضیحات مصرف را وارد کنید"></textarea>
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
            <button class="btn-rounded btn-primary fa fa-plus-circle" data-toggle="collapse" data-target="#collapsable" style="float: left"> &nbsp;&nbsp;ثبت مصرف جدید
            </button>
            
            <h4 class="header-title m-t-0 m-b-30"><span class="fa fa-list-ul"></span>&nbsp &nbspلیست مصارف خانه </h4>
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>شماره</th>
                        <th>نمایندگی</th>
                        <th>فرستنده</th>
                        <th>گیرنده</th>
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
    @include('pages.PersonalExpenditures.js')
@endpush