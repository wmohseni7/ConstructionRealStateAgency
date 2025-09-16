@extends('layouts.master')
@section('content')
<div class="row collapse" id="collapsable" >
    <div class="col-lg-12">
        <div class="card-box">
            <center>
                <h3 class=" m-t-0 m-b-30" id="ProjectExpReport_title"> تاریخ شروع و ختم گزارش </h3>
            </center>
            <div class="row" style="display: flex; justify-content: center;">
                <div class="col-12 col-sm-12 col-md-10 col-lg-8" >
                    <form id="projectExpenseReportForm" >
                        @csrf
                        <div class="form-group col-md-5 col-lg-6 col-xl-6 col-xs-6">
                            <label for="start_date">از</label>
                            <input class="form-control " required type="date" name="start_date" id="start_date">
                        </div>
                        <div class="form-group col-md-5 col-lg-6 col-xl-6 col-xs-6">
                            <label for="end_date">الی</label>
                            <input class="form-control " required type="date" name="end_date" id="end_date">
                        </div>
                    
                        <div class="form-group text-right col-md-12 col-lg-12 col-xl-12 col-xs-12 " style="margin-left:10px !important">
                            <button id="saveOrUpdate" class="btn btn-primary btn-rounded waves-effect waves-light" >
                                جستجو
                            </button>              
                            <button type="reset" data-toggle="collapse" data-target="#collapsable"  class="btn-danger btn-rounded btn btn-default waves-effect waves-light collapse">
                                بستن
                            </button>
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
            {{-- <button class="btn-rounded btn-primary" data-toggle="collapse" data-target="#collapsable" id="agencyIncomeCollapse" style="float: left">  گزارش   
            </button> --}}
            
            <h4 class="header-title m-t-2 m-b-30"><span class="fa fa-list-ul"></span>&nbsp; گزارش مصارف </h4>
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>شماره </th>
                        <th>اسم پروژه</th>
                        <th>اسم مصرف</th>
                        <th>مجموع</th>
                        <th>پرداخت شده</th>
                        <th>باقی</th>
                    </tr>
                </thead>
                <tbody> 
                    {{-- @foreach ($projExpReport as $item )
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->project->name }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->total }}</td>
                        <td>{{ $item->paid }}</td>
                        <td>{{ $item->remain }}</td>
                    </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('js')
    @include('pages.project management.ExpensesReport.js')
@endpush