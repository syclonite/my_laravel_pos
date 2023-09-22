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
        <br>
        <div>
            <form action="{{route('customers.customer_payment_update',$customer_payments_details->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <strong>{{trans('dashboard.customer_management_bill_no')}}: <span><input class="form-control" type="number" name="sale_order_id" value="{{$customer_payments_details->sale_order_id}}" readonly></span></strong>
                                </div>
                                <div class="col-2">
                                    <strong>{{trans('dashboard.customer_management_customer_id')}}: <span><input class="form-control" type="number" name="customer_id" value="{{$customer_payments_details->customer_id}}" readonly></span></strong>
                                </div>
                                <div class="col-4">
                                    <strong>{{trans('dashboard.customer_management_bill_amount')}}: <span><input class="form-control" type="text" name="customer_id" value="{{taka_format($customer_payments_details->sale_order->billing_amount)}}" disabled></span></strong>
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
                            <input class="form-control" type="number" name="paid_amount" value="{{$customer_payments_details->paid_amount}}" required>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans('dashboard.customer_management_status')}}:</strong>
                            <select name="status" id="" class="form-control" required>
                                <option value='1' {{ $customer_payments_details ->status == '1' ? 'selected':'' }}>Due</option>
                                <option value='0' {{ $customer_payments_details ->status == '0' ? 'selected':'' }}>No Due</option>
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
