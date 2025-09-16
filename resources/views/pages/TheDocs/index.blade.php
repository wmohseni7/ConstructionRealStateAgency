@extends('layouts.master')
@section('content')




{{-- Documents collapse --}}
<div class="row collapse " id="collapsable" >
    <div class="col-lg-12">
        <div class="card-box">
            <center>
                <h3 class=" m-t-0 m-b-30" id="docs_title">ثبت سند</h3>
            </center>
            <div class="row" style="display: flex; justify-content: center;">
                <div class="row col-12 col-sm-12 col-md-10 col-lg-8">
                    <form id="DocsForm" enctype="multipart/form-data" >
                        @csrf
                        <input type="hidden" class="form-group" id="doc_id" name="doc_id">
                        <div class="form-group col-md-6 col-lg-6 col-xl-6">
                            <label for="agency">نمایندگی</label>
                            <select class="form-control" name="agency" id="agency">
                                <option selected disabled> نمایندگی را انتخاب کنید</option>
                                @foreach ($agencies as $agency)
                                    <option value="{{ $agency->id }}">{{ $agency->name }}</option>    
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="subject">عنوان سند</label>
                            <input type="text" id="subject" name="subject" placeholder="عنوان سند خود را وارد کنید" required
                                class="form-control">
                        </div>
                        <div class="form-group   col-md-6 col-lg-6 col-xl-6 ">
                            <label for="date">تاریخ</label>
                            <input type="date" id="date" name="date" placeholder="تاریخ را وارد کنید" required
                                class="form-control">
                        </div>
                        <div class="form-group col-md-6 col-lg-6 col-xl-6">
                            <label for="category">کتگوری</label>
                            <select class="form-control" name="category" id="category">
                                <option selected disabled> کتگوری را انتخاب کنید</option>
                                    <option value="1">تست</option>   
                                    <option value="2">تست2</option>   
                            </select>
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="doc">سند</label>
                            <input class="dropify" type="file" id="doc" name="doc" placeholder="سند را انتخاب کنید" class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="description">توضیحات </label>
                            <textarea id="description" class="form-control" name="description" rows="9" style="resize: none" placeholder="توضیحات سند را وارد کنید"></textarea>
                        </div>
                        <div class="row col-lg-12">
                            <div class="form-group text-right ">
                                <button id="saveOrUpdate" type="submit" class="btn btn-primary btn-rounded waves-effect waves-light" >
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
 <!-- Modal -->
 <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="imageModalLabel"> تصویر سند</h5>
            </div>
            <div class="modal-body">
                <center>
                    <img id="photoModal" class="img-fluid" alt="" style="max-height: 400px">
                </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>






{{-- datatable --}}
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive" >
            <button class="btn-rounded btn-primary fa fa-plus-circle" data-toggle="collapse" data-target="#collapsable" style="float: left">&nbsp;&nbsp; ثبت سند جدید
            </button>
            
            <h4 class="header-title m-t-0 m-b-30"><span class="fa fa-list-ul"></span>&nbsp &nbspلیست اسناد </h4>
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>شماره</th>
                        <th>نمایندگی</th>
                        <th>عنوان</th>
                        <th>کتگوری</th>
                        <th>تاریخ</th>
                        <th>توضیحات</th>
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
    @include('pages.TheDocs.js');
@endpush