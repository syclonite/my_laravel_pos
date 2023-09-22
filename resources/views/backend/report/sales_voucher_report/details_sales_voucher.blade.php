@extends('backend.layout')
@section('content')
    <div>
    <a href="{{route('sales_voucher_report_index')}}" class="btn btn-primary">Back</a>
    <button type="submit" class="btn btn-success" onclick="button_print()">Print</button>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <div class="col-12 d-inline-flex"><strong>{{trans('dashboard.customer_management_name')}}: </strong> <span> {{$customers->name}}</span></div>
                    <div class="col-12 d-inline-flex"><strong>{{trans('dashboard.customer_management_phone')}}: </strong> <span> {{$customers->phone}}</span></div>
                    <div class="col-12 d-inline-flex"><strong>{{trans('dashboard.customer_management_address')}}: </strong> <span> {{$customers->address}}</span></div>
                </div>
            </div>
        </div>
    </div>
    <table class=" table table-bordered">
        <thead>
        <tr>
            <th>{{trans('dashboard.customer_management_no')}}</th>
            <th>{{trans('dashboard.product_management_product_name')}}</th>
            <th>{{trans('dashboard.unit_management_unit_name')}}</th>
            <th>{{trans('dashboard.selling_price')}}</th>
            <th>{{trans('dashboard.quantity')}}</th>
            <th>{{trans('dashboard.subtotal')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sale_order_details as $key=> $sale_order_detail )
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$sale_order_detail->product->product_name}}</td>
                <td>{{$sale_order_detail->unit->unit_name}}</td>
                <td>{{$sale_order_detail->product_selling_price}}</td>
                <td>{{$sale_order_detail->quantity}}</td>
                <td>{{($sale_order_detail->quantity) * ($sale_order_detail->product_selling_price)}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br>
    <div>
        <div class="row">
            <div class="offset-sm-2 offset-md-8 col-4">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">{{trans('dashboard.voucher_management_discount')}}: {{$sale_order->discount??''}}</li>
                            <li class="list-group-item">{{trans('dashboard.voucher_management_extra_charge')}}:{{$sale_order->extra_charge??''}}</li>
                            <li class="list-group-item">{{trans('dashboard.customer_management_total_bill')}}: {{$sale_order->billing_amount??''}}</li>
                            <li class="list-group-item">{{trans('dashboard.customer_management_bill_paid')}}: {{$sale_order->paid_amount??''}}</li>
                            <li class="list-group-item">{{trans('dashboard.purchase_management_return_amount')}} : {{$sale_order->change_amount??''}}</li>
                        </ul>
                    </div>
                </div>
            </div>
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

    <script>
        function button_print(){
            // alert('You have')
            window.print();
        }
    </script>
@endsection
