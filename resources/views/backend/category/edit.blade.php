@extends('backend.layout')

@section('content')
    <div class="row">
        <div class="col-lg-6 margin-tb">
            <div class="pull-left">
                <h2>{{trans('dashboard.category_management_update_category')}}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{route('categories.index')}}"> {{trans('dashboard.back')}}</a>
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

    <form action="{{route('categories.update',$category->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.category_management_category_name')}}:</strong>
                    <input type="text" name="category_name" class="form-control" placeholder="Category Name" value="{{$category->category_name}}" required>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.category_management_category_description')}}:</strong>
                    <input class="form-control" type="text" name="category_des" placeholder="Category Description" value="{{$category->category_description}}">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.status')}}:</strong>
                    <select name="status" id="" class="form-control" >
                        <option value='1' {{ $category->status == '1' ? 'selected':'' }}>Enabled</option>
                        <option value='0' {{ $category->status == '0' ? 'selected':'' }}>Disabled</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <br>
                <button type="submit" class="btn btn-primary btn-sm">{{trans('dashboard.submit')}}</button>
            </div>
        </div>

    </form>
@endsection
