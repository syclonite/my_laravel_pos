@extends('backend.layout')
@section('content')
    <div class="">
        <h1 class="d-flex justify-content-center">{{trans('dashboard.gross_profit_report')}}</h1>
        <br>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <br>
        <div class="row">
            <div class="col">
                <canvas id="GrossProfitChartMonthWise"></canvas>
            </div>
            <div class="col">
                <canvas id="GrossProfitChartDateWise"></canvas>
            </div>
        </div>
        <br>
        @foreach($total_gross_profit as $gross_profit)
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card bg-white text-black mb-4">
                    <div class="card-body text-center">{{trans('dashboard.total_sales_revenue')}}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <h2>{{taka_format($gross_profit->revenue)}}</h2>
                        {{--                            <a class="small text-white stretched-link" href="#">View Details</a>--}}
                        {{--                            <div class="small text-white"><i class="fa fa-angle-right"></i></div>--}}
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card bg-white text-black mb-4">
                    <div class="card-body text-center">{{trans('dashboard.total_cost_of_sale')}}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <h2>{{taka_format($gross_profit->cost_sale)}}</h2>
                        {{--                            <a class="small text-white stretched-link" href="#">View Details</a>--}}
                        {{--                            <div class="small text-white"><i class="fa fa-angle-right"></i></div>--}}
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-white text-black mb-4">
                    <div class="card-body text-center">{{trans('dashboard.gross_profit')}}</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <h2>{{taka_format($gross_profit->revenue - $gross_profit->cost_sale)}}</h2>
                        {{--                            <a class="small text-black stretched-link" href="#">View Details</a>--}}
                        {{--                            <div class="small text-white"><i class="fa fa-angle-right"></i></div>--}}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="row gy-5">
            <div class="col"><a href="{{route('gross_profit_daily')}}" class="btn btn-primary btn-lg">{{trans('dashboard.daily_gross_profit')}}</a></div>
            <div class="col"><a href="{{route('gross_profit_weekly')}}" class="btn btn-primary btn-lg">{{trans('dashboard.weekly_gross_profit')}}</a></div>
            <div class="col"><a href="{{route('gross_profit_monthly')}}" class="btn btn-primary btn-lg">{{trans('dashboard.monthly_gross_profit')}}</a></div>
            <div class="col"><a href="{{route('gross_profit_yearly')}}" class="btn btn-primary btn-lg">{{trans('dashboard.yearly_gross_profit')}}</a></div>
        </div>
        <br>
        <form method="GET" action="{{route('gross_profit_index')}}">
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
        <br>
{{--        <table class="table table-bordered table-sm table-hover" id="example">--}}
        <table class="table table-bordered table-sm table-hover">
            <thead>
            <tr>
                <th>{{trans('dashboard.serial')}}</th>
                <th>{{trans('dashboard.sales_revenue')}}</th>
                <th>{{trans('dashboard.cost_of_sale')}}</th>
                <th>{{trans('dashboard.gross_profit')}}</th>
                <th>{{trans('dashboard.date')}}</th>
                <th class="d-none"></th>
            </tr>
            </thead>

            <tbody>
{{--            @dd($gross_table_data)--}}
            @foreach($gross_table_data as $key => $data)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$data->revenue}}</td>
                    <td>{{$data->cost_sale}}</td>
                    <td>{{$data->revenue - $data->cost_sale}}</td>
{{--                    @if($data->revenue >= $data->cost_sale)--}}
{{--                    <td>{{$data->revenue - $data->cost_sale}}</td>--}}
{{--                    @elseif($data->revenue < $data->cost_sale)--}}
{{--                      <td>0</td>--}}
{{--                    @endif--}}
                    <td>{{$data->date}}</td>
                    <td class="d-none"></td>
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
            .btn-lg{
                font-size: 24px;
            }
        }

    </style>
    <script>
        const data_1 = {
            labels: <?php echo json_encode($datewise_chart_dates); ?>,
            datasets: [{
                label: 'GROSS PROFIT Daily',
                backgroundColor: 'rgb(102,255,153)',
                borderColor: 'rgba(23,12,12,0.66)',
                data: <?php echo json_encode($datewise_chart_value); ?>,
            }]
        };

        const config_1 = {
            type: 'line',
            data: data_1,
            options: {}
        };

        const GrossProfitChartDateWise = new Chart(
            document.getElementById('GrossProfitChartDateWise'),
            config_1
        );
    </script>
    <script>
        const data_2 = {
            labels: <?php echo json_encode($monthwise_chart_dates); ?>,
            datasets: [{
            label: 'GROSS PROFIT Monthly',
            backgroundColor: 'rgb(102,255,153)',
            borderColor: 'rgba(23,12,12,0.66)',
            data: <?php echo json_encode($monthwise_chart_value); ?>
        }]
        };

        const config = {
            type: 'bar',
            data: data_2,
            options: {}
        };

        const GrossProfitChartMonthWise = new Chart(
            document.getElementById('GrossProfitChartMonthWise'),
            config
        );
    </script>

@endsection
