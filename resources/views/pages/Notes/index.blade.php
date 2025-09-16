@extends('layouts.master')
@section('content')
 {{-- home expenditures collapse --}}
 <div class="row collapse " id="collapsable" >
    <div class="col-lg-12">
        <div class="card-box">
            <center>
                <h3 class=" m-t-0 m-b-30" id="notes_title">ثبت یادداشت جدید</h3>
            </center>
            <div class="row" style="display: flex; justify-content: center;">
                <div class="row col-12 col-sm-12 col-md-10 col-lg-8">
                    <form id="NotesForm" >
                        @csrf
                        <input type="hidden" class="form-group" id="note_id" name="note_id">
                        <div class="form-group  col-md-6 col-md-6 col-lg-6 col-xl-6 ">
                            <label for="writer">نویسنده</label>
                            <input type="text" id="writer" name="writer" placeholder="اسم خود را وارد کنید" required
                                class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-md-6 col-lg-6 col-xl-6 ">
                            <label for="subject">موضوع یادداشت</label>
                            <input id="subject" name="subject" type="text" placeholder="موضوع یادداشت را وارد کنید" required
                                class="form-control">
                        </div>
                        <div class="form-group  col-md-12 col-lg-12 col-xl-12 ">
                            <label for="description">توضیحات </label>
                                <textarea id="description" class="form-control" name="description" rows="3" style="resize: none" placeholder="توضیحات موضوع را وارد کنید"></textarea>
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
            <button class="btn-rounded btn-primary fa fa-plus-circle" data-toggle="collapse" data-target="#collapsable" style="float: left">&nbsp;&nbsp; ثبت یادداشت جدید
            </button>
            
            <h4 class="header-title m-t-0 m-b-30"><span class="fa fa-list-ul"></span>&nbsp &nbspلیست یادداشت ها </h4>
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>شماره</th>
                        <th>نویسنده</th>
                        <th>موضوع</th>
                        <th>یادداشت</th>
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
    @include('pages.Notes.js');
@endpush