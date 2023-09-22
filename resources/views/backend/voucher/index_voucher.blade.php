@extends('backend.layout')

@section('content')
    <div class="">
        <h1 class="d-flex justify-content-center">{{trans('dashboard.voucher_management')}}</h1>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn btn-success" href="{{route('voucher.create_voucher')}}">{{trans('dashboard.add_new')}}</a>
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
        <br>
        <table class="table table-bordered table-hover" id="example">
            <thead>
            <tr>
                <th>{{trans('dashboard.customer_management_no')}} </th>
                <th>{{trans('dashboard.customer_management_name')}} </th>
                <th>{{trans('dashboard.customer_management_total_bill')}} </th>
                <th>{{trans('dashboard.voucher_management_extra_charge')}} </th>
                <th>{{trans('dashboard.voucher_management_discount')}} </th>
                <th id="created_at">{{trans('dashboard.date')}} </th>
                <th class="text-center" >{{trans('dashboard.customer_management_action')}} </th>
            </tr>
            </thead>

            <tbody>
            @foreach($vouchers as $voucher)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$voucher->customer->name??"#"}}</td>
                    <td>{{$voucher->billing_amount}}</td>
                    <td>{{$voucher->extra_charge}}</td>
                    <td>{{$voucher->discount}}</td>
                    <td>{{$voucher->created_at->format('F d Y')}}</td>
                    <td class="d-inline-flex text-center">
                        <form action="{{route('voucher.destroy',$voucher->id)}}" method="POST">
                            <a class="btn btn-sm btn-primary" href="{{route('voucher.print_voucher',$voucher->id)}}">{{trans('dashboard.print')}} </a>
                            @if($voucher->deleted_at == null || $voucher->deleted_at == '')
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-sm btn-warning">{{trans('dashboard.delete')}}</button>
                            @endif
                        </form>
                        <form action="{{route('voucher.restore',$voucher->id)}}" method="POST">
                            @if($voucher->deleted_at != null || $voucher->deleted_at != '')
                                @csrf
                                @method('POST')
                                <button type="submit"  class="btn btn-sm btn-success">{{trans('dashboard.restore')}}</button>
                            @endif
                        </form>
                        <form action="{{route('voucher.force_delete',$voucher->id)}}" method="POST">
                            @if($voucher->deleted_at != null || $voucher->deleted_at != '')
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

            h2,h4,h5{
                font-size: 13px;
            }
            img{
                width: 50%;
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
