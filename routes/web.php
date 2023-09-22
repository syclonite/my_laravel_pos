<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubCategoryController;
use \App\Http\Controllers\SuppliersController;
use \App\Http\Controllers\UnitController;
use \App\Http\Controllers\PurchaseOrderController;
use \App\Http\Controllers\SaleOrderController;
use \App\Http\Controllers\VoucherController;
use \App\Http\Controllers\ExpenseController;
use \App\Http\Controllers\Auth\LoginController;
use \App\Http\Controllers\LanguageController;
use \App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/login', [LoginController::class, 'show'])->name('login');

Route::post('/login', [LoginController::class, 'handle'])->name('login');

Route::post('/logout', [LoginController::class, 'sign_out'])->name('logout');

Route::get('/', function () { return view('auth.login');})->name('welcome');
Route::get('lang/change', [LanguageController::class ,'change'])->name('changeLang');
Route::post('sales/available_units_ajax',[SaleOrderController::class,'available_units_ajax'])->name('sales.available_units_ajax');
Route::get('sales/get_products_ajax',[SaleOrderController::class,'get_products_ajax'])->name('sales.get_product_ajax');
// Employee MiddleWare
Route::middleware(['role_permission'])->group(function () {
    //write route hear
    Route::get('/dashboard', [DashboardController::class, 'display_dashboard'])->name('dashboard');

// Products_ Routes

    Route::resource('products',ProductController::class);
    Route::post('/products/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('/products/force-delete/{id}', [ProductController::class, 'forceDelete'])->name('products.force_delete');
    Route::post('/products/get_all_units/', [ProductController::class, 'get_unit_ajax'])->name('products.get_unit_ajax');

// Categories_ Routes
    Route::resource('categories',CategoryController::class);
    Route::post('/categories/restore/{id}', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('/categories/force-delete/{id}', [CategoryController::class, 'forceDelete'])->name('categories.force_delete');

// User_ Routes
    Route::resource('users',UserController::class);
    Route::post('/users/restore/{id}', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('/users/force-delete/{id}', [UserController::class, 'forceDelete'])->name('users.force_delete');

// Payment_routes
   Route::get('/customers/due_customer_list', [PaymentController::class, 'customer_payment_index'])->name('customers.customer_payment_index');
   Route::get('/customers/due_customer_payment_create/{id}', [PaymentController::class, 'customer_payment_create'])->name('customers.customer_payment_create');
   Route::post('/customers/due_customer_payment_store', [PaymentController::class, 'customer_payment_store'])->name('customers.customer_payment_store');
   Route::get('/customers/due_customer_billing_list/{id}', [PaymentController::class, 'due_customer_billing_list'])->name('customers.due_customer_billing_list');
   Route::get('/customers/due_customer_edit_list/{id}', [PaymentController::class, 'customer_payment_edit_list'])->name('customers.customer_payment_edit_list');
   Route::get('/customers/due_customer_edit_payment/{id}', [PaymentController::class, 'customer_payment_edit_payment'])->name('customers.customer_payment_edit_payment');
   Route::post('/customers/due_customer_update_payment/{id}', [PaymentController::class, 'customer_payment_update'])->name('customers.customer_payment_update');

   Route::get('/suppliers/due_supplier_list', [PaymentController::class, 'due_supplier_list_index'])->name('suppliers.due_supplier_list_index');
   Route::get('/suppliers/due_suppliers_billing_list/{id}', [PaymentController::class, 'due_supplier_billing_list'])->name('suppliers.due_supplier_billing_list');
   Route::get('/suppliers/due_suppliers_payment_create/{id}', [PaymentController::class, 'due_supplier_payment_create'])->name('suppliers.due_supplier_payment_create');
   Route::post('/suppliers/due_suppliers_payment_store/', [PaymentController::class, 'due_supplier_payment_store'])->name('suppliers.due_supplier_payment_store');
   Route::get('/suppliers/due_supplier_payment_edit_list/{id}', [PaymentController::class, 'due_supplier_payment_edit_list'])->name('suppliers.due_supplier_payment_edit_list');
   Route::get('/suppliers/due_supplier_payment_edit_page/{id}', [PaymentController::class, 'due_supplier_payment_edit_page'])->name('suppliers.due_supplier_payment_edit_page');
   Route::post('/suppliers/due_supplier_payment_update/{id}', [PaymentController::class, 'due_supplier_payment_update'])->name('suppliers.due_supplier_payment_update');

// Customers_ Routes
    Route::resource('customers',CustomerController::class);
    Route::post('/customers/restore/{id}', [CustomerController::class, 'restore'])->name('customers.restore');
    Route::delete('/customers/force-delete/{id}', [CustomerController::class, 'forceDelete'])->name('customers.force_delete');


// Roles_ Routes
    Route::resource('roles',RoleController::class);
    Route::post('/roles/restore/{id}', [RoleController::class, 'restore'])->name('roles.restore');
    Route::delete('/roles/force-delete/{id}', [RoleController::class, 'forceDelete'])->name('roles.force_delete');

// Subcategories Routes
    Route::resource('subcategories',SubCategoryController::class);
    Route::post('/subcategories/restore/{id}', [SubCategoryController::class, 'restore'])->name('subcategories.restore');
    Route::delete('/subcategories/force-delete/{id}', [SubCategoryController::class, 'forceDelete'])->name('subcategories.force_delete');

// Suppliers_ Routes
    Route::resource('suppliers',SuppliersController::class);
    Route::post('/suppliers/restore/{id}', [SuppliersController::class, 'restore'])->name('suppliers.restore');
    Route::delete('/suppliers/force-delete/{id}', [SuppliersController::class, 'forceDelete'])->name('suppliers.force_delete');

// Unit_ Routes
    Route::resource('units',UnitController::class);
    Route::post('/units/restore/{id}', [UnitController::class, 'restore'])->name('units.restore');
    Route::delete('/units/force-delete/{id}', [UnitController::class, 'forceDelete'])->name('units.force_delete');

// Sales_ Routes
    Route::resource('sales',SaleOrderController::class);
    Route::post('/sales/update/{id}',[SaleOrderController::class, 'update'])->name('pos_sales.update');
    Route::post('sales/customer/',[SaleOrderController::class,'get_customer'])->name('sales.customer_details');
    Route::post('sales/add_customer/',[SaleOrderController::class,'add_new_customer'])->name('sales.add_new_customer');
    Route::post('sales/get_all_customer_ajax/',[SaleOrderController::class,'get_customer_ajax'])->name('sales.ajax_all_customer');
    Route::post('sales/available_stock_price_ajax/',[SaleOrderController::class,'available_stock_price_ajax'])->name('sales.available_stock_price_ajax');
    Route::get('sales/print_sale_invoice/{id}',[SaleOrderController::class, 'print_sale_invoice'])->name('sales.print_sale_invoice');


// Purchase_ Routes
    Route::get('/purchase',[PurchaseOrderController::class, 'index'])->name('purchase.index');
    Route::get('/purchase/create',[PurchaseOrderController::class, 'create'])->name('purchase.create');
    Route::post('/purchase/store',[PurchaseOrderController::class, 'store'])->name('purchase.store');
    Route::get('/purchase/edit/{id}',[PurchaseOrderController::class, 'edit'])->name('purchase.edit');
    Route::post('/purchase/update/{id}',[PurchaseOrderController::class, 'update'])->name('purchase.update');
    Route::delete('/purchase/delete/{id}',[PurchaseOrderController::class, 'destroy'])->name('purchase.destroy');
    Route::post('purchase/supplier/',[PurchaseOrderController::class,'get_supplier'])->name('purchase.supplier_details');
    Route::post('purchase/add_supplier/',[PurchaseOrderController::class,'add_new_supplier'])->name('purchase.add_new_supplier');
    Route::post('purchase/get_all_supplier_ajax/',[PurchaseOrderController::class,'get_supplier_ajax'])->name('purchase.ajax_all_supplier');
    Route::get('purchase/get_all_units_ajax/',[PurchaseOrderController::class,'get_units_all_ajax'])->name('purchase.get_units_all_ajax');
    Route::post('purchase/add_new_units/',[PurchaseOrderController::class,'add_new_unit'])->name('purchase.add_new_unit');
    Route::get('purchase/print_purchase_invoice/{id}',[PurchaseOrderController::class, 'print_purchase_invoice'])->name('purchase.print_purchase_invoice');


    // Expenses_ Routes
    Route::resource('expenses',ExpenseController::class);
    Route::post('/expenses/restore/{id}', [ExpenseController::class, 'expense_restore'])->name('expenses.restore');
    Route::delete('/expenses/force-delete/{id}', [ExpenseController::class, 'expense_forceDelete'])->name('expenses.force_delete');

    Route::get('/expense_record/index',[ExpenseController::class,'expense_record_index'])->name('expense_record.index');
    Route::get('/expense_record/create',[ExpenseController::class,'expense_record_create'])->name('expense_record.create');
    Route::post('/expense_record/store',[ExpenseController::class,'expense_record_store'])->name('expense_record.store');
    Route::get('/expense_record/edit/{id}',[ExpenseController::class,'expense_record_edit'])->name('expense_record.edit');
    Route::post('/expense_record/update/{id}',[ExpenseController::class,'expense_record_update'])->name('expense_record.update');
    Route::delete('/expense_record/delete/{id}',[ExpenseController::class,'expanse_record_destroy'])->name('expense_record.destroy');
    Route::post('/expense_record/restore/{id}', [ExpenseController::class, 'expense_record_restore'])->name('expense_record.restore');
    Route::delete('/expense_record/force-delete/{id}', [ExpenseController::class, 'expense_record_forceDelete'])->name('expense_record.force_delete');

// Voucher_ Routes
    Route::get('/voucher/create',[VoucherController::class, 'create_voucher'])->name('voucher.create_voucher');
    Route::post('/voucher/voucher_selected_customer',[VoucherController::class, 'voucher_selected_customer'])->name('voucher.voucher_selected_customer');
    Route::post('/voucher/add_customer',[VoucherController::class, 'add_customer_voucher'])->name('voucher.add_customer_voucher');
    Route::post('/voucher/all_customers_ajax',[VoucherController::class, 'all_voucher_customer_ajax'])->name('voucher.all_voucher_customer_ajax');
    Route::post('/voucher/all_product_price_ajax',[VoucherController::class, 'all_voucher_product_price_ajax'])->name('voucher.all_voucher_product_price_ajax');
    Route::post('/voucher/voucher_store',[VoucherController::class, 'voucher_store'])->name('voucher.voucher_store');
    Route::get('admin/voucher/voucher_index',[VoucherController::class, 'index'])->name('voucher.voucher_index');
    Route::get('/voucher/print_voucher/{id}',[VoucherController::class, 'print_voucher'])->name('voucher.print_voucher');
    Route::delete('/voucher/delete/{id}',[VoucherController::class, 'destroy'])->name('voucher.destroy');
    Route::post('/voucher/restore/{id}', [VoucherController::class, 'voucher_restore'])->name('voucher.restore');
    Route::delete('/voucher/force-delete/{id}', [VoucherController::class, 'voucher_forceDelete'])->name('voucher.force_delete');

    //Report Routes
    Route::get('/report/index', [ReportController::class, 'report_index'])->name('report_index');
    Route::get('/report/stock_report/index', [ReportController::class, 'stock_report_index'])->name('stock_report_index');
    Route::get('/report/voucher_report/index', [ReportController::class, 'sales_voucher_report_index'])->name('sales_voucher_report_index');
    Route::get('/report/voucher_report/details_sales_voucher/{id}', [ReportController::class, 'sales_voucher_details_list'])->name('sales_voucher_details_list');
    Route::get('/report/voucher_report/weekly_report', [ReportController::class, 'sales_voucher_weekly_report'])->name('sales_voucher_weekly_report');
    Route::get('/report/voucher_report/daily_report', [ReportController::class, 'sales_voucher_daily_report'])->name('sales_voucher_daily_report');
    Route::get('/report/voucher_report/monthly_report', [ReportController::class, 'sales_voucher_monthly_report'])->name('sales_voucher_monthly_report');
    Route::get('/report/voucher_report/yearly_report', [ReportController::class, 'sales_voucher_yearly_report'])->name('sales_voucher_yearly_report');
    Route::get('/report/expense_report/daily_report', [ExpenseController::class, 'expense_record_daily_report'])->name('expense_record_daily_report');
    Route::get('/report/expense_report/weekly_report', [ExpenseController::class, 'expense_record_weekly_report'])->name('expense_record_weekly_report');
    Route::get('/report/expense_report/monthly_report', [ExpenseController::class, 'expense_record_monthly_report'])->name('expense_record_monthly_report');
    Route::get('/report/expense_report/yearly_report', [ExpenseController::class, 'expense_record_yearly_report'])->name('expense_record_yearly_report');
    Route::get('/report/gross_profit/index', [ReportController::class, 'gross_profit_index'])->name('gross_profit_index');
    Route::get('/report/gross_profit/daily_report', [ReportController::class, 'gross_profit_daily'])->name('gross_profit_daily');
    Route::get('/report/gross_profit/weekly_report', [ReportController::class, 'gross_profit_weekly'])->name('gross_profit_weekly');
    Route::get('/report/gross_profit/monthly_report', [ReportController::class, 'gross_profit_monthly'])->name('gross_profit_monthly');
    Route::get('/report/gross_profit/yearly_report', [ReportController::class, 'gross_profit_yearly'])->name('gross_profit_yearly');
    Route::get('/report/net_profit/index', [ReportController::class, 'net_profit_index'])->name('net_profit_index');
    Route::get('/report/net_profit/daily_report', [ReportController::class, 'net_profit_daily'])->name('net_profit_daily');
    Route::get('/report/net_profit/weekly_report', [ReportController::class, 'net_profit_weekly'])->name('net_profit_weekly');
    Route::get('/report/net_profit/monthly_report', [ReportController::class, 'net_profit_monthly'])->name('net_profit_monthly');
    Route::get('/report/net_profit/yearly_report', [ReportController::class, 'net_profit_yearly'])->name('net_profit_yearly');
    Route::get('/report/stock_report/all_product_stock', [ReportController::class, 'All_product_stock_reports'])->name('all_product_stock_reports');

});

