<?php

namespace App\Http\Controllers;

use App\Models\ExpenseRecord;
use App\Models\PurchaseOrder;
use App\Models\SaleOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function display_dashboard(){
        $today_total_sales = SaleOrder::whereDate('created_at', Carbon::today())->sum('billing_amount');
        $today_total_expense = ExpenseRecord::whereDate('created_at', Carbon::today())->sum('amount');
        $today_total_customer_bill = SaleOrder::whereDate('created_at', Carbon::today())->where('status',1)->sum('billing_amount');
        $today_total_customer_paid = SaleOrder::whereDate('created_at', Carbon::today())->where('status',1)->sum('paid_amount');

        if ($today_total_customer_bill > $today_total_customer_paid){
            $today_total_customer_due = $today_total_customer_bill - $today_total_customer_paid;
        }elseif ($today_total_customer_bill < $today_total_customer_paid){
            $today_total_customer_due = 0;
        }elseif ($today_total_customer_bill == $today_total_customer_paid) {
            $today_total_customer_due = 0;
        }

        $today_total_supplier_bill = PurchaseOrder::whereDate('created_at', Carbon::today())->where('status',1)->sum('billing_amount');
        $today_total_supplier_paid = PurchaseOrder::whereDate('created_at', Carbon::today())->where('status',1)->sum('paid_amount');

        if ($today_total_supplier_bill > $today_total_supplier_paid){
            $today_total_supplier_due = $today_total_supplier_bill - $today_total_supplier_paid;
        }elseif ($today_total_supplier_bill < $today_total_supplier_paid){
            $today_total_supplier_due = 0;
        }elseif ($today_total_supplier_bill == $today_total_supplier_paid) {
            $today_total_supplier_due = 0;
        }

        $monthwise_net_profit_chart = DB::select(DB::raw("SELECT date, (SUM(amount)- SUM(amount1))- SUM(expense) AS `net_profit`
                                        FROM (SELECT DATE_FORMAT(created_at,'%M') AS date, billing_amount AS amount1, 0 AS amount, 0 as expense
                                        FROM purchase_orders
                                        UNION ALL
                                        SELECT DATE_FORMAT(created_at,'%M') AS date,0, billing_amount,0 as expense
                                        FROM sale_orders
                                        UNION ALL
                                        SELECT DATE_FORMAT(created_at,'%M') AS date,0,0, amount as expense
                                        from expense_records ) AS `combined_tables` GROUP BY date;"));
        $monthwise_net_profit_chart_date = collect($monthwise_net_profit_chart)->pluck('date');
        $monthwise_net_profit_chart_value = collect($monthwise_net_profit_chart)->pluck('net_profit');

        $expense_chart = DB::select(DB::raw("SELECT expenses.expense_category_name,SUM(expense_record_details.amount)as amount FROM expense_record_details INNER JOIN expenses ON expense_id = expenses.id GROUP by expense_category_name;"));
        $expense_category_name_chart = collect($expense_chart)->pluck("expense_category_name");
        $expense_category_amount_chart = collect($expense_chart)->pluck("amount");
//        dd($expense_category_amount_chart);

//      dd("sale=".$today_total_sales,"expense=".$today_total_expense,"customer_due=".$today_total_customer_due,"supplier_due=".$today_total_supplier_due);
        return view('backend.dashboard',compact('today_total_supplier_due','today_total_customer_due','today_total_sales','today_total_expense','monthwise_net_profit_chart_date','monthwise_net_profit_chart_value','expense_category_amount_chart','expense_category_name_chart'));
    }

}
