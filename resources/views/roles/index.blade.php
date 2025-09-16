@extends('layouts.master')

@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="card-box">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h4 class="header-title m-t-0 m-b-30"> <span class="fa fa-list"></span> مدیریت نقش ها</h4>
            </div>
            <div class="pull-right">
            @can('role-create')
                <a class="btn btn-primary btn-rounded fa fa-plus-circle" href="{{ route('roles.create') }}">&nbsp;&nbsp; افزودن نقش جدید</a>
                @endcan
            </div>
        </div>
    </div>
    <table class="table table-striped table-bordered">
    <tr>
        <th>شماره</th>
        <th>اسم</th>
        <th width="280px">عملیه ها</th>
    </tr>
        @foreach ($roles as $key => $role)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $role->name }}</td>
            <td>
                <a class="btn btn-info btn-sm fa fa-search" href="{{ route('roles.show',$role->id) }}"></a>
                @can('role-edit')
                    <a class="btn btn-primary  btn-sm fa fa-pencil" href="{{ route('roles.edit',$role->id) }}"></a>
                @endcan
                @can('role-delete')
                    {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('حذف', ['class' => 'fa fa-trash btn btn-danger btn-rounded-sm btn-trans btn-sm']) !!}
                    {!! Form::close() !!}
                @endcan
            </td>
        </tr>
        @endforeach
    </table>
</div>
{!! $roles->render() !!}

@endsection