@extends('backend.layout')

@section('content')
    <div class="">
        <h1 class="d-flex justify-content-center">{{trans('dashboard.purchase_management')}}</h1>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn btn-success" href="{{route('purchase.create')}}">{{trans('dashboard.add_new')}}</a>
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
               <th>{{trans('dashboard.supplier_management_no')}}</th>
               <th>{{trans('dashboard.supplier_management_bill_no')}}</th>
               <th>{{trans('dashboard.supplier_management_supplier_name')}}</th>
               <th>{{trans('dashboard.supplier_management_total_bill')}}</th>
               <th>{{trans('dashboard.supplier_management_total_paid')}}</th>
               <th>{{trans('dashboard.voucher_management_discount')}}</th>
               <th>{{trans('dashboard.voucher_management_extra_charge')}}</th>
               <th>{{trans('dashboard.supplier_management_due')}}</th>
               <th>{{trans('dashboard.user_management_name')}}</th>
               <th>{{trans('dashboard.status')}}</th>
               <th id="created_at">{{trans('dashboard.date')}}</th>
               <th class="text-center" >{{trans('dashboard.action')}}</th>
           </tr>
           </thead>

            <tbody>
            @foreach($purchaseOrders as $purchaseOrder)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$purchaseOrder->id}}</td>
                    <td>{{$purchaseOrder->supplier->supplier_name??'#'}}</td>
                    <td>{{$purchaseOrder->billing_amount}}</td>
                    <td>{{$purchaseOrder->paid_amount}}</td>
                    <td>{{$purchaseOrder->discount}}</td>
                    <td>{{$purchaseOrder->extra_charge}}</td>
                    @if($purchaseOrder->billing_amount > $purchaseOrder->paid_amount)
                    <td>{{$purchaseOrder->billing_amount - $purchaseOrder->paid_amount}}</td>
                    @else
                    <td>{{"0"}}</td>
                    @endif
                    <td>{{$purchaseOrder->user->name}}</td>
                    @if($purchaseOrder->status == '1')
                        <td>{{"Due"}}</td>
                    @else
                        <td>{{"Cash"}}</td>
                    @endif
                    <td>{{$purchaseOrder->created_at->format('F d Y')}}</td>
                    <td class="text-center d-inline-flex">
                        <form action="{{route('purchase.destroy',$purchaseOrder->id)}}" method="POST">
                            <a class="btn btn-sm btn-primary" href="{{route('purchase.edit', $purchaseOrder->id)}}">{{trans('dashboard.edit')}}</a>
                            <a class="btn btn-sm btn-danger" href="{{route('purchase.print_purchase_invoice',$purchaseOrder->id)}}">{{trans('dashboard.print')}}</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-warning">{{trans('dashboard.delete')}}</button>
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
                max-width: fit-content;
                margin: 0 auto;
                overflow-x: auto;
                white-space: nowrap;
            }

        }
    </style>
@endsection
