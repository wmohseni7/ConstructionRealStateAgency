@extends('layouts.master')
@section('content')
{{-- dealed property payment collapse --}}
<div class="row collapse" id="collapsable" >
    <div class="col-lg-12">
        <div class="card-box">
            <center>
                <h3 class=" m-t-0 m-b-30" id="dealershipTitle">ثبت پرداختی </h3>
            </center>
            <div class="row" style="display: flex; justify-content: center;" >
                <div class="row col-12 col-sm-12 col-md-10 col-lg-8">
                    <form id="dealershipPaymentForm" enctype="multipart/form-data" >
                        @csrf
                        <input type="hidden" class="form-group form-control col-lg-12" id="editdealedProperty_id" name="editdealedProperty_id" >
                        <input id="dealership_id" name="dealership_id" class="form-control" type="hidden" value="{{ $dealedProperty->id }}">
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="name">نام خانه </label>
                            <input id="name" name="name" class="form-control" readonly type="text" value="{{ $dealedProperty->name }}">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="total">مقدار کرایه/گروی </label>
                            <input id="total" name="total" parsley-trigger="change" readonly required
                              class="form-control" value="{{ $dealedProperty->amount }}">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="date">تاریخ </label>
                            <input type="date" id="date" name="date" parsley-trigger="change" required
                              class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="paid">پرداخت شده</label>
                            <input id="paid" type="number" name="paid" parsley-trigger="change" required
                                value="" class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="remain">باقی</label>
                            <input id="remain" readonly type="number" name="remain" parsley-trigger="change" required
                                value=""  class="form-control">
                        </div>
                        <div class="form-group text-right col-lg-12">
                            <button id="saveOrUpdate" type="submit" class="btn btn-primary btn-rounded waves-effect waves-light">
                                ثبت
                            </button>              
                            <button type="reset" data-toggle="collapse" data-target="#collapsable"  class="btn-danger collapse btn-rounded btn btn-default waves-effect waves-light m-l-5">
                                بستن
                            </button>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
    </div>
</div>

{{-- Deals property payment datatable --}}
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive" >
            <button class="btn-rounded btn-primary fa fa-plus-circle" data-toggle="collapse" data-target="#collapsable" id="dealPropertiesCollapse" style="float: left">&nbsp;&nbsp;ثبت پرداختی ملک 
            </button>
            
            <h4 class="header-title m-t-2 m-b-30"><span class="fa fa-list-ul"></span>&nbsp &nbspلیست پرداختی ملک ها</h4>
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>شماره</th>
                        <th>اسم خانه</th>
                        <th>مقدار کرایه/گروی</th>
                        <th>پرداخت شده</th>
                        <th>باقی</th>
                        <th style="padding: 0%;"><center> عملیه ها</center></th>
                    </tr>
                </thead>
                 <tbody>
                     @foreach ($dealedPropertyPayment as $item )
                         <tr>
                             <td>{{ $item->id }}</td>
                             <td>{{ $item->name }}</td>
                             <td>{{ $item->total }}</td>
                             <td>{{ $item->paid }}</td>
                             <td>{{ $item->remain }}</td>
                             <td>
                                <button class="btn btn-trans btn-sm btn-primary fa fa-pencil text-primary" data-toggle="collapse" data-target="#collapsable" onclick="editRecord({{ $item->id }})"></button>
                                <button class="btn btn-trans btn-sm btn-danger fa fa-trash text-danger" onclick="deleteRecord({{ $item->id }})"></button>
                            </td>
                         </tr>
                     @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>





@endsection
@push('js')
    @include('pages.Properties.Deals.DealedPropertyPayment.js');
@endpush