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
        <div>
            <form action="{{route('customers.customer_payment_store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                  <strong>{{trans('dashboard.customer_management_bill_no')}}: <span><input class="form-control" type="number" name="sale_order_id" value="{{$customer_bill_no}}" readonly></span></strong>
                                </div>
                                <div class="col-2">
                                  <strong>{{trans('dashboard.customer_management_customer_id')}}: <span><input class="form-control" type="number" name="customer_id" value="{{$customer_id}}" readonly></span></strong>
                                </div>
                                <div class="col-4">
{{--                                  <strong>{{trans('dashboard.customer_management_bill_amount')}}: <span><input class="form-control" type="number" name="customer_id" value="{{$customer_bills}}" disabled></span></strong>--}}
                                  <strong>{{trans('dashboard.customer_management_bill_amount')}}: <span><input class="form-control" type="text" name="customer_id" value="{{taka_format($customer_bills)}}" disabled></span></strong>
                                </div>
                                <div class="col-2">
                                    <br>
                                    <strong><span><a href="{{route('customers.customer_payment_index')}}" class="btn btn-primary">Back</a></span></strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans('dashboard.customer_management_pay_here')}}:</strong>
                            <input class="form-control" type="number" name="paid_amount" required>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans('dashboard.customer_management_status')}}:</strong>
                            <select name="status" id="" class="form-control" required>
                                <option value="1">Due</option>
                                <option value="0">No Due</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <br>
                        <button type="submit" class="btn btn-primary btn-sm">{{trans('dashboard.customer_management_submit')}}</button>
                    </div>
                </div>

            </form>
        </div>
        <br>
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
                <th>{{trans('dashboard.customer_management_bill_paid')}}</th>
                <th id="created_at">{{trans('dashboard.customer_management_payment_date')}}</th>
            </tr>
            </thead>

            <tbody>
            @foreach($customer_bill_wise_payments ?? '' as $customer_bill_wise_payment)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$customer_bill_wise_payment->sale_order_id}}</td>
                    <td>{{taka_format($customer_bill_wise_payment->paid_amount)}}</td>
                    <td>{{$customer_bill_wise_payment->created_at->format('F d Y')}}</td>
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
