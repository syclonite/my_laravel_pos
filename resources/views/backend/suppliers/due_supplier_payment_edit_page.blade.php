@extends('backend.layout')

@section('content')
    <div class="">
        <h1 class="d-flex justify-content-center">{{trans('dashboard.supplier_management_supplier_payment_list')}}</h1>
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
        <div>
            <form action="{{route('suppliers.due_supplier_payment_update',$supplier_payments_details->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <strong>{{trans('dashboard.supplier_management_bill_no')}}: <span><input class="form-control" type="number" name="purchase_order_id" value="{{$supplier_payments_details->purchase_order_id}}" readonly></span></strong>
                                </div>
                                <div class="col-2">
                                    <strong>{{trans('dashboard.supplier_management_supplier_id')}}: <span><input class="form-control" type="number" name="supplier_id" value="{{$supplier_payments_details->supplier_id}}" readonly></span></strong>
                                </div>
                                <div class="col-4">
                                    <strong>{{trans('dashboard.supplier_management_bill_amount')}}: <span><input class="form-control" type="number" name="" value="{{$supplier_billing_amount}}" disabled></span></strong>
                                </div>
                                <div class="col-2">
                                    <br>
                                    <a href="{{route('suppliers.due_supplier_list_index')}}" class="btn btn-primary">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans('dashboard.supplier_management_pay_here')}}:</strong>
                            <input class="form-control" type="number" name="paid_amount" value="{{$supplier_payments_details->paid_amount}}" required>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Status:</strong>
                            <select name="status" id="" class="form-control" >
                                <option value='1' {{ $supplier_payments_details ->status == '1' ? 'selected':'' }}>Due</option>
                                <option value='0' {{ $supplier_payments_details ->status == '0' ? 'selected':'' }}>No Due</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <br>
                        <button type="submit" class="btn btn-primary btn-lg">{{trans('dashboard.submit')}}</button>
                    </div>
                </div>

            </form>
        </div>
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
