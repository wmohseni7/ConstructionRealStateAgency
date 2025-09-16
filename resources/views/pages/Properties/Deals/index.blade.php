@extends('layouts.master')
@section('content')

{{-- property dealership collapse --}}
<div class="row collapse" id="collapsable" >
    <div class="col-lg-12">
        <div class="card-box">
            <center>
                <h3 class=" m-t-0 m-b-30" id="dealershipTitle">ثبت خانه جدید</h3>
            </center>
            <div class="row" style="display: flex; justify-content: center;" >
                <div class="row col-12 col-sm-12 col-md-10 col-lg-8">
                    <form id="dealershipForm" enctype="multipart/form-data" >
                        @csrf
                        <input type="hidden" class="form-group form-control col-lg-12" id="editDealedProperty_id" name="editDealedProperty_id">
                        <input type="hidden" readonly class="form-group form-control col-lg-12" id="property_id" name="property_id" value="{{ $property->id }}" >
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="name">نام خانه </label>
                            <input id="name" name="name" class="form-control" type="text" readonly value="{{ $property->name }}">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="floor">تعداد طبقات </label>
                            <input id="floor" readonly name="floor" parsley-trigger="change" required
                              class="form-control" value="{{ $property-> floor }}">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="apartment">تعداد واحد ها</label>
                            <input id="apartment" type="number" name="apartment" parsley-trigger="change" readonly required
                                value="{{ $property->apartment }}" class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="customer">اسم مشتری </label>
                            <input id="customer" type="tel" name="customer" parsley-trigger="change"
                                placeholder="اسم مشتری را وارد کنید" class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="phone_number">شماره تماس </label>
                            <input id="phone_number" type="tel" name="phone_number" parsley-trigger="change"
                                placeholder="شماره تماس مشتری را وارد کنید" class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="floorNum">طبقه </label>
                            <input id="floorNum" type="number" name="floorNum" parsley-trigger="change"
                                placeholder="شماره طبقه را وارد کنید" class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="apartmentNum">واحد </label>
                            <input id="apartmentNum" type="number" name="apartmentNum" parsley-trigger="change"
                                placeholder="شماره واحد را وارد کنید" class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="deal">نوعیت معامله </label>
                            <select name="deal" id="deal" class="form-control">
                                <option selected disabled>نوعیت معامله خود را انتخاب کنید</option>
                                <option value="1">کرایی</option>
                                <option value="2">گروی</option>
                            </select>
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="amount">مقدار کرایه/گروی  </label>
                            <input id="amount" type="number" name="amount" parsley-trigger="change"
                                placeholder="مقدار را وارد کنید" class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="date">تاریخ  </label>
                            <input id="date" type="date" name="date" parsley-trigger="change"
                                placeholder="تاریخ را وارد کنید" class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="photo">انتخاب عکس  </label>
                            <input id="photo" type="file" size='100000' name="photo" parsley-trigger="change"
                             class="form-control dropify" >
                        </div>
                        <div class="form-group col-md-6 col-lg-6 col-xl-6">
                            <label for="description">توضیحات</label>
                            <textarea class="form-control" name="description" id="description" rows="9" style="resize: none" placeholder="توضیحات معامله را وارد کنید"></textarea>
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
<!-- Modal -->
<div class="modal fade" style="text-align:center" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="imageModalLabel"> تصویر ملک</h5>
            </div>
            <div class="modal-body">
                <center>
                    <img src="" alt="" id="toDisplayPhoto" style="height: 400px">
                </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>



{{-- Deals registeration datatable --}}
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive" >
            <button class="btn-rounded btn-primary fa fa-plus-circle" data-toggle="collapse" data-target="#collapsable" style="float: left">&nbsp;&nbsp;ثبت معامله ملک 
            </button>
            
            <h4 class="header-title m-t-2 m-b-30"><span class="fa fa-list-ul"></span>&nbsp &nbspلیست معاملات ملک </h4>
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>شماره</th>
                        <th>اسم خانه</th>
                        <th>مشتری</th>
                        <th>شماره طبقه</th>
                        <th>شماره واحد</th>
                        <th>شماره تماس</th>
                        <th>معامله</th>
                        <th>مقدار کرایه/گروی</th>
                        <th>تاریخ</th>
                        <th>توضیحات</th>
                        <th><center>عملیه ها</center></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dealership as $item )
                        <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->customer }}</td>
                                <td>{{ $item->floor }}</td>
                                <td>{{ $item->apartment }}</td>
                                <td>{{ $item->phone_number }}</td>
                                @if ($item->deal==1)
                                    <td class="text-success">کرایی</td>
                                @else
                                    <td class="text-warning">گروی</td>
                                @endif
                                <td>{{ $item->amount }}</td>
                                <td>{{ $item->date }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm fa fa-file-image-o" data-toggle="modal" data-target="#imageModal" onclick="showImage({{ $item->id }})">
                                    </button>
                                    <a href="{{URL::asset('dealedproppayment')}}/{{ $item->id }}"><button class="btn btn-sm btn-success fa fa-money" data-toggle="tooltip" title="ثبت پرداختی ملک "></button></a>

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
    @include('pages.Properties.Deals.js')
@endpush