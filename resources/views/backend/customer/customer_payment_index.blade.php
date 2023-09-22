@extends('backend.layout')

@section('content')
    <div class="">
        <h1 class="d-flex justify-content-center">{{trans('dashboard.customer_management_customer_payment_list')}}</h1>
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
{{--        <br>--}}
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
        <strong><span><a href="{{route('customers.index')}}" class="btn btn-primary">Back</a></span></strong>
        <div><br></div>
        <div class="row">
            @foreach($customer_due_summary as $data)
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-white text-black mb-4">
                        <div class="card-body">{{trans('dashboard.total_customers')}}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <h2>{{taka_format($data->customer_count)}}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-white text-black mb-4">
                        <div class="card-body">{{trans('dashboard.total_bill_amount')}}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <h2>{{taka_format($data->total_bill)}}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-white text-black mb-4">
                        <div class="card-body">{{trans('dashboard.total_receive_amount')}}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <h2>{{taka_format($data->total_paid)}}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-white text-black mb-4">
                        <div class="card-body">{{trans('dashboard.total_due_amount')}}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                                <h2>{{taka_format($only_total_due_amount??'0')}}</h2>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <br>
        <table id="example" class="table table-bordered" >
            <thead>
            <tr>
                <th>{{trans('dashboard.customer_management_no')}}</th>
                <th>{{trans('dashboard.customer_management_name')}}</th>
                <th>{{trans('dashboard.customer_management_phone')}}</th>
                <th>{{trans('dashboard.customer_management_total_bill')}}</th>
                <th>{{trans('dashboard.customer_management_total_paid')}}</th>
                <th>{{trans('dashboard.customer_management_due')}}</th>
                <th>{{trans('dashboard.customer_management_advance')}}</th>
                <th>{{trans('dashboard.customer_management_action')}}</th>
            </tr>
            </thead>

            <tbody>
            @foreach($customer_billing_details ?? '' as $customer_billing_detail)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$customer_billing_detail->name}}</td>
                    <td>{{$customer_billing_detail->phone}}</td>
                    <td>{{taka_format($customer_billing_detail->total_billing_amount)}}</td>
                    <td>{{taka_format($customer_billing_detail->total_paid_amount)}}</td>
                    @if($customer_billing_detail->total_billing_amount > $customer_billing_detail->total_paid_amount)
                    <td>{{taka_format($customer_billing_detail->total_billing_amount - $customer_billing_detail->total_paid_amount)}}</td>
                    @else
                     <td>0</td>
                    @endif
                    @if($customer_billing_detail->total_billing_amount < $customer_billing_detail->total_paid_amount)
                        <td>{{taka_format($customer_billing_detail->total_paid_amount  - $customer_billing_detail->total_billing_amount )}}</td>
                    @else
                        <td>0</td>
                    @endif
                    <td class="text-center d-inline-flex">
                        <a class="btn btn-warning" href="{{route('customers.due_customer_billing_list',$customer_billing_detail->id)}}">{{trans('dashboard.details')}}</a>
{{--                        <form action="{{route('customers.restore',$customer->id)}}" method="POST">--}}
{{--                            @if($customer->deleted_at != null || $customer->deleted_at != '')--}}
{{--                                @csrf--}}
{{--                                @method('POST')--}}
{{--                                <button type="submit"  class="btn btn-success">Restore</button>--}}
{{--                            @endif--}}
{{--                        </form>--}}
{{--                        <form action="{{route('customers.force_delete',$customer->id)}}" method="POST">--}}
{{--                            @if($customer->deleted_at != null || $customer->deleted_at != '')--}}
{{--                                @csrf--}}
{{--                                @method('DELETE')--}}
{{--                                <button type="submit"  class="btn btn-warning">Force Delete</button>--}}
{{--                            @endif--}}
{{--                        </form>--}}
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
