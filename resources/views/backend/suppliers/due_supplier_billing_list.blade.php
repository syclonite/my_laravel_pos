@extends('backend.layout')

@section('content')
    <div class="">
        <h1 class="d-flex justify-content-center">{{trans('dashboard.supplier_management_billing_list')}}</h1>
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
        <a href="{{route('suppliers.due_supplier_list_index')}}" class="btn btn-primary">Back</a>
        <div><br></div>
        <table id="example" class="table table-bordered" >
            <thead>
                <tr>
                    <th>{{trans('dashboard.supplier_management_no')}}</th>
                    <th>{{trans('dashboard.supplier_management_bill_no')}}</th>
                    <th>{{trans('dashboard.supplier_management_bill_amount')}}</th>
                    <th>{{trans('dashboard.supplier_management_bill_paid')}}</th>
                    <th id="created_at">{{trans('dashboard.date')}} </th>
                    <th>{{trans('dashboard.action')}}</th>
                </tr>
            </thead>

            <tbody>
            @foreach($supplier_purchase_orders ?? '' as $supplier_purchase_order)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$supplier_purchase_order->id}}</td>
                    <td>{{taka_format($supplier_purchase_order->billing_amount)}}</td>
                    <td>{{taka_format($supplier_purchase_order->paid_amount)}}</td>
                    <td>{{$supplier_purchase_order->created_at->format('F d Y')}}</td>
                    <td class="text-center d-inline-flex">
                        <a class="btn btn-primary" href="{{route('suppliers.due_supplier_payment_create',$supplier_purchase_order->id)}}">Pay</a>
                        <a class="btn btn-success" href="{{route('suppliers.due_supplier_payment_edit_list',$supplier_purchase_order->id)}}">Details</a>
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
