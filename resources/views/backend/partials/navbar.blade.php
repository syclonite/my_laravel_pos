<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-light-green">
    <div class="container-fluid">
        <a class="navbar-brand px-3 text-uppercase" href="{{route('dashboard')}}" style="font-weight: bold">Nowshad Enterprise</a>
{{--        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"--}}
{{--                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--        </button>--}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="container collapse navbar-collapse" id="navbarSupportedContent" >
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 mb-sm-0" id="language_section">
                <li class="nav-item mt-1">
                    <a class="nav-link active" aria-current="page" href="{{route('dashboard')}}">{{trans('dashboard.navbar_home')}}</a>
                </li>
                <li class="nav-item mt-1">
                    @if(Auth::user()->role->role_name == "admin")
                        <a class="nav-link active">Admin</a>
                    @else
                        <a class="nav-link active">Sales</a>
                    @endif
                </li>
                <li class="nav-item mt-1">
                    <div style="width:70px;">
                        <a type="button" class="btn btn-outline-secondary btn-sm nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-bell"><sup>{{$countStock ?? ''}}</sup></i></a>
                    </div>
                </li>
                <li class="nav-item mt-1">
                    <select class="form-control changeLang" style="width:120px;">
                        <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                        <option value="bn" {{ session()->get('locale') == 'bn' ? 'selected' : '' }}>Bangla</option>
                    </select>
                </li>
                <li class="nav-item mt-1">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-md">Logout</button>
                    </form>
                </li>
            </ul>
            <div class="navbar-nav" id="menu_section">
                <ul class="navbar-nav navbar-nav">
                    <li class="nav-item mt-1">
                        <a href="{{route('users.index')}}" class="nav-link text-white">
                            <i class="fa fa-user"></i> <span class="d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.user_management')}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('customers.index')}}" class="nav-link text-white">
                            <i class="fa fa-group"></i> <span class="d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.customer_management')}}</span></a>
                    </li>
                    <li>
                        <a href="{{route('roles.index')}}" class="nav-link text-white">
                            <i class="fa fa-universal-access"></i> <span class="d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.role_management')}}</span></a>
                    </li>
                    <li>
                        <a href="{{route('categories.index')}}" class="nav-link text-white">
                            <i class="fa fa-align-justify"></i> <span class="d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.category_management')}}</span></a>
                    </li>
                    <li>
                        <a href="{{route('subcategories.index')}}" class="nav-link text-white">
                            <i class="fa fa-align-justify"></i> <span class="d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.subcategory_management')}}</span></a>
                    </li>
                    <li>
                        <a href="{{route('products.index')}}" class="nav-link text-white">
                            <i class="fa fa-cubes"></i> <span class="d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.product_management')}}</span></a>
                    </li>
                    <li>
                        <a href="{{route('suppliers.index')}}" class="nav-link text-white">
                            <i class="fa fa-group"></i> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.supplier_management')}}</span></a>
                    </li>
                    <li>
                        <a href="{{route('units.index')}}" class="nav-link text-white">
                            <i class="fa fa-cube"></i> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.unit_management')}}</span></a>
                    </li>
                    <li>
                        <a href="{{route('purchase.index')}}" class="nav-link text-white">
                            <i class="fa fa-tasks"></i> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.purchase_management')}}</span></a>
                    </li>
                    <li>
                        <a href="{{route('sales.index')}}" class="nav-link text-white">
                            <i class="fa fa-server"></i> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.sale_management')}}</span></a>
                    </li>
                    <li>
                        <a href="{{route('voucher.voucher_index')}}" class="nav-link text-white">
                            <i class="fa fa-archive"></i> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.voucher_management')}}</span></a>
                    </li>
                    <li>
                        <a href="#expense" class="nav-link text-white" data-bs-toggle="collapse">
                            <span class="d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.expense_management')}}</span> <i class="fa fa-angle-down"></i> </a>
                        <ul class="collapse nav flex-column " id="expense" data-bs-parent="#menu">
                            <li class="w-100 text-dark">
                                <a href="{{route('expenses.index')}}" class="nav-link text-white"> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.expense_management_expense_categories')}}</span></a>
                            </li>
                            <li class="text-dark">
                                <a href="{{route('expense_record.index')}}" class="nav-link text-white"> <span class="d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.expense_management_expense_record')}}</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#submenu3" class="nav-link text-white" data-bs-toggle="collapse">
                            <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.reports')}}</span> <i class="fa fa-angle-down"></i>  </a>
                        <ul class="collapse nav flex-column " id="submenu3" data-bs-parent="#menu">
                            <li class="w-100 text-white">
                                <a href="{{route('stock_report_index')}}" class="nav-link text-white"> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.stock_report')}}</span> </a>
                            </li>
                            <li class="w-100 text-white">
                                <a href="{{route('all_product_stock_reports')}}" class="nav-link text-white"> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.all_stock_report')}}</span> </a>
                            </li>
                            <li class="text-white">
                                <a href="{{route('sales_voucher_report_index')}}" class="nav-link text-white"> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.sales_report')}}</span> </a>
                            </li>
                            <li class="text-white">
                                <a href="{{route('suppliers.due_supplier_list_index')}}" class="nav-link text-white"> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.supplier_report')}}</span> </a>
                            </li>
                            <li class="text-white">
                                <a href="{{route('customers.customer_payment_index')}}" class="nav-link text-white"> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.customer_report')}}</span> </a>
                            </li>
                            <li class="text-white">
                                <a href="{{route('gross_profit_index')}}" class="nav-link  text-white"> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.gross_profit_report')}}</span> </a>
                            </li>
                            <li class="text-white">
                                <a href="{{route('net_profit_index')}}" class="nav-link  text-white"> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.net_profit_report')}}</span> </a>
                            </li>
                            <li class="text-white">
                                <a href="{{route('expense_record.index')}}" class="nav-link  text-white"> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.expense_report')}}</span> </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

{{--<div class=" navbar-nav" id="menu_section">--}}
{{--                <ul class="navbar-nav ">--}}
{{--                    <br>--}}
{{--                    <br>--}}
{{--                    <li class="nav-item mt-1">--}}
{{--                        <a class="nav-link text-white" aria-current="page" href="{{route('dashboard')}}">{{trans('dashboard.navbar_home')}}</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item mt-1">--}}
{{--                        @if(Auth::user()->role->role_name == "admin")--}}
{{--                            <a class="nav-link text-white">Admin</a>--}}
{{--                        @else--}}
{{--                            <a class="nav-link text-white">Sales</a>--}}
{{--                        @endif--}}
{{--                    </li>--}}
{{--                    <li class="nav-item mt-1">--}}
{{--                        <div style="width:70px;">--}}
{{--                            <a type="button" class="btn btn-outline-secondary btn-sm nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-bell text-white"><sup>{{$countStock ?? ''}}</sup></i></a>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item mt-1">--}}
{{--                        <select class="form-control changeLang" style="width:120px;">--}}
{{--                            <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>--}}
{{--                            <option value="bn" {{ session()->get('locale') == 'bn' ? 'selected' : '' }}>Bangla</option>--}}
{{--                        </select>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item mt-1">--}}
{{--                        <form action="{{ route('logout') }}" method="post">--}}
{{--                            @csrf--}}
{{--                            <button type="submit" class="btn btn-outline-danger btn-md">Logout</button>--}}
{{--                        </form>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item mt-1">--}}
{{--                        <a href="{{route('users.index')}}" class="nav-link text-white">--}}
{{--                            <i class="fa fa-user"></i> <span class="d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.user_management')}}</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{route('customers.index')}}" class="nav-link text-white">--}}
{{--                            <i class="fa fa-group"></i> <span class="d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.customer_management')}}</span></a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{route('roles.index')}}" class="nav-link text-white">--}}
{{--                            <i class="fa fa-universal-access"></i> <span class="d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.role_management')}}</span></a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{route('categories.index')}}" class="nav-link text-white">--}}
{{--                            <i class="fa fa-align-justify"></i> <span class="d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.category_management')}}</span></a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{route('subcategories.index')}}" class="nav-link text-white">--}}
{{--                            <i class="fa fa-align-justify"></i> <span class="d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.subcategory_management')}}</span></a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{route('products.index')}}" class="nav-link text-white">--}}
{{--                            <i class="fa fa-cubes"></i> <span class="d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.product_management')}}</span></a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{route('suppliers.index')}}" class="nav-link text-white">--}}
{{--                            <i class="fa fa-group"></i> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.supplier_management')}}</span></a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{route('units.index')}}" class="nav-link text-white">--}}
{{--                            <i class="fa fa-cube"></i> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.unit_management')}}</span></a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{route('purchase.index')}}" class="nav-link text-white">--}}
{{--                            <i class="fa fa-tasks"></i> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.purchase_management')}}</span></a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{route('sales.index')}}" class="nav-link text-white">--}}
{{--                            <i class="fa fa-server"></i> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.sale_management')}}</span></a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{route('voucher.voucher_index')}}" class="nav-link text-white">--}}
{{--                            <i class="fa fa-archive"></i> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.voucher_management')}}</span></a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="#expense" class="nav-link text-white" data-bs-toggle="collapse">--}}
{{--                            <span class="d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.expense_management')}}</span> <i class="fa fa-angle-down"></i> </a>--}}
{{--                        <ul class="collapse nav flex-column " id="expense" data-bs-parent="#menu">--}}
{{--                            <li class="w-100 text-dark">--}}
{{--                                <a href="{{route('expenses.index')}}" class="nav-link text-white"> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.expense_management_expense_categories')}}</span></a>--}}
{{--                            </li>--}}
{{--                            <li class="text-dark">--}}
{{--                                <a href="{{route('expense_record.index')}}" class="nav-link text-white"> <span class="d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.expense_management_expense_record')}}</span></a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="#submenu3" class="nav-link text-white" data-bs-toggle="collapse">--}}
{{--                            <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.reports')}}</span> <i class="fa fa-angle-down"></i>  </a>--}}
{{--                        <ul class="collapse nav flex-column " id="submenu3" data-bs-parent="#menu">--}}
{{--                            <li class="w-100 text-white">--}}
{{--                                <a href="{{route('stock_report_index')}}" class="nav-link text-white"> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.stock_report')}}</span> </a>--}}
{{--                            </li>--}}
{{--                            <li class="w-100 text-white">--}}
{{--                                <a href="{{route('all_product_stock_reports')}}" class="nav-link text-white"> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.all_stock_report')}}</span> </a>--}}
{{--                            </li>--}}
{{--                            <li class="text-white">--}}
{{--                                <a href="{{route('sales_voucher_report_index')}}" class="nav-link text-white"> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.sales_report')}}</span> </a>--}}
{{--                            </li>--}}
{{--                            <li class="text-white">--}}
{{--                                <a href="{{route('suppliers.due_supplier_list_index')}}" class="nav-link text-white"> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.supplier_report')}}</span> </a>--}}
{{--                            </li>--}}
{{--                            <li class="text-white">--}}
{{--                                <a href="{{route('customers.customer_payment_index')}}" class="nav-link text-white"> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.customer_report')}}</span> </a>--}}
{{--                            </li>--}}
{{--                            <li class="text-white">--}}
{{--                                <a href="{{route('gross_profit_index')}}" class="nav-link  text-white"> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.gross_profit_report')}}</span> </a>--}}
{{--                            </li>--}}
{{--                            <li class="text-white">--}}
{{--                                <a href="{{route('net_profit_index')}}" class="nav-link  text-white"> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.net_profit_report')}}</span> </a>--}}
{{--                            </li>--}}
{{--                            <li class="text-white">--}}
{{--                                <a href="{{route('expense_record.index')}}" class="nav-link  text-white"> <span class=" d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.expense_report')}}</span> </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Low Stock Counts</h1>
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
{{--                    <p>This Section will be updated after fixing some minor bugs</p>--}}
                    @foreach($stock_result as $data)
                        <tr>
                            <td>{{$data->product->product_name ?? ' '}}</td>
                            <td>{{$data->unit->unit_name ?? ' '}}</td>
                            <td>{{$data->total_quantity ?? ' '}}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    var url = "{{ route('changeLang') }}";

    $(".changeLang").change(function(){
        window.location.href = url + "?lang="+ $(this).val();
    });

</script>
