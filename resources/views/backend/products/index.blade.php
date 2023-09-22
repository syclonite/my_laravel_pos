@extends('backend.layout')

@section('content')
    <div class="">
        <h1 class="d-flex justify-content-center">{{trans('dashboard.product_management')}}</h1>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn btn-success" href="{{route('products.create')}}">{{trans('dashboard.add_new')}}</a>
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
        <table class="table table-bordered ui celled table table-hover" style="width:100%" id="example">
            <thead>
            <tr>
                <th>{{trans('dashboard.product_management_no')}}</th>
                <th>{{trans('dashboard.product_management_product_name')}}</th>
                <th>{{trans('dashboard.product_management_available_stock')}}</th>
                <th>{{trans('dashboard.unit_management_unit_name')}}</th>
                <th>{{trans('dashboard.subcategory_management_subcategory_name')}}</th>
                <th>{{trans('dashboard.status')}}</th>
                <th id="created_at">{{trans('dashboard.date')}}</th>

                <th class="text-center" >{{trans('dashboard.action')}}</th>
            </tr>
            </thead>

            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$product->product_name}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->unit->unit_name??'0'}}</td>
                    <td>{{$product->subcategory->subcategory_name??'0'}}</td>
                    @if($product->status == '1')
                        <td>{{"Enable"}}</td>
                    @else
                        <td>{{"Disabled"}}</td>
                    @endif
                    <td>{{$product->created_at->format('F d Y')}}</td>
                    <td class="text-center d-inline-flex">
                        <a class="btn btn-sm btn-primary" href="{{route('products.edit', $product->id)}}">{{trans('dashboard.edit')}}</a>
                        <form action="{{route('products.destroy',$product->id)}}" method="POST">
                            @if($product->deleted_at == null || $product->deleted_at == '')
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-sm btn-warning">{{trans('dashboard.delete')}}</button>
                            @endif
                        </form>
                        <form action="{{route('products.restore',$product->id)}}" method="POST">
                            @if($product->deleted_at != null || $product->deleted_at != '')
                                @csrf
                                @method('POST')
                                <button type="submit"  class="btn btn-sm btn-success">{{trans('dashboard.restore')}}</button>
                            @endif
                        </form>
                        <form action="{{route('products.force_delete',$product->id)}}" method="POST">
                            @if($product->deleted_at != null || $product->deleted_at != '')
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-sm btn-danger">{{trans('dashboard.force_delete')}}</button>
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
