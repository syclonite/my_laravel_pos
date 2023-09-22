@extends('backend.layout')

@section('content')
    <div class="">
        <h1 class="d-flex justify-content-center">{{trans('dashboard.user_management')}}</h1>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn btn-success" href="{{route('users.create')}}">{{trans('dashboard.user_management_add_new')}}</a>
                </div>
            </div>
        </div>
        <br>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <br>
{{--        <h4>{{Auth::user()->role->role_name}}</h4>--}}

{{--        <table border="0" cellspacing="5" cellpadding="5">--}}
{{--            <tbody><tr>--}}
{{--                <td>Minimum date:</td>--}}
{{--                <td><input type="text" id="min" name="min"></td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td>Maximum date:</td>--}}
{{--                <td><input type="text" id="max" name="max"></td>--}}
{{--            </tr>--}}
{{--            </tbody>--}}
{{--        </table>--}}
        <br>
        <table id="example" class="table table-striped table-bordered" >
            <thead>
                <tr>
                    <th>{{trans('dashboard.user_management_no')}}</th>
                    <th>{{trans('dashboard.user_management_name')}}</th>
                    <th>{{trans('dashboard.user_management_phone')}}</th>
                    <th>{{trans('dashboard.user_management_email')}}</th>
                    <th>{{trans('dashboard.user_management_address')}}</th>
                    <th>{{trans('dashboard.user_management_status')}}</th>
                    <th>{{trans('dashboard.user_management_role')}}</th>
{{--                    <th id="created_at">Date</th>--}}
                    <th>{{trans('dashboard.user_management_action')}}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->address}}</td>
                    @if($user->status == '1')
                        <td>{{"Enable"}}</td>
                    @else
                        <td>{{"Disabled"}}</td>
                    @endif
                    <td>{{$user->role->role_name}}</td>
{{--                    <td>{{$user->created_at->format('F d Y')}}</td>--}}
                    <td class="d-inline-flex">
                        <a class="btn btn-sm btn-primary" href="{{route('users.edit', $user->id)}}">{{trans('dashboard.user_management_edit')}}</a>
                        <form action="{{route('users.destroy',$user->id)}}" method="POST">
                            @if($user->deleted_at == null || $user->deleted_at == '')
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-sm btn-warning">{{trans('dashboard.user_management_delete')}}</button>
                            @endif
                        </form>
                        <form action="{{route('users.restore',$user->id)}}" method="POST">
                            @if($user->deleted_at != null || $user->deleted_at != '')
                                @csrf
                                @method('POST')
                                <button type="submit"  class="btn btn-sm btn-success">Restore</button>
                            @endif
                        </form>
                        <form action="{{route('users.force_delete',$user->id)}}" method="POST">
                            @if($user->deleted_at != null || $user->deleted_at != '')
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-sm btn-danger">Force Delete</button>
                            @endif
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

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
