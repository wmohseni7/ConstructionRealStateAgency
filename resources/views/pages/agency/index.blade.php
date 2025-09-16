@extends('layouts.master')
@section('content')

    {{-- including agency insert collapse --}}
    @include('pages.agency.create')
    
    {{-- agencies datatable --}}
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive" >
                <button class="btn-rounded btn-primary fa fa-plus-circle" data-toggle="collapse" data-target="#collapsable" style="float: left">&nbsp;&nbsp;افزودن
                </button>
                
                <h4 class="header-title m-t-0 m-b-30"><span class="fa fa-list-ul"></span>&nbsp &nbspلیست نمایندگی ها</h4>
                <table id="datatable" class="table table-striped table-bordered ">
                    <thead>
                        <tr>
                            <th>شماره</th>
                            <th>نام</th>
                            <th>مسول</th>
                            <th>شماره تماس</th>
                            <th>وضعیت</th>
                            <th>آدرس</th>
                            <th colspan="2" style="padding:0%; " >عملیه ها</th>
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
    @include('pages.agency.js')
@endpush
