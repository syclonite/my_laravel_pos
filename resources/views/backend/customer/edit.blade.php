@extends('backend.layout')

@section('content')
    <div class="row">
        <div class="col-lg-6 margin-tb">
            <div class="pull-left">
                <h2>{{trans('dashboard.customer_management_update_customer')}}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{route('customers.index')}}"> {{trans('dashboard.customer_management_back')}}</a>
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
    <br>
    <form action="{{route('customers.update',$customer->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.customer_management_name')}}:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{$customer->name}}" required>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.customer_management_phone')}}:</strong>
                    <input class="form-control" type="text" name="phone" placeholder="Phone" value="{{$customer->phone}}" required>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.customer_management_email')}}:</strong>
                    <input class="form-control" type="email" name="email" placeholder="Email" value="{{$customer->email}}">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.customer_management_status')}}:</strong>
                    <select name="status" id="" class="form-control" required>
                        <option value='1' {{ $customer ->status == '1' ? 'selected':'' }}>Enabled</option>
                        <option value='0' {{ $customer->status == '0' ? 'selected':'' }}>Disabled</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.customer_management_address')}}:</strong>
                    <textarea class="form-control" type="text" name="address" placeholder="Address" cols="20" rows="5" >{{$customer->address}}</textarea>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.customer_management_remarks')}}:</strong>
                    <textarea class="form-control" type="text" name="remarks" placeholder="Remarks" cols="20" rows="5">{{$customer->remarks}}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <br>
                <button type="submit" class="btn btn-primary btn-sm">{{trans('dashboard.customer_management_submit')}}</button>
            </div>
        </div>

    </form>

    <style>
        @media screen and (max-width: 480px ) {

            [class*="col-"] {
                width: 100%;
            }

            table {

                display: block;
                max-width: -moz-fit-content;
                max-width: fit-content;
                margin: 0 auto;
                overflow-x: auto;
                white-space: nowrap;

            }

        }

    </style>
@endsection
