@extends('backend.layout')

@section('content')
    <div class="row">
        <div class="col-lg-6 margin-tb">
            <div class="pull-left">
                <h2>{{trans('dashboard.unit_management_update_unit')}}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{route('units.index')}}"> {{trans('dashboard.back')}}</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('units.update',$unit->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.unit_management_unit_name')}}:</strong>
                    <input type="text" name="unit_name" class="form-control" placeholder="Role Name" value="{{$unit->unit_name}}" required>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.unit_management_unit_description')}}:</strong>
                    <input class="form-control" type="text" name="unit_des" placeholder="Role Description" value="{{$unit->unit_description}}">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.status')}}:</strong>
                    <select name="status" id="" class="form-control" >
                        <option value='0' {{ $unit->status == '0' ? 'selected':'' }}>Disabled</option>
                        <option value='1' {{ $unit->status == '1' ? 'selected':'' }}>Enabled</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <br>
                <button type="submit" class="btn btn-primary btn-lg">{{trans('dashboard.submit')}}</button>
            </div>
        </div>

    </form>
@endsection
