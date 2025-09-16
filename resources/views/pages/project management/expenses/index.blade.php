@extends('layouts.master')
@section('content')




<div class="row collapse" id="collapsable" >
    <div class="col-lg-12">
        <div class="card-box">
            <center>
                <h3 class=" m-t-0 m-b-30" id="project_construction_title">  ثبت مشخصات اعمار واحد</h3>
            </center>
            <div class="row" style="display: flex; justify-content: center;">
                <div class="col-12 col-sm-12 col-md-10 col-lg-8" >
                    <form id="projectConstructionForm" >
                        @csrf
                        <input type="hidden" id="edit_projectExp_id" name="edit_projectExp_id">
                        <input type="hidden" id="projectExp_id" name="projectExp_id" value="{{ $projects->id }}">

                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="floor">  طبقه   
                                    <a id="appendFloor" class="fa fa-plus-circle">طبقه</a>
                            </label>
                            <select class="form-control" name="floor" id="floor">
                                <option selected disabled>طبقه را انتخاب کنید</option>
                                <option value="1">طبقه 1</option>
                                <option value="2">طبقه 2</option>
                                <option value="3">طبقه 3</option>
                                <option value="4">طبقه 4</option>
                                <option value="5">طبقه 5</option>
                            </select>
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="apartment">  واحد   
                                    <a id="append_apartment" class="fa fa-plus-circle">واحد</a>
                            </label>
                            <select class="form-control" name="apartment" id="apartment">
                                <option selected disabled>واحد را انتخاب کنید</option>
                                <option value="1">واحد 1</option>
                                <option value="2">واحد 2</option>
                                <option value="3">واحد 3</option>
                                <option value="4">واحد 4</option>
                                <option value="5">واحد 5</option>
                                <option value="6">واحد 6</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-lg-6 col-xl-6">
                            <label for="bedroom">اطاق خواب</label>
                            <input type="number" class="form-control " name="bedroom" id="bedroom" placeholder="تعداد اطاق های خواب را وارد کنید">
                        </div>
                        <div class="form-group col-md-6 col-lg-6 col-xl-6">
                            <label for="bathroom">حمام</label>
                            <input type="number" class="form-control " name="bathroom" id="bathroom" placeholder="تعداد حمام را وارد کنید">
                        </div>
                        <div class="form-group col-md-6 col-lg-6 col-xl-6">
                            <label for="toilet">تشناب</label>
                            <input type="number" class="form-control " name="toilet" id="toilet" placeholder="تعداد تشناب را وارد کنید">
                        </div>
                        <div class="form-group col-md-6 col-lg-6 col-xl-6">
                            <label for="kitchen">آشپزخانه</label>
                            <input type="number" class="form-control " name="kitchen" id="kitchen" placeholder="تعداد آشپزخانه را وارد کنید">
                        </div>
                        <div class="form-group col-md-6 col-lg-6 col-xl-6">
                            <label for="salon">صالون</label>
                            <input type="number" class="form-control " name="salon" id="salon" placeholder="تعداد صالون را وارد کنید">
                        </div>
                    
                        <div class="form-group text-right col-md-12 col-lg-12 col-xl-12 col-xs-12 " style="margin-left:10px !important">
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
            <button class="btn-rounded btn-primary fa fa-plus-circle" data-toggle="collapse" data-target="#collapsable" id="agencyIncomeCollapse" style="float: left">&nbsp;&nbsp;  اعمار واحد  
            </button>
            
            <h4 class="header-title m-t-2 m-b-30"><span class="fa fa-list-ul"></span>&nbsp &nbspلیست واحد های زیر کار</h4>
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>شماره</th>
                        <th>اسم پروژه</th>
                        <th>طبقه</th>
                        <th>واحد</th>
                        <th>اطاق خواب </th>
                        <th>حمام</th>
                        <th>تشناب</th>
                        <th>آشپزخانه</th>
                        <th>صالون</th>
                        <th>عملیه ها</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($projectExp as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->project->name }}</td>
                        <td>{{ $item->floor }}</td>
                        <td>{{ $item->apartment  }}</td>
                        <td>{{ $item->bedroom }}</td>
                        <td>{{ $item->bathroom }}</td>
                        <td>{{ $item->toilet }}</td>
                        <td>{{ $item->kitchen }}</td>
                        <td>{{ $item->salon }}</td>
                        <td>
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
    @include('pages.project management.expenses.js')
@endpush