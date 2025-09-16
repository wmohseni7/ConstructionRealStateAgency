@extends('layouts.master')
@section('content')
<div class="card-box" style="display: flex; justify-content:center">
    <div class="row col-12 col-sm-12 col-md-10 col-lg-8" >
        <div class="">
            <div class="pull-left">
                <h3>  نمایش مشخصات کاربر</h3>
            </div>
            <div class="pull-right">
                <a class="btn btn-danger btn-rounded" href="{{ route('users.index') }}"> برگشت</a>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>اسم:</strong>
                    {{ $user->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ایمیل:</strong>
                    {{ $user->email }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>نقش ها:</strong>
                    @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                            <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                    @endif
                </div>
            
            </div>
        </div>
    </div>
</div>
@endsection