@extends('backend.layout')

@section('content')

{{--            <div class="container-fluid px-1">--}}
{{--                <h3 class="mt-4">Messrs Nowshad Enterprise</h3>--}}
{{--                <div class="d-flex justify-content-start"><img src="{{url('images/nowshad_enterprise.jpeg')}}"  style="height: 100px; width: 250px"></div>--}}
{{--                <ol class="breadcrumb mb-5">--}}
{{--                    <li class="breadcrumb-item active">Dashboard</li>--}}
{{--                </ol>--}}
{{--            </div>--}}
            <br>
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-6" id="net_profit_dashboard">
                    <canvas id="NetProfitChartMonthWise"></canvas>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-6" id="expense_chart_dashboard">
                    <canvas id="ExpenseCategoryChart"></canvas>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-white text-black mb-4">
                        <div class="card-body" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.today_total_sale')}}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <h2>{{$today_total_sales}}</h2>
{{--                            <a class="small text-white stretched-link" href="#">View Details</a>--}}
{{--                            <div class="small text-white"><i class="fa fa-angle-right"></i></div>--}}
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card bg-white text-black mb-4">
                        <div class="card-body" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.today_total_expense')}}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <h2>{{$today_total_expense}}</h2>
{{--                            <a class="small text-white stretched-link" href="#">View Details</a>--}}
{{--                            <div class="small text-white"><i class="fa fa-angle-right"></i></div>--}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-white text-black mb-4">
                        <div class="card-body" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.today_total_supplier_due')}}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <h2>{{$today_total_supplier_due}}</h2>
{{--                            <a class="small text-black stretched-link" href="#">View Details</a>--}}
{{--                            <div class="small text-white"><i class="fa fa-angle-right"></i></div>--}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-white text-black mb-4">
                        <div class="card-body" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.today_total_customer_due')}}</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <h2>{{$today_total_customer_due}}</h2>
                            {{--                            <a class="small text-black stretched-link" href="#">View Details</a>--}}
                            {{--                            <div class="small text-white"><i class="fa fa-angle-right"></i></div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xl-3 col-md-6 text-center my-auto mb-4">
                    <a href="{{route('voucher.voucher_index')}}">
                        <div class="card card-block d-flex shadow bg-white rounded" style="height:10rem;" >
                            <div class="card-body align-items-center d-flex justify-content-center">
                                <img src="{{url('images/voucher.png')}}" style="height: 80px; width: 80px;">
                            </div>
                            <h3 class="text-uppercase" style="font-size: 24px;font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.voucher_management')}}</h3>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6 text-center my-auto mb-4">
                    <a href="{{route('purchase.index')}}">
                        <div class="card card-block d-flex shadow bg-white rounded" style="height:10rem;" >
                            <div class="card-body align-items-center d-flex justify-content-center">
                                <img src="{{url('images/purchase.png')}}" style="height: 80px; width: 80px;">
                            </div>
                            <h3 class="text-uppercase" style="font-size: 24px;font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.purchase')}}</h3>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6 text-center my-auto mb-4">
                    <a href="{{route('sales.index')}}">
                        <div class="card card-block d-flex shadow bg-white rounded" style="height:10rem;" >
                            <div class="card-body align-items-center d-flex justify-content-center">
                                <img src="{{url('images/sales.png')}}" style="height: 80px; width: 80px;">
                            </div>
                            <h3 class="text-uppercase" style="font-size: 24px;font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.sales')}}</h3>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6 text-center my-auto mb-4">
                    <a href="{{route('expense_record.index')}}">
                        <div class="card card-block d-flex shadow bg-white rounded" style="height:10rem;" >
                            <div class="card-body align-items-center d-flex justify-content-center">
                                <img src="{{url('images/expenses.png')}}" style="height: 80px; width: 80px;">
                            </div>
                            <h3 class="text-uppercase" style="font-size: 24px;font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.expense')}}</h3>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6 text-center my-auto mb-4">
                    <a href="{{route('suppliers.index')}}">
                        <div class="card card-block d-flex shadow bg-white rounded" style="height:10rem;" >
                            <div class="card-body align-items-center d-flex justify-content-center">
                                <img src="{{url('images/suppliers.png')}}" style="height: 80px; width: 80px;">
                            </div>
                            <h3 class="text-uppercase" style="font-size: 24px;font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.supplier_list')}}</h3>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6 text-center my-auto mb-4">
                    <a href="{{route('products.index')}}">
                        <div class="card card-block d-flex shadow bg-white rounded" style="height:10rem;" >
                            <div class="card-body align-items-center d-flex justify-content-center">
                                <img src="{{url('images/product_list.png')}}" style="height: 80px; width: 80px;">
                            </div>
                            <h3 class="text-uppercase" style="font-size: 24px;font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.product_list')}}</h3>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6 text-center my-auto mb-4">
                    <a href="{{route('units.index')}}">
                        <div class="card card-block d-flex shadow bg-white rounded" style="height:10rem;" >
                            <div class="card-body align-items-center d-flex justify-content-center">
                                <img src="{{url('images/units.png')}}" style="height: 80px; width: 80px;">
                            </div>
                            <h3 class="text-uppercase" style="font-size: 24px;font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.unit_list')}}</h3>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6 text-center my-auto mb-4">
                    <a href="{{route('customers.index')}}">
                        <div class="card card-block d-flex shadow bg-white rounded" style="height:10rem;" >
                            <div class="card-body align-items-center d-flex justify-content-center">
                                <img src="{{url('images/customer_list.png')}}" style="height: 80px; width: 80px;">
                            </div>
                            <h3 class="text-uppercase" style="font-size: 24px;font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.customer_list')}}</h3>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6 text-center my-auto mb-4">
                    <a href="{{route('categories.index')}}">
                        <div class="card card-block d-flex shadow bg-white rounded" style="height:10rem;" >
                            <div class="card-body align-items-center d-flex justify-content-center">
                                <img src="{{url('images/product_categories.png')}}" style="height: 80px; width: 80px;">
                            </div>
                            <h3 class="text-uppercase" style="font-size: 24px;font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.product_category')}}</h3>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6 text-center my-auto mb-4">
                    <a href="{{route('subcategories.index')}}">
                        <div class="card card-block d-flex shadow bg-white rounded" style="height:10rem;" >
                            <div class="card-body align-items-center d-flex justify-content-center">
                                <img src="{{url('images/product_sub_categories.png')}}" style="height: 80px; width: 80px;">
                            </div>
                            <h3 class="text-uppercase" style="font-size: 24px;font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.product_subcategory')}}</h3>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6 text-center my-auto mb-4">
                    <a href="{{route('users.index')}}">
                        <div class="card card-block d-flex shadow bg-white rounded" style="height:10rem;" >
                            <div class="card-body align-items-center d-flex justify-content-center">
                                <img src="{{url('images/user_permission.png')}}" style="height: 80px; width: 80px;">
                            </div>
                            <h3 class="text-uppercase" style="font-size: 24px;font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.users')}}</h3>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6 text-center my-auto mb-4">
                    <a href="{{route('roles.index')}}">
                        <div class="card card-block d-flex shadow bg-white rounded" style="height:10rem;" >
                            <div class="card-body align-items-center d-flex justify-content-center ">
                                <img src="{{url('images/admin_roles.png')}}" style="height: 80px; width: 80px;">
                            </div>
                            <h3 class="text-uppercase" style="font-size: 24px;font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.roles')}}</h3>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-md-6 text-center my-auto mb-4">
                    <a href="{{route('report_index')}}">
                        <div class="card card-block d-flex shadow bg-white rounded" style="height:10rem;" >
                            <div class="card-body align-items-center d-flex justify-content-center">
                                <img src="{{url('images/report_1.png')}}" style="height: 80px; width: 80px;">
                            </div>
                            <h3 class="text-uppercase" style="font-size: 24px;font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.reports')}}</h3>
                        </div>
                    </a>
                </div>
            </div>


{{--            <div class="row">--}}
{{--                <div class="col-xl-4 col-md-6">--}}
{{--                    <div class="card text-white mb-4" style="background-color:Tomato;" >--}}
{{--                        <div class="card-body">Total Product</div>--}}
{{--                        <div class="card-footer d-flex align-items-center justify-content-between">--}}
{{--                            <a class="small text-white stretched-link" href="#">View Details</a>--}}
{{--                            <div class="small text-white"><i class="fa fa-angle-right"></i></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xl-4 col-md-6">--}}
{{--                    <div class="card text-black mb-4" style="background-color:LightGray;" >--}}
{{--                        <div class="card-body">Total Receivable</div>--}}
{{--                        <div class="card-footer d-flex align-items-center justify-content-between">--}}
{{--                            <a class="small text-black stretched-link" href="#">View Details</a>--}}
{{--                            <div class="small text-white"><i class="fa fa-angle-right"></i></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xl-4 col-md-6">--}}
{{--                    <div class="card bg-dark text-white mb-4">--}}
{{--                        <div class="card-body">Total Supplier</div>--}}
{{--                        <div class="card-footer d-flex align-items-center justify-content-between">--}}
{{--                            <a class="small text-white stretched-link" href="#">View Details</a>--}}
{{--                            <div class="small text-white"><i class="fa fa-angle-right"></i></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

<style>
    a{
        text-decoration:none;
        color: black;
    }
</style>

<script>
    const data_1 = {
        labels: <?php echo json_encode($expense_category_name_chart); ?>,
        datasets: [{
            label: 'Expense Chart',
            backgroundColor: 'rgb(102,255,153)',
            borderColor: 'rgba(23,12,12,0.66)',
            data: <?php echo json_encode($expense_category_amount_chart); ?>,
        }]
    };

    const config_1 = {
        type: 'line',
        data: data_1,
        options: {}
    };

    const GrossProfitChartDateWise = new Chart(
        document.getElementById('ExpenseCategoryChart'),
        config_1
    );
</script>
<script>
    const data_2 = {
        labels: <?php echo json_encode($monthwise_net_profit_chart_date); ?>,
        datasets: [{
            label: 'Net Profit Monthly',
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
