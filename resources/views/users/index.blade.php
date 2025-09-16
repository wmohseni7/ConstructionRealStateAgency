@extends('layouts.master')
@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
<div class="card-box table-responsive">
  @can('user-create')
  <a class="btn btn-primary btn-rounded fa fa-plus-circle" href="{{ route('users.create') }}" style="float: left; margin-bottom:1%"> &nbsp;&nbsp;افزودن کاربر جدید</a>
  @endcan
  <h4 class="header-title m-t-0 m-b-30"><span class="fa fa-list "></span> لیست کاربران</h4>
  <table  class="table table-striped table-bordered">
  <tr>
    <th>شماره</th>
    <th>اسم</th>
    <th>ایمیل</th>
    <th>نقش ها</th>
    <th width="280px">عملیه ها</th>
  </tr>
  @can('user-list')
  @foreach ($data as $key => $user)
    <tr>
      <td>{{ ++$i }}</td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>
        @if(!empty($user->getRoleNames()))
          @foreach($user->getRoleNames() as $v)
            <label class="badge badge-success">{{ $v }}</label>
          @endforeach
        @endif
      </td>
      <td>
        <a class="btn btn-info btn-sm  fa fa-search" href="{{ route('users.show',$user->id) }}"></a>
        @can('user-edit')
        <a class="btn btn-primary btn-sm fa fa-pencil" href="{{ route('users.edit',$user->id) }}"></a>
        @endcan
        @can('user-delete')
          {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
              {!! Form::submit('حذف', ['class' => 'fa fa-trash btn btn-rounded-sm btn-trans btn-danger btn-sm ']) !!}
          {!! Form::close() !!}
        @endcan
      </td>
    </tr>
  @endforeach
  @endcan
  </table>
</div>
{!! $data->render() !!}

@endsection