@extends('backend.layout')

@section('content')
    <div class="">
        <h1 class="d-flex justify-content-center">{{trans('dashboard.supplier_management_supplier_payment_list')}}</h1>
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
            <a href="{{route('suppliers.due_supplier_list_index')}}" class="btn btn-primary">Back</a>
        <div><br></div>
        <table id="example" class="table table-bordered" >
            <thead>
            <tr>
                <th>{{trans('dashboard.supplier_management_no')}}</th>
                <th>{{trans('dashboard.supplier_management_bill_no')}}</th>
                <th>{{trans('dashboard.supplier_management_bill_paid')}}</th>
                <th id="created_at">{{trans('dashboard.date')}}</th>
                <th>{{trans('dashboard.action')}}</th>
                <th class="d-none"></th>
            </tr>
            </thead>

            <tbody>
            @foreach($supplier_bill_wise_payments ?? '' as $supplier_bill_wise_payment)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$supplier_bill_wise_payment->purchase_order_id}}</td>
                    <td>{{$supplier_bill_wise_payment->paid_amount}}</td>
                    <td>{{$supplier_bill_wise_payment->created_at->format('F d Y')}}</td>
                    <td><a class="btn btn-primary" href="{{route('suppliers.due_supplier_payment_edit_page',$supplier_bill_wise_payment->id)}}">{{trans('dashboard.edit')}}</a></td>
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

            .date_field {

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
