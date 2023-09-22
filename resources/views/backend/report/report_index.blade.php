@extends('backend.layout')
@section('content')
    <div class="">
        <h1>{{trans('dashboard.report_section')}}</h1>
    </div>
    <br>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-white text-black mb-4">
                <div class="card-body">{{trans('dashboard.net_profit')}}</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                @foreach($total_net_profit as $net_profit)
                    <h2>{{($net_profit->revenue - $net_profit->cost_sale) - $net_profit->expense}}</h2>
                    {{--                            <a class="small text-white stretched-link" href="#">View Details</a>--}}
                    {{--                            <div class="small text-white"><i class="fa fa-angle-right"></i></div>--}}
                @endforeach
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-white text-black mb-4">
                <div class="card-body">{{trans('dashboard.gross_profit_report')}}</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    @foreach($total_gross_profit as $gross_profit)
                    <h2>{{$gross_profit->revenue - $gross_profit->cost_sale}}</h2>
                    {{--                            <a class="small text-white stretched-link" href="#">View Details</a>--}}
                    {{--                            <div class="small text-white"><i class="fa fa-angle-right"></i></div>--}}
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-white text-black mb-4">
                <div class="card-body">{{trans('dashboard.supplier_due')}}</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    @foreach($supplier_due_summary as $supplier)
                    <h2>{{$supplier->total_billing_amount - $supplier->total_paid_amount}}</h2>
                    {{--                            <a class="small text-black stretched-link" href="#">View Details</a>--}}
                    {{--                            <div class="small text-white"><i class="fa fa-angle-right"></i></div>--}}
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-white text-black mb-4">
                <div class="card-body">{{trans('dashboard.customer_due')}}</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    @foreach($customer_due_summary as $customer)
                    <h2>{{$customer->total_bill - $customer->total_paid}}</h2>
                    {{--                            <a class="small text-black stretched-link" href="#">View Details</a>--}}
                    {{--                            <div class="small text-white"><i class="fa fa-angle-right"></i></div>--}}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xl-3 col-md-6 text-center my-auto mb-4">
            <a href="{{route('stock_report_index')}}">
                <div class="card card-block d-flex shadow bg-white rounded" style="height:10rem;" >
                    <div class="card-body align-items-center d-flex justify-content-center">
                        <img src="{{url('images/stock_report.png')}}" style="height: 80px; width: 80px;">
                    </div>
                    <h3 class="text-uppercase" style="font-size: 24px;font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.stock_report')}}</h3>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 text-center my-auto mb-4">
            <a href="{{route('suppliers.due_supplier_list_index')}}">
                <div class="card card-block d-flex shadow bg-white rounded" style="height:10rem;" >
                    <div class="card-body align-items-center d-flex justify-content-center">
                        <img src="{{url('images/expense_report.png')}}" style="height: 80px; width: 80px;">
                    </div>
                    <h3 class="text-uppercase" style="font-size: 24px;font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.supplier_report')}}</h3>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 text-center my-auto mb-4">
            <a href="{{route('sales_voucher_report_index')}}">
                <div class="card card-block d-flex shadow bg-white rounded" style="height:10rem;" >
                    <div class="card-body align-items-center d-flex justify-content-center">
                        <img src="{{url('images/sales_report.png')}}" style="height: 80px; width: 80px;">
                    </div>
                    <h3 class="text-uppercase" style="font-size: 24px;font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.sales_report')}}</h3>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 text-center my-auto mb-4">
            <a href="{{route('customers.customer_payment_index')}}">
                <div class="card card-block d-flex shadow bg-white rounded" style="height:10rem;" >
                    <div class="card-body align-items-center d-flex justify-content-center">
                        <img src="{{url('images/customer_report.png')}}" style="height: 80px; width: 80px;">
                    </div>
                    <h3 class="text-uppercase" style="font-size: 24px;font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.customer_report')}}</h3>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 text-center my-auto mb-4">
            <a href="{{route('gross_profit_index')}}">
                <div class="card card-block d-flex shadow bg-white rounded" style="height:10rem;" >
                    <div class="card-body align-items-center d-flex justify-content-center">
                        <img src="{{url('images/gross_profit.png')}}" style="height: 80px; width: 80px;">
                    </div>
                    <h3 class="text-uppercase" style="font-size: 24px;font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.gross_profit_report')}}</h3>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 text-center my-auto mb-4">
            <a href="{{route('expense_record.index')}}">
                <div class="card card-block d-flex shadow bg-white rounded" style="height:10rem;" >
                    <div class="card-body align-items-center d-flex justify-content-center">
                        <img src="{{url('images/expenses.png')}}" style="height: 80px; width: 80px;">
                    </div>
                    <h3 class="text-uppercase" style="font-size: 24px;font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.expense_report')}}</h3>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 text-center my-auto mb-4">
            <a href="{{route('net_profit_index')}}">
                <div class="card card-block d-flex shadow bg-white rounded" style="height:10rem;" >
                    <div class="card-body align-items-center d-flex justify-content-center">
                        <img src="{{url('images/net_profit.png')}}" style="height: 80px; width: 80px;">
                    </div>
                    <h3 class="text-uppercase" style="font-size: 24px;font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.net_profit')}}</h3>
                </div>
            </a>
        </div>
    </div>
    <style>
        a{
            text-decoration:none;
            color: black;
        }
    </style>
@endsection

