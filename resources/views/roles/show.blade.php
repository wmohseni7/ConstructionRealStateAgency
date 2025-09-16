@extends('layouts.master')
@section('content')
<div class="card-box">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h4 class="header-title m-t-0 m-b-30"> نمایش مجوز های نقش</h4>
            </div>
            <div class="pull-right">
                <a class="btn btn-danger btn-rounded" href="{{ route('roles.index') }}"> برگشت</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>اسم:</strong>
                {{ $role->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>مجوز ها:</strong>
                @if(!empty($rolePermissions))
                    @foreach($rolePermissions as $v)
                        <label class="label label-success">{{ $v->name }},</label>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

