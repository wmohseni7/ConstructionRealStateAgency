@extends('layouts.master')
@section('content')

{{-- append category modal --}}
<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">افزودن کتگوری</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
                <label for="categoryName">اسم کتگوری</label>
                <input type="text" id="categoryName" placeholder="اسم کتگوری جدید را وارد نمایید" class="form-control">
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="submitCat">ثبت</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
</div>
{{-- end append category modal --}}
{{-- append type modal --}}
<div class="modal" id="typeModal">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">افزودن نوعیت</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
                <label for="typeName">اسم نوع</label>
                <input type="text" id="typeName" placeholder="اسم نوعیت جدید را وارد نمایید" class="form-control">
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="submitType">ثبت</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
</div>
{{-- end append type modal --}}

    
<div class="row collapse" id="collapsable" >
    <div class="col-lg-12">
        <div class="card-box">
            <center>
                <h3 class=" m-t-0 m-b-30" id="project_construction_title">  ثبت مصارف اعمار واحد</h3>
            </center>
            <div class="row" style="display: flex; justify-content: center;">
                <div class="col-12 col-sm-12 col-md-10 col-lg-8" >
                    <form id="projectConstructionForm" >
                        @csrf
                        <input type="hidden" id="edit_project_id" name="edit_project_id">
                        <input type="hidden" name="project_id" parsley-trigger="change" required readonly
                         placeholder="اسم نمایندگی جدید را وارد کنید" class="form-control" id="project_id" value="{{ $projects->id }}">
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="categories">  کتگوری مصارف   
                                    <a id="appendCategory" class="fa fa-plus-circle" data-toggle="modal" data-target="#myModal"> کتگوری</a>
                            </label>
                            <select class="form-control" name="categories" id="categories">
                                <option selected disabled>کتگوری را انتخاب کنید</option>
                                <option value="1">نجاری</option>
                                <option value="2">شیشه</option>
                                <option value="3">آهن آلات</option>
                                <option value="4">متفرقه</option>
                            </select>
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="name">اسم </label>
                            <input id="name" type="text" name="name" placeholder="اسم مورد مصرفی" required
                                class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="amount">مقدار</label>
                            <input id="amount" type="number" name="amount" placeholder="تعداد مورد مصرفی" required
                                class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="type">نوعیت
                                <a id="appendType" class="fa fa-plus-circle" data-toggle="modal" data-target="#typeModal"> نوعیت</a>
                            </label>
                            <select class="form-control" name="type" id="type">
                                <option selected disabled>نوعیت را انتخاب کنید</option>
                                <option value="1">نوع اول</option>
                                <option value="2">نوع دوم</option>
                                <option value="3">موارد دیگر</option>
                            </select>
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="price">قیمت </label>
                            <input id="price" type="number" name="price" parsley-trigger="change" required
                                placeholder="قیمت مورد مصرفی را وارد کنید" class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="company">کمپنی </label>
                            <select class="form-control" name="company" id="company">
                                <option selected disabled>کمپنی را انتخاب کنید</option>
                                @foreach ( $companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="total">مجموع </label>
                            <input id="total" type="number" name="total" parsley-trigger="change" required
                                placeholder="مقدار مجموعی مورد مصرفی را وارد کنید" class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="paid">پرداخت شده </label>
                            <input id="paid" type="number" name="paid" parsley-trigger="change" required
                                placeholder=" مقدار پرداخت شده " class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="remain">باقی </label>
                            <input id="remain" type="number" name="remain" parsley-trigger="change" required
                                placeholder=" مقدار باقی " class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="date">تاریخ </label>
                            <input id="date" type="date" name="date" parsley-trigger="change" required
                                 class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="bill">بل نمبر </label>
                            <input id="bill" type="number" name="bill" parsley-trigger="change" required
                                 class="form-control" placeholder="نمبر بل را وارد کنید">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="currency">واحد پولی </label>
                            <select class="form-control" name="currency" id="currency">
                                <option selected disabled>واحد پولی را انتخاب کنید</option>

                                <option value="1">افغانی</option>
                                <option value="2">دالر</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12 col-lg-12 col-xl-12 ">
                            <label for="description">توضیحات</label>
                             <textarea name="description" id="description" placeholder="توضیحات مصرف را وارد کنید" class="form-control " rows="6" style="resize: none"></textarea>
                        </div>
                    
                        <div class="form-group text-right " style="margin-left:10px !important">
                            <button id="saveOrUpdate" class="btn btn-primary btn-rounded waves-effect waves-light" >
                                ثبت
                            </button>              
                            <button type="reset" data-toggle="collapse" data-target="#collapsable"  class="btn-danger btn-rounded btn btn-default waves-effect waves-light " onclick="closeCollapse()">
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
            <button class="btn-rounded btn-primary fa fa-plus-circle" data-toggle="collapse" data-target="#collapsable" id="agencyIncomeCollapse" style="float: left">&nbsp &nbspثبت مصرف جدید پروژه 
            </button>
            
            <h4 class="header-title m-t-2 m-b-30"><span class="fa fa-list-ul"></span>&nbsp; &nbsp;لیست مصارف پروژه زیر کار</h4>
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>شماره</th>
                        <th>کتگوری</th>
                        <th>اسم</th>
                        <th>مقدار</th>
                        <th>نوعیت </th>
                        <th>قیمت</th>
                        <th>کمپنی</th>
                        <th>مجموع</th>
                        <th>پرداخت شده</th>
                        <th>واحد </th>
                        <th>باقی </th>
                        <th>بل نمبر </th>
                        <th>تاریخ </th>
                        <th>توضیحات </th>
                        <th ><center> عملیات</center> </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($constructed as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        @if ($item->category=='1')
                            <td class="text-primary">نجاری</td>
                        @elseif ($item->category=='2')
                            <td class="text-secondary">شیشه</td>    
                        @elseif ($item->category=='3')
                            <td class="text-warning">آهن آلات</td>  
                        @elseif ($item->category>'3')
                            <td class="text-secondary">متفرقه</td> 
                        @endif
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->amount  }}</td>
                        @if ($item->type=='1')
                            <td class="text-primary">نوع اول</td>
                        @elseif ($item->type=='2')
                            <td class="text-secondary">نوع دوم</td>    
                        @elseif ($item->type=='3')
                            <td class="text-warning">نوع دیگر</td>  
                        @elseif ($item->type>'3')
                            <td class="text-warning">متفرقه</td> 
                        @endif
                        <td>{{ $item->price  }}</td>
                        <td>{{ $item->company_id  }}</td>
                        <td>{{ $item->total  }}</td>
                        <td>{{ $item->paid  }}</td>
                        @if ($item->currency=='1')
                            <td class="text-primary">افغانی</td>
                        @else
                            <td class="text-success">دالر</td>
                        @endif
                        <td>{{ $item->remain  }}</td>
                        <td>{{ $item->bill  }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            {{-- <a href="/projectconstruction">
                            <button class="btn btn-trans btn-sm btn-success fa fa-building-o" >
                            </button></a>
                            <button class="btn btn-trans btn-sm btn-warning fa fa-dollar">
                            </button> --}}
                             <button class="btn btn-trans btn-sm btn-primary fa fa-pencil" data-toggle="collapse" data-target="#collapsable" onclick="editRecord({{ $item->id }})">
                            </button>
                            <button class="fa fa-trash btn btn-trans btn-danger btn-sm" onclick="deleteRecord({{ $item->id }})" >
                            </button>
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
    @include('pages.project management.construction.js');
@endpush