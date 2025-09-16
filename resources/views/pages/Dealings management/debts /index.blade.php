@extends('layouts.master')
@section('content')
{{-- datatable --}}
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive" >
            
            <h4 class="header-title m-t-0 m-b-30"><span class="fa fa-list-ul"></span>&nbsp &nbspلیست قروض </h4>
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>شماره</th>
                        <th>اسم مصرف</th>
                        <th>قیمت فی  دانه</th>
                        <th>تعداد</th>
                        <th>مجموع</th>
                        <th>پرداخت شده</th>
                        <th>باقی</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($debts as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->amount }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->total }}</td>
                        <td>{{ $item->remain }}</td>
                        <td>{{ $item->paid }}</td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div> 

@endsection
@push('js')
    @include('pages.Dealings management.debts .js')
@endpush