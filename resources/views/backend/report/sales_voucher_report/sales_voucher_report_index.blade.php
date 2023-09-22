@extends('backend.layout')
@section('content')
    <div class="">
        <h1 class="d-flex justify-content-center">{{trans('dashboard.sales_report')}}</h1>
        <br>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <br>
        {{--        <table border="0" cellspacing="5" cellpadding="5">--}}
        {{--            <tbody><tr>--}}
        {{--                <td>{{trans('dashboard.minimum_date')}}:</td>--}}
        {{--                <td><input type="text" id="min" name="min"></td>--}}
        {{--            </tr>--}}
        {{--            <tr>--}}
        {{--                <td>{{trans('dashboard.maximum_date')}}:</td>--}}
        {{--                <td><input type="text" id="max" name="max"></td>--}}
        {{--            </tr>--}}
        {{--            </tbody></table>--}}
        <div class="row gy-5">
            <div class="col"><a href="{{route('sales_voucher_daily_report')}}" class="btn btn-primary btn-lg">{{trans('dashboard.daily_sales')}}</a></div>
            <div class="col"><a href="{{route('sales_voucher_weekly_report')}}" class="btn btn-primary btn-lg">{{trans('dashboard.weekly_sales')}}</a></div>
            <div class="col"><a href="{{route('sales_voucher_monthly_report')}}" class="btn btn-primary btn-lg">{{trans('dashboard.monthly_sales')}}</a></div>
            <div class="col"><a href="{{route('sales_voucher_yearly_report')}}" class="btn btn-primary btn-lg">{{trans('dashboard.yearly_sales')}}</a></div>
        </div>
        <br>
        <form method="GET" action="{{route('sales_voucher_report_index')}}">
            @csrf
            <div class="row input-daterange">
                <div class="col-md-4">
                    {{trans('dashboard.minimum_date')}}
                    <input type="date" name="start_date" id="start_date" class="form-control" placeholder="From Date" required />
                </div>
                <div class="col-md-4">
                    {{trans('dashboard.maximum_date')}}
                    <input type="date" name="end_date" id="end_date" class="form-control" placeholder="To Date" required />
                </div>
                <div class="col-md-4">
                    <br>
                    <button type="submit" name="filter" id="filter" class="btn btn-primary">{{trans('dashboard.filter')}}</button>
                </div>
            </div>
        </form>
        <br>
        <div class="row">
            @foreach($total_sale_reports as $sale_report)
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-white text-black mb-4">
                        <div class="card-body">{{trans('dashboard.total_sales_voucher')}}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <h2>{{taka_format($sale_report->voucher_count )}}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-white text-black mb-4">
                        <div class="card-body">{{trans('dashboard.total_bill_amount')}}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <h2>{{taka_format($sale_report->total_bill )}}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-white text-black mb-4">
                        <div class="card-body">{{trans('dashboard.total_receive_amount')}}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <h2>{{taka_format($sale_report->total_paid )}}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-white text-black mb-4">
                        <div class="card-body">{{trans('dashboard.total_due_amount')}}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <h2>{{taka_format($only_total_due_amount)}}</h2>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <br>
        <table class="table table-bordered" id="example">
            <thead>
            <tr>
                <th>{{trans('dashboard.customer_management_bill_no')}}</th>
                <th>{{trans('dashboard.customer_management_name')}}</th>
                <th>{{trans('dashboard.total_items')}}</th>
                <th>{{trans('dashboard.customer_management_total_bill')}}</th>
                <th>{{trans('dashboard.voucher_management_extra_charge')}}</th>
                <th>{{trans('dashboard.voucher_management_discount')}}</th>
                <th>{{trans('dashboard.received')}}</th>
                <th>{{trans('dashboard.customer_management_due')}}</th>
                <th>{{trans('dashboard.customer_management_advance')}}</th>
                <th>{{trans('dashboard.action')}}</th>
            </tr>
            </thead>

            <tbody>

            @foreach($table_data as $data)
                <tr>
                    <td>{{$data->id}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->items}}</td>
                    <td>{{$data->billing_amount}}</td>
                    <td>{{$data->extra_charge}}</td>
                    <td>{{$data->discount}}</td>
                    <td>{{$data->paid_amount}}</td>
                    @if($data->billing_amount > $data->paid_amount)
                    <td>{{$data->billing_amount - $data->paid_amount}}</td>
                    @else
                    <td>0</td>
                    @endif
                    @if($data->paid_amount > $data->billing_amount)
                        <td>{{$data->paid_amount - $data->billing_amount}}</td>
                    @else
                        <td>0</td>
                    @endif
                    <td><a href="{{route('sales_voucher_details_list',$data->id)}}" class="btn btn-primary">{{trans('dashboard.details')}}</a></td>
{{--                    @if($stock->quantity < '5')--}}
{{--                        <td>{{"Urgent Purchase"}}</td>--}}
{{--                    @else--}}
{{--                        <td>{{"Normal Purchase"}}</td>--}}
{{--                    @endif--}}
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
                max-width: fit-content;
                margin: 0 auto;
                overflow-x: auto;
                white-space: nowrap;

            }
            .btn-lg{
                font-size: 24px;
            }
        }

    </style>
@endsection
