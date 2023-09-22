@extends('backend.layout')

@section('content')
    <div class="">
        <h1 class="d-flex justify-content-center">{{trans('dashboard.supplier_management_due_supplier_list')}}</h1>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
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
        <div class="row">
            @foreach($supplier_due_summary as $data)
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-white text-black mb-4">
                        <div class="card-body">{{trans('dashboard.total_suppliers')}}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <h2>{{$data->supplier_count}}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-white text-black mb-4">
                        <div class="card-body">{{trans('dashboard.total_bill_amount')}}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <h2>{{taka_format($data->total_billing_amount)}}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card bg-white text-black mb-4">
                        <div class="card-body">{{trans('dashboard.total_receive_amount')}}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <h2>{{taka_format($data->total_paid_amount)}}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-white text-black mb-4">
                        <div class="card-body">{{trans('dashboard.total_due_amount')}}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <h2>{{taka_format($only_supplier_total_due_amount??'0')}}</h2>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <a href="{{route('suppliers.index')}}" class="btn btn-primary">Back</a>
        <div><br></div>
        <table id="example" class="table table-bordered" >
            <thead>
            <tr>
                <th>{{trans('dashboard.supplier_management_no')}}</th>
                <th>{{trans('dashboard.supplier_management_supplier_name')}}</th>
                <th>{{trans('dashboard.supplier_management_phone')}}</th>
                <th>{{trans('dashboard.supplier_management_total_bill')}}</th>
                <th>{{trans('dashboard.supplier_management_total_paid')}}</th>
                <th>{{trans('dashboard.supplier_management_due')}}</th>
                <th>{{trans('dashboard.customer_management_advance')}}</th>
                <th>{{trans('dashboard.action')}}</th>
            </tr>
            </thead>

            <tbody>
            @foreach($supplier_billing_details ?? '' as $supplier_billing_detail)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$supplier_billing_detail->supplier_name}}</td>
                    <td>{{$supplier_billing_detail->phone_1}}</td>
                    <td>{{taka_format($supplier_billing_detail->total_billing_amount)}}</td>
                    <td>{{taka_format($supplier_billing_detail->total_paid_amount)}}</td>
                    @if($supplier_billing_detail->total_billing_amount > $supplier_billing_detail->total_paid_amount)
                        <td>{{taka_format($supplier_billing_detail->total_billing_amount - $supplier_billing_detail->total_paid_amount)}}</td>
                    @else
                        <td>0</td>
                    @endif
                    @if($supplier_billing_detail->total_billing_amount < $supplier_billing_detail->total_paid_amount)
                        <td>{{taka_format($supplier_billing_detail->total_paid_amount  - $supplier_billing_detail->total_billing_amount)}}</td>
                    @else
                        <td>0</td>
                    @endif
                    <td class="text-center d-inline-flex">
                        <a class="btn btn-warning" href="{{route('suppliers.due_supplier_billing_list',$supplier_billing_detail->id)}}">{{trans('dashboard.details')}}</a>
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
