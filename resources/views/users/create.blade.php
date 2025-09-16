@extends('layouts.master')



@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            
        </div>
        <div class="pull-right">
            
        </div>
    </div>
</div>
@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif
{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
<div class="col-lg-12">
    <div class="card-box">
        <div class="row">
            <div></div>
                <center><h3>افزودن کاربر جدید</h3></center>
                <div class="row" style="display: flex; justify-content:center;">
                    <div class="col-12 col-sm-12 col-md-10 col-lg-8">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>اسم:</strong>
                                {!! Form::text('name', null, array('placeholder' => 'اسم ','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>ایمیل:</strong>
                                {!! Form::text('email', null, array('placeholder' => 'ایمیل','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>رمز:</strong>
                                {!! Form::password('password', array('placeholder' => 'رمز','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>تایید رمز :</strong>
                                {!! Form::password('confirm-password', array('placeholder' => ' رمز را دوباره وارد کنید ','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>نقش:</strong>
                                {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary btn-rounded">ثبت</button>
                            <a class="btn btn-danger btn-rounded" href="{{ route('users.index') }}"> برگشت</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}

@endsection