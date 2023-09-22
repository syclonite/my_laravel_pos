@extends('backend.layout')

@section('content')
    <div class="">
        <h1 class="d-flex justify-content-center">{{trans('dashboard.customer_management_billing_list')}}</h1>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    {{--                    <a class="btn btn-success" href="">Add New Payment</a>--}}
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
        <a href="{{route('customers.customer_payment_index')}}" class="btn btn-primary">{{trans('dashboard.customer_management_back')}}</a>
        <div><br></div>
        <table border="0" cellspacing="5" cellpadding="5" class="table table-success">
            <tbody>
            <tr>
                <td>{{trans('dashboard.minimum_date')}}:</td>
                <td><input type="text" id="min" name="min"></td>
                <td>{{trans('dashboard.maximum_date')}}:</td>
                <td><input type="text" id="max" name="max"></td>
            </tr>
            </tbody>
        </table>
        <br>
        <table id="example" class="table table-bordered" >
            <thead>
            <tr>
                <th>{{trans('dashboard.customer_management_no')}}</th>
                <th>{{trans('dashboard.customer_management_bill_no')}}</th>
                <th>{{trans('dashboard.customer_management_bill_amount')}}</th>
                <th>{{trans('dashboard.customer_management_bill_paid')}}</th>
                <th id="created_at">{{trans('dashboard.customer_management_bill_date')}}</th>
                <th>{{trans('dashboard.customer_management_action')}}</th>
            </tr>
            </thead>

            <tbody>
            @foreach($customer_sale_orders ?? '' as $customer_sale_order)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$customer_sale_order->id}}</td>
                    <td>{{taka_format($customer_sale_order->billing_amount)}}</td>
                    <td>{{taka_format($customer_sale_order->paid_amount)}}</td>
                    <td id="created_at">{{$customer_sale_order->created_at->format('F d Y')}}</td>
                    <td class="text-center d-inline-flex">
                        <a class="btn btn-primary" href="{{route('customers.customer_payment_create',$customer_sale_order->id)}}">{{trans('dashboard.pay')}}</a>
                        <a class="btn btn-success" href="{{route('customers.customer_payment_edit_list',$customer_sale_order->id)}}">{{trans('dashboard.details')}}</a>
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

            h2,h4,h5{
                font-size: 13px;
            }
            img{
                width: 50%;
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
