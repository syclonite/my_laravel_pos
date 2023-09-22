@extends('backend.layout')
@section('content')
    <div class="">
        <h1 class="d-flex justify-content-center">{{trans('dashboard.net_profit')}}</h1>
        <br>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <br>
        <div class="row">
            <div class="col">
                <canvas id="NetProfitChartMonthWise"></canvas>
            </div>
            <div class="col">
                <canvas id="NetProfitChartDateWise"></canvas>
            </div>
        </div>
        <br>
        @foreach($total_net_profit as $net_profit)
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-white text-black mb-4">
                        <div class="card-body text-center">{{trans('dashboard.total_sales_revenue')}}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <h2>{{taka_format($net_profit->revenue,2)}}</h2>
                            {{--                            <a class="small text-white stretched-link" href="#">View Details</a>--}}
                            {{--                            <div class="small text-white"><i class="fa fa-angle-right"></i></div>--}}
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="card bg-white text-black mb-4">
                        <div class="card-body text-center">{{trans('dashboard.cost_of_sale')}}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <h2>{{taka_format($net_profit->cost_sale)}}</h2>
                            {{--                            <a class="small text-white stretched-link" href="#">View Details</a>--}}
                            {{--                            <div class="small text-white"><i class="fa fa-angle-right"></i></div>--}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-white text-black mb-4">
                        <div class="card-body text-center">{{trans('dashboard.gross_profit')}}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <h2>{{taka_format($net_profit->revenue - $net_profit->cost_sale)}}</h2>
                            {{--                            <a class="small text-black stretched-link" href="#">View Details</a>--}}
                            {{--                            <div class="small text-white"><i class="fa fa-angle-right"></i></div>--}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-white text-black mb-4">
                        <div class="card-body text-center">{{trans('dashboard.expense')}}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <h2>{{taka_format($net_profit->expense)}}</h2>
                            {{--                            <a class="small text-black stretched-link" href="#">View Details</a>--}}
                            {{--                            <div class="small text-white"><i class="fa fa-angle-right"></i></div>--}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-white text-black mb-4">
                        <div class="card-body text-center">{{trans('dashboard.net_profit')}}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <h2>{{(taka_format(($net_profit->revenue - $net_profit->cost_sale) - $net_profit->expense))}}</h2>
                            {{--                            <a class="small text-black stretched-link" href="#">View Details</a>--}}
                            {{--                            <div class="small text-white"><i class="fa fa-angle-right"></i></div>--}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="row gy-5">
            <div class="col" ><a href="{{route('net_profit_daily')}}" class="btn btn-primary btn-lg">{{trans('dashboard.daily_net_profit')}}</a></div>
            <div class="col" ><a href="{{route('net_profit_weekly')}}" class="btn btn-primary btn-lg">{{trans('dashboard.weekly_net_profit')}}</a></div>
            <div class="col" ><a href="{{route('net_profit_monthly')}}" class="btn btn-primary btn-lg">{{trans('dashboard.monthly_net_profit')}}</a></div>
            <div class="col"><a href="{{route('net_profit_yearly')}}" class="btn btn-primary btn-lg">{{trans('dashboard.yearly_net_profit')}}</a></div>
        </div>
        <br>
        <form method="GET" action="{{route('net_profit_index')}}">
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
                    <button type="submit" name="filter" id="filter" class="btn btn-primary">{{trans('dashboard.filter')}}</button>
                </div>
            </div>
        </form>
        <br>
        <table class="table table-bordered" id="example">
            <thead>
            <tr>
                <th>{{trans('dashboard.sales_revenue')}}</th>
                <th>{{trans('dashboard.cost_of_sale')}}</th>
                <th>{{trans('dashboard.gross_profit')}}</th>
                <th>{{trans('dashboard.expense')}} </th>
                <th>{{trans('dashboard.net_profit')}}</th>
                <th>{{trans('dashboard.date')}}</th>
            </tr>
            </thead>

            <tbody>

            @foreach($net_table_data as $data)
                <tr>
                    <td>{{$data->revenue}}</td>
                    <td>{{$data->cost_sale}}</td>
                    <td>{{$data->revenue - $data->cost_sale}}</td>
{{--                @if($data->revenue >= $data->cost_sale)--}}
{{--                    @elseif($data->revenue < $data->cost_sale)--}}
{{--                        <td>0</td>--}}
{{--                    @endif--}}
                    <td>{{$data->expense}}</td>
                    <td>{{($data->revenue - $data->cost_sale) - $data->expense}}</td>
                    <td>{{$data->date}}</td>
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
            labels: <?php echo json_encode($datewise_net_profit_chart_date); ?>,
            datasets: [{
                label: 'Net Profit Datewise',
                backgroundColor: 'rgb(102,255,153)',
                borderColor: 'rgba(23,12,12,0.66)',
                data: <?php echo json_encode($datewise_net_profit_chart_value); ?>,
            }]
        };

        const config_1 = {
            type: 'line',
            data: data_1,
            options: {}
        };

        const GrossProfitChartDateWise = new Chart(
            document.getElementById('NetProfitChartDateWise'),
            config_1
        );
    </script>
    <script>
        const data_2 = {
            labels: <?php echo json_encode($monthwise_net_profit_chart_date); ?>,
            datasets: [{
                label: 'GROSS PROFIT Monthwise',
                backgroundColor: 'rgb(102,255,153)',
                borderColor: 'rgba(23,12,12,0.66)',
                data: <?php echo json_encode($monthwise_net_profit_chart_value); ?>
            }]
        };

        const config = {
            type: 'line',
            data: data_2,
            options: {}
        };

        const GrossProfitChartMonthWise = new Chart(
            document.getElementById('NetProfitChartMonthWise'),
            config
        );
    </script>
@endsection
