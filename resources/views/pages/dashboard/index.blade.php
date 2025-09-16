@extends('layouts.master')
@section('content')
<div class="col-lg-3 col-md-6">
    <div class="card-box widget-user">
        <div class="text-center">
            <h2 class="text-custom" data-plugin="counterup">{{ $agency }}</h2>
            <h5>تعداد نمایندگی ها</h5>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="card-box widget-user">
        <div class="text-center">
            <h2 class="text-pink" data-plugin="counterup">{{ $projects }}</h2>
            <h5>مجموع پروژه ها</h5>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="card-box widget-user">
        <div class="text-center">
            <h2 class="text-warning" data-plugin="counterup">{{ $ongoing }}</h2>
            <h5>واحد های زیر کار</h5>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="card-box widget-user">
        <div class="text-center">
            <h2 class="text-info" data-plugin="counterup">{{ $properties }}</h2>
            <h5> تعداد املاک</h5>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="card-box widget-user">
        <div class="text-center">
            <h2 class="text-custom" data-plugin="counterup">{{ $AltDebts }}</h2>
            <h5>تعداد قروض جانبی</h5>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="card-box widget-user">
        <div class="text-center">
            <h2 class="text-pink" data-plugin="counterup">{{ $AltClaims }}</h2>
            <h5>تعداد مطالبات جانبی</h5>
        </div>
    </div>
</div>
<div class="card-box col-lg-12">
    <div id="container"></div>
</div>
@endsection
@push('js')
    @include('pages.dashboard.js')
@endpush