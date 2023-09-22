@extends('backend.layout')

@section('content')
    <div class="">
        <h1 class="d-flex justify-content-center">{{trans('dashboard.customer_management')}}</h1>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn btn-success" href="{{route('customers.create')}}">{{trans('dashboard.customer_management_add_new')}}</a>
                    <a class="btn btn-primary" href="{{route('customers.customer_payment_index')}}">{{trans('dashboard.customer_management_due_customer_list')}}</a>
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
        <table border="0" cellspacing="5" cellpadding="5" class="table table-success">
            <tbody><tr>
                <td>{{trans('dashboard.minimum_date')}}:</td>
                <td><input type="text" id="min" name="min"></td>
                <td>{{trans('dashboard.maximum_date')}}:</td>
                <td><input type="text" id="max" name="max"></td>
            </tr>
            </tbody>
        </table>
        <br>
        <table id="example" class="table table-bordered table-hover" >
            <thead>
                <tr>
                    <th>{{trans('dashboard.customer_management_no')}}</th>
                    <th>{{trans('dashboard.customer_management_name')}}</th>
                    <th>{{trans('dashboard.customer_management_phone')}}</th>
                    <th>{{trans('dashboard.customer_management_email')}}</th>
                    <th>{{trans('dashboard.customer_management_status')}}</th>
                    <th>{{trans('dashboard.customer_management_address')}}</th>
                    <th>{{trans('dashboard.customer_management_remarks')}}</th>
                    <th id="created_at">{{trans('dashboard.customer_management_date')}}</th>
                    <th>{{trans('dashboard.customer_management_action')}}</th>
                </tr>
            </thead>

            <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$customer->name}}</td>
                    <td>{{$customer->phone}}</td>
                    <td>{{$customer->email}}</td>
                    @if($customer->status == '1')
                        <td>{{"Enable"}}</td>
                    @else
                        <td>{{"Disabled"}}</td>
                    @endif
                    <td>{{$customer->address}}</td>
                    <td>{{$customer->remarks}}</td>
                    <td id="created_at">{{$customer->created_at->format('F d Y')}}</td>
                    <td class="text-center d-inline-flex">
                        <a class="btn btn-sm btn-primary" href="{{route('customers.edit', $customer->id)}}"><i class="fa-solid fa-pen-to-square"></i>{{trans('dashboard.customer_management_edit')}}</a>
                        <form action="{{route('customers.destroy',$customer->id)}}" method="POST">
                            @if($customer->deleted_at == null || $customer->deleted_at == '')
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i>{{trans('dashboard.customer_management_delete')}}</button>
                            @endif
                        </form>
                        <form action="{{route('customers.restore',$customer->id)}}" method="POST">
                            @if($customer->deleted_at != null || $customer->deleted_at != '')
                                @csrf
                                @method('POST')
                                <button type="submit"  class="btn btn-sm btn-success">{{trans('dashboard.restore')}}</button>
                            @endif
                        </form>
                        <form action="{{route('customers.force_delete',$customer->id)}}" method="POST">
                            @if($customer->deleted_at != null || $customer->deleted_at != '')
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-sm btn-danger"><i class="fa-solid fa-pen-to-square"></i>{{trans('dashboard.force_delete')}}</button>
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
