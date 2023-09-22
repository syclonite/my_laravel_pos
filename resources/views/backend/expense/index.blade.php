@extends('backend.layout')

@section('content')
    <div class="">
        <h1 class="d-flex justify-content-center">{{trans('dashboard.expense_category_management')}}</h1>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn btn-success" href="{{route('expenses.create')}}">{{trans('dashboard.add_new')}}</a>
                    <a class="btn btn-primary" href="{{route('expense_record.index')}}"> {{trans('dashboard.back')}}</a>
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
              <th>{{trans('dashboard.expense_management_no')}}</th>
              <th>{{trans('dashboard.expense_management_expense_categories')}}</th>
              <th>{{trans('dashboard.remarks')}}</th>
              <th>{{trans('dashboard.status')}}</th>
              <th id="created_at">{{trans('dashboard.date')}}</th>
              <th class="text-center" >{{trans('dashboard.action')}}</th>
          </tr>
          </thead>
            <tbody>
            @foreach($expenses as $expense)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$expense->expense_category_name}}</td>
                    <td>{{$expense->remarks}}</td>
                    @if($expense->status == '1')
                        <td>{{"Enable"}}</td>
                    @else
                        <td>{{"Disabled"}}</td>
                    @endif

                    <td>{{$expense->created_at->format('F d Y')}}</td>
                    <td class="text-center d-flex d-inline">
                        <a class="btn btn-sm btn-primary" href="{{route('expenses.edit', $expense->id)}}">{{trans('dashboard.edit')}}</a>
                        <form action="{{route('expenses.destroy',$expense->id)}}" method="POST">
                            @if($expense->deleted_at == null || $expense->deleted_at == '')
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-sm btn-warning">{{trans('dashboard.delete')}}</button>
                            @endif
                        </form>
                        <form action="{{route('expenses.restore',$expense->id)}}" method="POST">
                            @if($expense->deleted_at != null || $expense->deleted_at != '')
                                @csrf
                                @method('POST')
                                <button type="submit"  class="btn btn-sm btn-success">{{trans('dashboard.restore')}}</button>
                            @endif
                        </form>
                        <form action="{{route('expenses.force_delete',$expense->id)}}" method="POST">
                            @if($expense->deleted_at != null || $expense->deleted_at != '')
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

            h1{
                font-size: 26px;
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
