@extends('backend.layout')

@section('content')
    <div class="">
        <h1 class="d-flex justify-content-center">{{trans('dashboard.expense_management')}}</h1>
        <br>
        <div class="align-content-center expense_chart">
            <canvas id="ExpenseChart"></canvas>
        </div>
        <br>

        <div class="row gy-5">
            <div class=" col "><a href="{{route('expense_record_daily_report')}}" class="btn btn-primary btn-lg">{{trans('dashboard.daily_expense')}}</a></div>
            <div class=" col"><a href="{{route('expense_record_weekly_report')}}" class="btn btn-primary btn-lg">{{trans('dashboard.weekly_expense')}}</a></div>
            <div class=" col"><a href="{{route('expense_record_monthly_report')}}" class="btn btn-primary btn-lg">{{trans('dashboard.monthly_expense')}}</a></div>
            <div class=" col"><a href="{{route('expense_record_yearly_report')}}" class="btn btn-primary btn-lg">{{trans('dashboard.yearly_expense')}}</a></div>
        </div>
        <br>
        <div class="row">
            @foreach($total_expense_summary as $data)
            <div class="col-xl-6 col-md-6">
                <div class="card bg-white text-black mb-4">
                    <div class="card-body">{{trans('dashboard.total_expense_list')}}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <h2>{{$data->expense_count}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="card bg-white text-black mb-4">
                    <div class="card-body">{{trans('dashboard.total_expense_amount')}}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <h2>{{taka_format($data->total_amount) }}</h2>
                    </div>
                </div>
            </div>
            @endforeach
{{--            {{dd($test)}}--}}
{{--                @foreach($test as $data)--}}
{{--                <h1>{{Carbon\Carbon::parse($data->created_at)->format('M')}}</h1>--}}
{{--                @endforeach    --}}
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn btn-primary" href="{{route('expense_record.create')}}">{{trans('dashboard.add_new')}}</a>
                    <a class="btn btn-primary" href="{{route('expenses.index')}}">{{trans('dashboard.expense_management_add_new_expense_category')}}</a>
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
        <form method="GET" action="{{route('expense_record.index')}}">
            @csrf
            <div class="row input-daterange">
                <div class="col-md-4">
                    {{trans('dashboard.minimum_date')}}:
                    <input type="date" name="start_date" id="start_date" class="form-control" placeholder="From Date" required />
                </div>
                <div class="col-md-4">
                    {{trans('dashboard.maximum_date')}}:
                    <input type="date" name="end_date" id="end_date" class="form-control" placeholder="To Date" required />
                </div>
                <div class="col-md-4">
                    <br>
                    <button type="submit" name="filter" id="filter" class="btn btn-sm btn-primary">{{trans('dashboard.filter')}}</button>
                </div>
            </div>
        </form>
{{--        <table border="0" cellspacing="5" cellpadding="5">--}}
{{--            <tbody><tr>--}}
{{--                <td>{{trans('dashboard.minimum_date')}}:</td>--}}
{{--                <td><input type="text" id="min" name="min"></td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td>{{trans('dashboard.maximum_date')}}:</td>--}}
{{--                <td><input type="text" id="max" name="max"></td>--}}
{{--            </tr>--}}
{{--            </tbody>--}}
{{--        </table>--}}
        <br>
{{--        <table id="example" class="table table-bordered table-hover">--}}
        <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>{{trans('dashboard.expense_management_no')}}</th>
                <th>{{trans('dashboard.expense_management_bill_no')}}</th>
                <th>{{trans('dashboard.expense_management_expense_type')}}</th>
                <th>{{trans('dashboard.expense_management_expense_amount')}}</th>
                <th>{{trans('dashboard.remarks')}}</th>
                <th>{{trans('dashboard.created_by')}}</th>
                <th class="d-none">{{trans('dashboard.status')}}</th>
                <th id="created_at">{{trans('dashboard.date')}}</th>
                <th class="text-center" >{{trans('dashboard.action')}}</th>
              </tr>
            </thead>

            <tbody>
            @foreach($expense_records as $expense_record)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$expense_record->id}}</td>
                    @if($expense_record->type == 1)
                    <td>General</td>
                    @else
                        <td>Important</td>
                    @endif
                    <td>{{taka_format($expense_record->amount)}}</td>
                    <td>{{$expense_record->remarks}}</td>
                    <td>{{$expense_record->user->name??''}}</td>
                    <td class="d-none">{{$expense_record->status}}</td>
                    <td>{{$expense_record->created_at}}</td>
                    <td class="text-center d-flex d-inline">
                        <a class="btn btn-sm btn-primary" href="{{route('expense_record.edit', $expense_record->id)}}">{{trans('dashboard.edit')}}</a>
                        <form action="{{route('expense_record.destroy',$expense_record->id)}}" method="POST">
                            @if($expense_record->deleted_at == null || $expense_record->deleted_at == '')
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-sm btn-danger">{{trans('dashboard.delete')}}</button>
                            @endif
                        </form>
                        <form action="{{route('expense_record.restore',$expense_record->id)}}" method="POST">
                            @if($expense_record->deleted_at != null || $expense_record->deleted_at != '')
                                @csrf
                                @method('POST')
                                <button type="submit"  class="btn btn-sm btn-success">{{trans('dashboard.restore')}}</button>
                            @endif
                        </form>
                        <form action="{{route('expense_record.force_delete',$expense_record->id)}}" method="POST">
                            @if($expense_record->deleted_at != null || $expense_record->deleted_at != '')
                                @csrf
                                @method('DELETE')
                                <button type="submit"  class="btn btn-sm btn-warning">{{trans('dashboard.force_delete')}}</button>
                            @endif
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function getRandomColor() { //generates random colours and puts them in string
            var colors = [];
            for (var i = 0; i < 120; i++) {
                var letters = '0123456789ABCDEFGR'.split('');
                var color = '#';
                for (var x = 0; x < 6; x++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                colors.push(color);
            }
            return colors;
        }
        const data = {
            labels: <?php echo json_encode($month); ?>,
            datasets: [{
                label: 'Expense dataset',
                backgroundColor: getRandomColor(),
                // borderColor: 'rgba(23,12,12,0.66)',
                data: <?php echo json_encode($total_amount); ?>,
            }]
        };

        const config = {
            type: 'pie',
            data: data,
            options: {}
        };

        const myChart = new Chart(
            document.getElementById('ExpenseChart'),
            config
        );
    </script>


    <style>

        .expense_chart{
            height: 300px;
            width: 700px;
        }

        @media screen and (max-width: 480px ) {
            .expense_chart{
                max-width: fit-content;
            }

            [class*="col-"] {
                width: 100%;
            }

             table{

                display: block;
                max-width: -moz-fit-content;
                max-width: fit-content;
                margin: 0 auto;
                overflow-x: auto;
                white-space: nowrap;

            }

             .btn-lg{
                 font-size: 24px;
             }

        }
    </style>

@endsection
