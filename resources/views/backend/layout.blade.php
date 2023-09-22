<!DOCTYPE html>
<html>

@include('backend.partials.all_links')
<body>
@include('backend.partials.navbar')
<div class="container-fluid mt-5">
    <div class="row flex-nowrap" id="sidebar_dev">
        <div class=" col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light shadow-lg bg-light-blue" id="sidebar"> <!-- Sidebar -->
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
               @if(Auth::user()->role->role_name == "admin")
                    <a href="{{route('dashboard')}}" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <i class="fa fa-dashboard"></i><span class="fs-5 ms-1 d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.dashboard')}}</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        {{--                    <li class="nav-item">--}}
                        {{--                        <a href="#" class="nav-link align-middle px-0 text-dark">--}}
                        {{--                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>--}}
                        {{--                        </a>--}}
                        {{--                    </li>--}}
                        <li>
                            <a href="{{route('users.index')}}" class="nav-link px-0 align-middle text-white">
                                <i class="fa fa-user"></i> <span class="ms-1 d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.user_management')}}</span></a>
                        </li>
                        <li>
                            <a href="{{route('customers.index')}}" class="nav-link px-0 align-middle text-white">
                                <i class="fa fa-group"></i> <span class="ms-1 d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.customer_management')}}</span></a>
                        </li>
                        <li>
                            <a href="{{route('roles.index')}}" class="nav-link px-0 align-middle text-white">
                                <i class="fa fa-universal-access"></i> <span class="ms-1 d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.role_management')}}</span></a>
                        </li>
                        <li>
                            <a href="{{route('categories.index')}}" class="nav-link px-0 align-middle text-white">
                                <i class="fa fa-align-justify"></i> <span class="ms-1 d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.category_management')}}</span></a>
                        </li>
                        <li>
                            <a href="{{route('subcategories.index')}}" class="nav-link px-0 align-middle text-white">
                                <i class="fa fa-align-justify"></i> <span class="ms-1 d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.subcategory_management')}}</span></a>
                        </li>
                        <li>
                            <a href="{{route('products.index')}}" class="nav-link px-0 align-middle text-white">
                                <i class="fa fa-cubes"></i> <span class="ms-1 d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.product_management')}}</span></a>
                        </li>
                        <li>
                            <a href="{{route('suppliers.index')}}" class="nav-link px-0 align-middle text-white">
                                <i class="fa fa-group"></i> <span class="ms-1 d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.supplier_management')}}</span></a>
                        </li>
                        <li>
                            <a href="{{route('units.index')}}" class="nav-link px-0 align-middle text-white">
                                <i class="fa fa-cube"></i> <span class="ms-1 d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.unit_management')}}</span></a>
                        </li>
                        <li>
                            <a href="{{route('purchase.index')}}" class="nav-link px-0 align-middle text-white">
                                <i class="fa fa-tasks"></i> <span class="ms-1 d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.purchase_management')}}</span></a>
                        </li>
                        <li>
                            <a href="{{route('sales.index')}}" class="nav-link px-0 align-middle text-white">
                                <i class="fa fa-server"></i> <span class="ms-1 d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.sale_management')}}</span></a>
                        </li>
                        <li>
                            <a href="{{route('voucher.voucher_index')}}" class="nav-link px-0 align-middle text-white">
                                <i class="fa fa-archive"></i> <span class="ms-1 d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.voucher_management')}}</span></a>
                        </li>

                        <li>
                            <a href="#expense" class="nav-link px-0 align-middle text-white" data-bs-toggle="collapse">
                                <span class="ms-1 d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.expense_management')}}</span> <i class="fa fa-angle-down"></i> </a>
                            <ul class="collapse nav flex-column ms-1" id="expense" data-bs-parent="#menu">
                                <li class="w-100 text-dark">
                                    <a href="{{route('expenses.index')}}" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.expense_management_expense_categories')}}</span></a>
                                </li>
                                <li class="text-dark">
                                    <a href="{{route('expense_record.index')}}" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.expense_management_expense_record')}}</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#submenu3" class="nav-link px-0 align-middle text-white" data-bs-toggle="collapse">
                                <span class="ms-1 d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.reports')}}</span> <i class="fa fa-angle-down"></i>  </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                <li class="w-100 text-white">
                                    <a href="{{route('stock_report_index')}}" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.stock_report')}}</span> </a>
                                </li>
                                <li class="w-100 text-white">
                                    <a href="{{route('all_product_stock_reports')}}" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.all_stock_report')}}</span> </a>
                                </li>
                                <li class="text-white">
                                    <a href="{{route('sales_voucher_report_index')}}" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.sales_report')}}</span> </a>
                                </li>
                                <li class="text-white">
                                    <a href="{{route('suppliers.due_supplier_list_index')}}" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.supplier_report')}}</span> </a>
                                </li>
                                <li class="text-white">
                                    <a href="{{route('customers.customer_payment_index')}}" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.customer_report')}}</span> </a>
                                </li>
                                <li class="text-white">
                                    <a href="{{route('gross_profit_index')}}" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.gross_profit_report')}}</span> </a>
                                </li>
                                <li class="text-white">
                                    <a href="{{route('net_profit_index')}}" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.net_profit_report')}}</span> </a>
                                </li>
                                <li class="text-white">
                                    <a href="{{route('expense_record.index')}}" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.expense_report')}}</span> </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @elseif(Auth::user()->role->role_name == "employee")
                    <a href="{{route('dashboard')}}" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <i class="fa fa-dashboard"></i><span class="fs-5 ms-1 d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.dashboard')}}</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">

                        <li>
                            <a href="{{route('customers.index')}}" class="nav-link px-0 align-middle text-white">
                                <i class="fa fa-group"></i> <span class="ms-1 d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.customer_management')}}</span></a>
                        </li>
                        <li>
                            <a href="{{route('purchase.index')}}" class="nav-link px-0 align-middle text-white">
                                <i class="fa fa-tasks"></i> <span class="ms-1 d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.purchase_management')}}</span></a>
                        </li>

                        <li>
                            <a href="{{route('suppliers.index')}}" class="nav-link px-0 align-middle text-white">
                                <i class="fa fa-group"></i> <span class="ms-1 d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.supplier_management')}}</span></a>
                        </li>
                        <li>
                            <a href="{{route('units.index')}}" class="nav-link px-0 align-middle text-white">
                                <i class="fa fa-cube"></i> <span class="ms-1 d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.unit_management')}}</span></a>
                        </li>

                        <li>
                            <a href="{{route('sales.index')}}" class="nav-link px-0 align-middle text-white">
                                <i class="fa fa-server"></i> <span class="ms-1 d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.sale_management')}}</span></a>
                        </li>
                        <li>
                            <a href="{{route('voucher.voucher_index')}}" class="nav-link px-0 align-middle text-white">
                                <i class="fa fa-archive"></i> <span class="ms-1 d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.voucher_management')}}</span></a>
                        </li>
                        <li>
                            <a href="#expense" class="nav-link px-0 align-middle text-white" data-bs-toggle="collapse">
                                <span class="ms-1 d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.expense_management')}}</span> <i class="fa fa-angle-down"></i> </a>
                            <ul class="collapse nav flex-column ms-1" id="expense" data-bs-parent="#menu">
                                <li class="w-100 text-dark">
                                    <a href="{{route('expenses.index')}}" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.expense_management_expense_categories')}}</span></a>
                                </li>
                                <li class="text-dark">
                                    <a href="{{route('expense_record.index')}}" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.expense_management_expense_record')}}</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#submenu3" class="nav-link px-0 align-middle text-white" data-bs-toggle="collapse">
                                <span class="ms-1 d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.reports')}}</span> <i class="fa fa-angle-down"></i>  </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                <li class="text-white">
                                    <a href="{{route('sales_voucher_report_index')}}" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.sales_report')}}</span> </a>
                                </li>
                                <li class="text-white">
                                    <a href="{{route('customers.customer_payment_index')}}" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline" style="font-family: 'Kalpurush', sans-serif;">{{trans('dashboard.customer_report')}}</span> </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @endif
                <br>
            </div>
        </div>
        <div class="col py-2 px-3">
            <div>
                <h3 class="notice"></h3>
                <h3 class="alert"></h3>
            </div>
            <main>
                @yield('content')
            </main>
            <br>
            <br>
            @include('backend.partials.footer')
        </div>
    </div>
</div>
</body>

</html>

<style>


    html * {
        font-family: 'Kalpurush', sans-serif;
    }

    .footer {
        /*height: 40px;*/
        margin-top: 100px;
        /*bottom: 6px;*/
    }
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    #menu_section{
        display: none;
    }

    @media screen and (max-width: 767px ) {
        .footer {
            /*height: 40px;*/
            margin-top: 100px;
            /*bottom: 6px;*/
        }

        .navbar-collapse {
            position: fixed;
            top: 54px;
            left: 0;
            padding-left: 15px;
            padding-right: 15px;
            padding-bottom: 15px;
            width: 40%;
            background: #6ab187;
            max-width: 320px;
            height: 100vh;
            overflow-y: auto;
        }

        .navbar-collapse.collapsing {
            height: 100%;
            -webkit-transition: left 0.1s ease;
            -o-transition: left 0.1s ease;
            -moz-transition: left 0.1s ease;
            transition: left 0.3s ease;
            left: -100%;
        }

        .navbar-collapse.show {
            left: 0;
            -webkit-transition: left 0.3s ease-in;
            -o-transition: left 0.3s ease-in;
            -moz-transition: left 0.3s ease-in;
            transition: left 0.3s ease-in;
        }

    }

       @media screen and (max-width: 480px ) {
        #sidebar {
            display: none;
        }
           .footer {
               /*height: 40px;*/
               margin-top: 100px;
               /*bottom: 6px;*/
           }
        #menu_section {
            display: flex;
            font-size: 13px;
        }

        .navbar-collapse {
            position: fixed;
            top: 54px;
            left: 0;
            padding-left: 15px;
            padding-right: 15px;
            padding-bottom: 15px;
            width: 58%;
            background: #6ab187;
            max-width: 320px;
            height: 100vh;
            overflow-y: auto;
        }

        .navbar-collapse.collapsing {
            height: 100%;
            -webkit-transition: left 0.1s ease;
            -o-transition: left 0.1s ease;
            -moz-transition: left 0.1s ease;
            transition: left 0.3s ease;
            left: -100%;
        }

        .navbar-collapse.show {
            left: 0;
            -webkit-transition: left 0.3s ease-in;
            -o-transition: left 0.3s ease-in;
            -moz-transition: left 0.3s ease-in;
            transition: left 0.3s ease-in;
        }

    }

</style>

<script>

    pdfMake.fonts = {
        Roboto: {
            normal: 'Roboto-Regular.ttf',
            bold: 'Roboto-Medium.ttf',
            italics: 'Roboto-Italic.ttf',
            bolditalics: 'Roboto-MediumItalic.ttf'
        },
        nikosh: {
            normal: "NikoshBan.ttf",
            bold: "NikoshBan.ttf",
            italics: "NikoshBan.ttf",
            bolditalics: "NikoshBan.ttf"
        }
    };

    var minDate, maxDate;
    // Custom filtering function which will search data in column four between two values
     $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            var min = minDate.val();
            var max = maxDate.val();
            // console.log($('#created_at').siblings().length - 1);
            var count_header = $('#created_at').siblings().length - 1;
            var date = new Date( data[count_header]);

            if (
                ( min === null && max === null ) ||
                ( min === null && date <= max ) ||
                ( min <= date   && max === null ) ||
                ( min <= date   && date <= max )
            ) {
                return true;
            }
            return false;
        }

    );

    // $.fn.modal.Constructor.prototype.enforceFocus = function () {};

    $(document).ready(function() {
        $( 'select').select2( {
            theme: 'bootstrap-5'
        });

        // Create date inputs
        minDate = new DateTime($('#min'), {
            format: 'MMMM DD YYYY'
        });
        maxDate = new DateTime($('#max'), {
            format: 'MMMM DD YYYY'
        });

        // DataTables initialisation
        /*    var table = $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'print'
                ],
                ordering: false
            });*/

        // Refilter the table
        $('#min, #max').on('change', function () {
            $('#example').DataTable().draw();
        });

        $('#example').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "ordering": true,
            "order": [[ 0, "asc" ]],
            "responsive": true,
            "dom": 'Bfrtip',
            "language": {
                "search": "_INPUT_",
                "searchPlaceholder": "Search records",
                "info": "Showing _START_ to _END_ of _TOTAL_ records",
                "lengthMenu": "Show _MENU_ records",
                "emptyTable": "No data available in table",
                "zeroRecords": "No matching records found",
                "infoEmpty": "Showing 0 to 0 of 0 records",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                }
            },
            "buttons": [
                {
                    "extend": 'excelHtml5',
                    "exportOptions": {
                        "columns": ':visible',
                        // "columns": [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    "extend": 'pdfHtml5',
                    "customize": function(doc) {
                        doc.defaultStyle.font = "nikosh";
                    },
                    "orientation": 'landscape',
                    "exportOptions": {
                        "columns": ':visible',
                        // "columns": [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    "extend": 'print',
                    "exportOptions": {
                        "columns": ':visible',
                        // "columns": [0, 1, 2, 3, 4, 5]
                    }
                }
            ],
            ordering: false
        });
    });

</script>

