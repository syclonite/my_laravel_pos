@extends('backend.layout')

@section('content')
    <div class="">
        <h1 class="d-flex justify-content-center">{{trans('dashboard.supplier_management')}}</h1>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn btn-success" href="{{route('suppliers.create')}}">{{trans('dashboard.add_new')}}</a>
                    <a class="btn btn-primary" href="{{route('suppliers.due_supplier_list_index')}}">{{trans('dashboard.supplier_management_due_supplier_list')}}</a>
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
        <table class="table table-bordered" id="example">
           <thead>
           <tr>
               <th>{{trans('dashboard.supplier_management_no')}}</th>
               <th>{{trans('dashboard.supplier_management_supplier_name')}}</th>
               <th>{{trans('dashboard.supplier_management_phone')}}</th>
               <th>{{trans('dashboard.supplier_management_address')}}</th>
               <th>{{trans('dashboard.supplier_management_remarks')}}</th>
               <th>{{trans('dashboard.status')}}</th>
               <th id="created_at">{{trans('dashboard.date')}}</th>

               <th class="text-center" >{{trans('dashboard.action')}}</th>
           </tr>
           </thead>

            <tbody>
            @foreach($suppliers as $supplier)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$supplier->supplier_name}}</td>
                    <td>{{$supplier->phone_1}}</td>
                    <td>{{$supplier->address}}</td>
                    <td>{{$supplier->remarks}}</td>
                    @if($supplier->status == '1')
                        <td>{{"Enable"}}</td>
                    @else
                        <td>{{"Disabled"}}</td>
                    @endif
                    <td>{{$supplier->created_at->format('F d Y')}}</td>
                    <td class="text-center d-inline-flex">
                        <a class="btn btn-sm btn-primary" href="{{route('suppliers.edit', $supplier->id)}}">{{trans('dashboard.edit')}}</a>
                        <form action="{{route('suppliers.destroy',$supplier->id)}}" method="POST">
                            @if($supplier->deleted_at == null || $supplier->deleted_at == '')
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-sm btn-warning">{{trans('dashboard.delete')}}</button>
                            @endif
                        </form>
                        <form action="{{route('suppliers.restore',$supplier->id)}}" method="POST">
                            @if($supplier->deleted_at != null || $supplier->deleted_at != '')
                                @csrf
                                @method('POST')
                                <button type="submit"  class="btn btn-sm btn-success">{{trans('dashboard.restore')}}</button>
                            @endif
                        </form>
                        <form action="{{route('suppliers.force_delete',$supplier->id)}}" method="POST">
                            @if($supplier->deleted_at != null || $supplier->deleted_at != '')
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
