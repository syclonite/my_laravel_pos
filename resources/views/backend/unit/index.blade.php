@extends('backend.layout')

@section('content')
    <div class="">
        <h1 class="d-flex justify-content-center">{{trans('dashboard.unit_management')}} </h1>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn btn-success" href="{{route('units.create')}}">{{trans('dashboard.add_new')}}</a>
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
        <table class="table table-bordered table-hover" id="example" >
            <thead>
            <tr>
                <th>{{trans('dashboard.unit_management_no')}}</th>
                <th>{{trans('dashboard.unit_management_unit_name')}}</th>
                <th>{{trans('dashboard.unit_management_unit_description')}}</th>
                <th>{{trans('dashboard.status')}}</th>
                <th id="created_at">{{trans('dashboard.date')}}</th>
                <th class="text-center" >{{trans('dashboard.action')}}</th>
            </tr>
            </thead>

            <tbody>
            @foreach($units as $unit)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$unit->unit_name}}</td>
                    <td>{{$unit->unit_description}}</td>
                    @if($unit->status == '1')
                        <td>{{"Enable"}}</td>
                    @else
                        <td>{{"Disabled"}}</td>
                    @endif
                    <td>{{$unit->created_at->format('F d Y')}}</td>
                    <td class="text-center d-inline-flex">
                        <a class="btn btn-sm btn-primary" href="{{route('units.edit', $unit->id)}}">{{trans('dashboard.edit')}}</a>
                        <form action="{{route('units.destroy',$unit->id)}}" method="POST">
                            @if($unit->deleted_at == null || $unit->deleted_at == '')
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-sm btn-warning">{{trans('dashboard.delete')}}</button>
                            @endif
                        </form>
                        <form action="{{route('units.restore',$unit->id)}}" method="POST">
                            @if($unit->deleted_at != null || $unit->deleted_at != '')
                                @csrf
                                @method('POST')
                                <button type="submit"  class="btn btn-sm btn-success">{{trans('dashboard.restore')}}</button>
                            @endif
                        </form>
                        <form action="{{route('units.force_delete',$unit->id)}}" method="POST">
                            @if($unit->deleted_at != null || $unit->deleted_at != '')
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
