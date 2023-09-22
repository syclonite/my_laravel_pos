@extends('backend.layout')

@section('content')
    <div class="">
        <h1 class="d-flex justify-content-center">{{trans('dashboard.customer_management_customer_billing_edit_list')}}</h1>
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
        <a class="btn btn-primary" href="{{route('customers.customer_payment_index')}}">{{trans('dashboard.back')}}</a>
        <div><br></div>
        <table border="0" cellspacing="5" cellpadding="5" class="table table-success date_field">
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
                <th>{{trans('dashboard.customer_management_bill_paid')}}</th>
                <th id="created_at">{{trans('dashboard.customer_management_date')}}</th>
                <th>{{trans('dashboard.customer_management_action')}}</th>
                <th class="d-none"></th>
            </tr>
            </thead>

            <tbody>
            @foreach($customer_bill_wise_payments ?? '' as $customer_bill_wise_payment)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$customer_bill_wise_payment->sale_order_id}}</td>
                    <td>{{taka_format($customer_bill_wise_payment->paid_amount)}}</td>
                    <td>{{$customer_bill_wise_payment->created_at->format('F d Y')}}</td>
                    <td><a class="btn btn-primary" href="{{route('customers.customer_payment_edit_payment',$customer_bill_wise_payment->id)}}">{{trans('dashboard.customer_management_edit')}}</a></td>
                    <td class="d-none"></td>
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
        }


        .date_field {

            display: block;
            max-width: -moz-fit-content;
            max-width: fit-content;
            margin: 0 auto;
            overflow-x: auto;
            white-space: nowrap;

        }

    </style>



@endsection
