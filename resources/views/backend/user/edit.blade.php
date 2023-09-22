@extends('backend.layout')

@section('content')
    <div class="row">
        <div class="col-lg-6 margin-tb">
            <div class="pull-left">
                <h2>{{trans('dashboard.user_management_update_user')}}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{route('users.index')}}"> {{trans('dashboard.user_management_back')}}</a>
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

    <form action="{{route('users.update',$user->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.user_management_name')}}:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{$user->name}}">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.user_management_phone')}}:</strong>
                    <input class="form-control" type="text" name="phone" placeholder="Phone" value="{{$user->phone}}">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.user_management_email')}}:</strong>
                    <input class="form-control" type="email" name="email" placeholder="Email" value="{{$user->email}}">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.user_management_password')}}:</strong>
                    <input class="form-control" id="password" type="password" name="password" placeholder="Password">
                </div>
{{--                <div><br> <span style="padding-left: 20px"><input type="checkbox" id="check_box" name="" style="width: 15px; height: 15px;"></span></div>--}}
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.user_management_address')}}:</strong>
                    <input class="form-control" type="text" name="address" placeholder="Address" value="{{$user->address}}">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.user_management_role')}}:</strong>
                    <select name="role_id" id="" class="form-control">
                        <option value="">Please Select One</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}"{{ $role->id == $user->role_id ? 'selected' : '' }}>{{ $role->role_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{trans('dashboard.user_management_status')}}:</strong>
                    <select name="status" id="" class="form-control" >
                        <option value='1' {{ $user->status == '1' ? 'selected':'' }}>Enabled</option>
                        <option value='0' {{ $user->status == '0' ? 'selected':'' }}>Disabled</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <br>
                <button type="submit" class="btn btn-primary btn-lg">{{trans('dashboard.user_management_submit')}}</button>
            </div>
        </div>

    </form>

    <script>
        // $(function() {
        //     enable_cb();
        //     $("#check_box").click(enable_cb);
        // });
        //
        // function enable_cb() {
        //     if (this.checked) {
        //         $("#password").removeAttr("disabled");
        //     } else {
        //         $("#password").attr("disabled", true);
        //     }
        // }
    </script>

@endsection
