@extends('backend.layout')
@section('content')
    <div class="">
        <h1 class="d-flex justify-content-center">{{trans('dashboard.stock_report')}}</h1>
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
        <br>

        <table class="table table-bordered" id="example">
            <thead>
            <tr>
                <th>{{trans('dashboard.serial')}}</th>
                <th>{{trans('dashboard.product_management_product_name')}}</th>
                <th>{{trans('dashboard.unit_management_unit_name')}}</th>
                <th>{{trans('dashboard.product_management_available_stock')}}</th>
                <th>{{trans('dashboard.purchase_price')}}</th>
                <th>{{trans('dashboard.status')}}</th>
            </tr>
            </thead>

            <tbody>
            @foreach($stocks as $key => $stock)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$stock->product_name}}</td>
                    <td>{{$stock->unit->unit_name}}</td>
                    <td>{{$stock->quantity}}</td>
                    <td>{{$stock->purchase_price}}</td>
                    @if($stock->quantity < '5')
                        <td>{{"Urgent Purchase"}}</td>
                    @else
                        <td>{{"Normal Purchase"}}</td>
                    @endif
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
