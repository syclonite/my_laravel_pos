@extends('backend.layout')

@section('content')
    <div class="">
        <h1 class="d-flex justify-content-center">{{trans('dashboard.sale_management')}}</h1>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn btn-success" href="{{route('sales.create')}}">{{trans('dashboard.add_new')}}</a>
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
            <tbody><tr>
                <td>{{trans('dashboard.minimum_date')}}:</td>
                <td><input type="text" id="min" name="min"></td>
                <td>{{trans('dashboard.maximum_date')}}:</td>
                <td><input type="text" id="max" name="max"></td>
            </tr>
            </tbody></table>
        <br>
        <table class="table table-bordered table-hover" id="example">
            <thead>
            <tr>
                <th>{{trans('dashboard.customer_management_no')}} </th>
                <th>{{trans('dashboard.customer_management_bill_no')}}</th>
                <th>{{trans('dashboard.customer_management_name')}} </th>
                <th>{{trans('dashboard.customer_management_total_bill')}}</th>
                <th>{{trans('dashboard.customer_management_total_paid')}}</th>
                <th>{{trans('dashboard.voucher_management_discount')}}</th>
                <th>{{trans('dashboard.voucher_management_extra_charge')}}</th>
                <th>{{trans('dashboard.customer_management_due')}}</th>
                <th>{{trans('dashboard.created_by')}}</th>
                <th>{{trans('dashboard.status')}}</th>
                <th id="created_at">{{trans('dashboard.date')}}</th>

                <th class="text-center" >{{trans('dashboard.action')}}</th>
            </tr>
            </thead>

            <tbody>
            @foreach($sale_orders as $sale_order)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$sale_order->id}}</td>
                    <td>{{$sale_order->customer->name??"#"}}</td>
                    <td>{{taka_format($sale_order->billing_amount)}}</td>
                    <td>{{taka_format($sale_order->paid_amount)}}</td>
                    <td>{{taka_format($sale_order->discount)}}</td>
                    <td>{{taka_format($sale_order->extra_charge)}}</td>
                    @if($sale_order->billing_amount > $sale_order->paid_amount)
                        <td>{{taka_format($sale_order->billing_amount - $sale_order->paid_amount)}}</td>
                    @else
                        <td>{{"0"}}</td>
                    @endif
                    <td>{{$sale_order->user->name}}</td>
                    @if($sale_order->status == '1')
                        <td>{{"Due"}}</td>
                    @else
                        <td>{{"Cash"}}</td>
                    @endif
                    <td>{{$sale_order->created_at->format('F d Y')}}</td>
                    <td class="text-center d-flex d-inline-flex">
                        <form action="{{route('sales.destroy',$sale_order->id)}}" method="POST">
                            <a class="btn btn-sm btn-primary" href="{{route('sales.edit',$sale_order->id)}}">{{trans('dashboard.edit')}}</a>
                            <a class="btn btn-sm btn-warning" href="{{route('sales.print_sale_invoice',$sale_order->id)}}">{{trans('dashboard.print')}}</a>
                            @csrf
                            @method('DELETE')
                            @if(has_permission(Auth::id(),"sales.destroy"))
                            <button type="submit" class="btn btn-sm btn-danger">{{trans('dashboard.delete')}}</button>
                            @endif
                        </form>
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
