@extends('backend.layout')
@section('content')
    <div class="">
        <h1 class="d-flex justify-content-center">{{trans('dashboard.all_stock_report')}}</h1>
        <br>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <br>

        <table class="table table-bordered" id="example">
            <thead>
            <tr>
                <th>{{trans('dashboard.product_management_product_name')}}</th>
                <th>{{trans('dashboard.units')}}</th>
                <th>{{trans('dashboard.product_management_product_description')}}</th>
                <th>{{trans('dashboard.subcategory_management_subcategory_name')}}</th>
                <th>{{trans('dashboard.supplier_management_supplier_name')}}</th>
                <th>{{trans('dashboard.purchase_price')}}</th>
                <th>{{trans('dashboard.selling_price')}}</th>
                <th>{{trans('dashboard.product_management_available_stock')}}</th>
                <th>{{trans('dashboard.reorder')}}</th>
                <th>{{trans('dashboard.date')}}</th>
            </tr>
            </thead>

            <tbody>
            @foreach($all_stock_reports as $data)
                <tr>
                    <td>{{$data->product_name}}</td>
                    <td>{{$data->unit_name}}</td>
                    <td>{{$data->product_description}}</td>
                    <td>{{$data->subcategory_name}}</td>
                    <td>{{$data->supplier_name}}</td>
                    <td>{{$data->purchase_price}}</td>
                    <td>{{$data->selling_price}}</td>
                    <td>{{$data->quantity}}</td>
                    @if($data->quantity < 20)
                    <td>Reorder</td>
                    @else
                    <td>Dont Order</td>
                    @endif
                    <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d/M/Y g:i A') }}</td>
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
