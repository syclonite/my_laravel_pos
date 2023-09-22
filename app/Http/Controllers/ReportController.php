<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\SaleOrder;
use App\Models\SaleOrderDetail;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function report_index(){

        $total_net_profit = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue,sum(expense) as expense
                                    FROM (
                                        SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount, 0 as expense
                                        FROM purchase_orders
                                        UNION ALL
                                        SELECT date(created_at),0, billing_amount,0 as expense
                                        FROM sale_orders
                                        UNION ALL
                                        SELECT date(created_at),0,0, amount as expense
                                        from expense_records
                                    ) AS combined_tables"));

        $total_gross_profit = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue
                                FROM (SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount FROM purchase_orders
                                UNION ALL
                                SELECT date(created_at), 0, billing_amount FROM sale_orders) AS combined_tables"));

        $supplier_due_summary = DB::select(DB::raw("SELECT COUNT(suppliers.id) supplier_count,
        SUM((SELECT sum(purchase_orders.billing_amount)
          FROM purchase_orders
          WHERE purchase_orders.supplier_id=suppliers.id AND purchase_orders.status = 1)) total_billing_amount,
        SUM((SELECT sum(supplier_payment_details.paid_amount)
          FROM supplier_payment_details
          WHERE supplier_payment_details.supplier_id=suppliers.id)) total_paid_amount
        FROM suppliers LEFT JOIN purchase_orders ON purchase_orders.supplier_id=suppliers.id
        LEFT JOIN supplier_payment_details ON supplier_payment_details.supplier_id=suppliers.id
        WHERE purchase_orders.status = 1;"));

        $customer_due_summary = DB::select(DB::raw("SELECT COUNT(customers.id) customer_count,SUM((SELECT sum(sale_orders.billing_amount) FROM sale_orders WHERE sale_orders.customer_id=customers.id AND sale_orders.status = 1)) total_bill,
                                SUM(( SELECT sum(customer_payment_details.paid_amount) FROM customer_payment_details WHERE customer_payment_details.customer_id=customers.id)) total_paid FROM customers
                                LEFT JOIN sale_orders ON sale_orders.customer_id=customers.id
                                LEFT JOIN customer_payment_details ON customer_payment_details.customer_id=customers.id WHERE sale_orders.status = 1;"));


        return view('backend.report.report_index',compact('customer_due_summary','supplier_due_summary','total_gross_profit','total_net_profit'));
    }
    public function stock_report_index(){

        $stocks = Product::where([['quantity','<=',10],['status',1]])->get();
//        dd($stocks);
        return view('backend.report.stock_report_index',compact('stocks'));
    }

    public function sales_voucher_report_index(Request $request){
//        dd($request->all());

        if($request->has('start_date','end_date')){
            $start_date = $request->start_date;
            $end_date = $request->end_date;

            $table_data = DB::select(DB::raw("SELECT sale_orders.id, customers.name, COUNT(sale_order_details.id) as items, sale_orders.billing_amount,sale_orders.extra_charge, sale_orders.discount, sale_orders.paid_amount,(sale_orders.paid_amount - sale_orders.billing_amount) as current_amount
                            FROM sale_orders
                            INNER JOIN sale_order_details ON sale_order_details.sale_order_id = sale_orders.id
                            INNER JOIN customers ON customers.id = sale_orders.customer_id
                            where sale_orders.created_at BETWEEN  '$start_date 00:00:00' AND '$end_date 23:59:59'
                            GROUP BY sale_orders.id  ORDER BY sale_orders.created_at DESC;"));

            $total_sale_reports = DB::select(DB::raw("SELECT COUNT(sale_orders.id) as voucher_count, SUM(sale_orders.billing_amount) as total_bill, SUM(sale_orders.paid_amount) as total_paid,SUM(sale_orders.billing_amount - sale_orders.paid_amount) as total_due
                                    FROM sale_orders
                                    where sale_orders.created_at BETWEEN  '$start_date 00:00:00' AND '$end_date 23:59:59' ORDER BY sale_orders.created_at DESC;"));

            $array_all_sales_due_data = DB::select(DB::raw("SELECT sale_orders.id, customers.name, COUNT(sale_order_details.id) as items, sale_orders.billing_amount,sale_orders.extra_charge, sale_orders.discount, IFNULL(sale_orders.paid_amount,0),
                                    ( sale_orders.billing_amount - IFNULL(sale_orders.paid_amount,0)) as current_amount,
                                    (SELECT SUM(CASE WHEN current_amount > 0 THEN current_amount ELSE 0 END) ) AS sum_total_due FROM sale_orders INNER JOIN sale_order_details ON sale_order_details.sale_order_id = sale_orders.id
                                    INNER JOIN customers ON customers.id = sale_orders.customer_id where sale_orders.created_at BETWEEN  '$start_date 00:00:00' AND '$end_date 23:59:59' GROUP BY sale_orders.id ORDER BY sale_orders.created_at DESC"));

            $only_total_due_amount = array_sum(array_column($array_all_sales_due_data, 'sum_total_due'));

        }else{
             $table_data = DB::select(DB::raw("SELECT sale_orders.id, customers.name, COUNT(sale_order_details.id) as items, sale_orders.billing_amount,sale_orders.extra_charge, sale_orders.discount, sale_orders.paid_amount
                        FROM sale_orders
                        INNER JOIN sale_order_details ON sale_order_details.sale_order_id = sale_orders.id
                        INNER JOIN customers ON customers.id = sale_orders.customer_id
                        GROUP BY sale_orders.id  ORDER BY sale_orders.created_at DESC;"));

            $total_sale_reports = DB::select(DB::raw("SELECT COUNT(sale_orders.id) as voucher_count, SUM(sale_orders.billing_amount) as total_bill, SUM(sale_orders.paid_amount) as total_paid,SUM(sale_orders.billing_amount - sale_orders.paid_amount) as total_due
                                    FROM sale_orders ORDER BY sale_orders.created_at DESC;"));

            $array_all_sales_due_data = DB::select(DB::raw("SELECT sale_orders.id, customers.name, COUNT(sale_order_details.id) as items, sale_orders.billing_amount,sale_orders.extra_charge, sale_orders.discount, IFNULL(sale_orders.paid_amount,0),
                                    ( sale_orders.billing_amount - IFNULL(sale_orders.paid_amount,0)) as current_amount,
                                    (SELECT SUM(CASE WHEN current_amount > 0 THEN current_amount ELSE 0 END) ) AS sum_total_due FROM sale_orders INNER JOIN sale_order_details ON sale_order_details.sale_order_id = sale_orders.id
                                    INNER JOIN customers ON customers.id = sale_orders.customer_id GROUP BY sale_orders.id ORDER BY sale_orders.created_at DESC"));

            $only_total_due_amount = array_sum(array_column($array_all_sales_due_data, 'sum_total_due'));

        }

        return view('backend.report.sales_voucher_report.sales_voucher_report_index',compact('only_total_due_amount','table_data','total_sale_reports'));
    }

    public function sales_voucher_details_list($id){
        $sale_order = SaleOrder::find($id);
        $customers = Customer::find($sale_order->customer_id);
        $sale_order_details = SaleOrderDetail::where('sale_order_id',$sale_order->id)->where('product_id','<>','')->get();
        return view('backend.report.sales_voucher_report.details_sales_voucher',compact('sale_order_details','sale_order','customers'));
    }

    public function sales_voucher_weekly_report(){

            $table_data = DB::select(DB::raw("SELECT sale_orders.id, customers.name, COUNT(sale_order_details.id) as items, sale_orders.billing_amount,sale_orders.extra_charge, sale_orders.discount, sale_orders.paid_amount,(sale_orders.paid_amount - sale_orders.billing_amount) as current_amount
                            FROM sale_orders
                            INNER JOIN sale_order_details ON sale_order_details.sale_order_id = sale_orders.id
                            INNER JOIN customers ON customers.id = sale_orders.customer_id
                            where sale_orders.created_at > now() - interval '7' day
                            GROUP BY sale_orders.id  ORDER BY sale_orders.created_at DESC;"));

            $total_sale_reports = DB::select(DB::raw("SELECT COUNT(sale_orders.id) as voucher_count, SUM(sale_orders.billing_amount) as total_bill, SUM(sale_orders.paid_amount) as total_paid,SUM(sale_orders.billing_amount - sale_orders.paid_amount) as total_due
                                    FROM sale_orders
                                    where sale_orders.created_at > now() - interval '7' day ORDER BY sale_orders.created_at DESC;"));

        $array_all_sales_due_data = DB::select(DB::raw("SELECT sale_orders.id, customers.name, COUNT(sale_order_details.id) as items, sale_orders.billing_amount,sale_orders.extra_charge, sale_orders.discount, IFNULL(sale_orders.paid_amount,0),
                                    ( sale_orders.billing_amount - IFNULL(sale_orders.paid_amount,0)) as current_amount,
                                    (SELECT SUM(CASE WHEN current_amount > 0 THEN current_amount ELSE 0 END) ) AS sum_total_due FROM sale_orders INNER JOIN sale_order_details ON sale_order_details.sale_order_id = sale_orders.id
                                    INNER JOIN customers ON customers.id = sale_orders.customer_id where sale_orders.created_at > now() - interval '7' day GROUP BY sale_orders.id ORDER BY sale_orders.created_at DESC"));

        $only_total_due_amount = array_sum(array_column($array_all_sales_due_data, 'sum_total_due'));

        return view('backend.report.sales_voucher_report.sales_voucher_report_index',compact('only_total_due_amount','table_data','total_sale_reports'));

    }

    public function sales_voucher_daily_report(){

        $table_data = DB::select(DB::raw("SELECT sale_orders.id, customers.name, COUNT(sale_order_details.id) as items, sale_orders.billing_amount,sale_orders.extra_charge, sale_orders.discount, sale_orders.paid_amount,(sale_orders.paid_amount - sale_orders.billing_amount) as current_amount
                            FROM sale_orders
                            INNER JOIN sale_order_details ON sale_order_details.sale_order_id = sale_orders.id
                            INNER JOIN customers ON customers.id = sale_orders.customer_id
                            where date(sale_orders.created_at) = current_date
                            GROUP BY sale_orders.id  ORDER BY sale_orders.created_at DESC;"));
        $total_sale_reports = DB::select(DB::raw("SELECT COUNT(sale_orders.id) as voucher_count, SUM(sale_orders.billing_amount) as total_bill, SUM(sale_orders.paid_amount) as total_paid,SUM(sale_orders.billing_amount - sale_orders.paid_amount) as total_due
                                    FROM sale_orders
                                    where date(sale_orders.created_at) = current_date ORDER BY sale_orders.created_at DESC;"));

        $array_all_sales_due_data = DB::select(DB::raw("SELECT sale_orders.id, customers.name, COUNT(sale_order_details.id) as items, sale_orders.billing_amount,sale_orders.extra_charge, sale_orders.discount, IFNULL(sale_orders.paid_amount,0),
                                    ( sale_orders.billing_amount - IFNULL(sale_orders.paid_amount,0)) as current_amount,
                                    (SELECT SUM(CASE WHEN current_amount > 0 THEN current_amount ELSE 0 END) ) AS sum_total_due FROM sale_orders INNER JOIN sale_order_details ON sale_order_details.sale_order_id = sale_orders.id
                                    INNER JOIN customers ON customers.id = sale_orders.customer_id where date(sale_orders.created_at) = current_date GROUP BY sale_orders.id ORDER BY sale_orders.created_at DESC"));

        $only_total_due_amount = array_sum(array_column($array_all_sales_due_data, 'sum_total_due'));

        return view('backend.report.sales_voucher_report.sales_voucher_report_index',compact('only_total_due_amount','table_data','total_sale_reports'));
    }

    public function sales_voucher_monthly_report(){

        $table_data = DB::select(DB::raw("SELECT sale_orders.id, customers.name, COUNT(sale_order_details.id) as items, sale_orders.billing_amount,sale_orders.extra_charge, sale_orders.discount, sale_orders.paid_amount,(sale_orders.paid_amount - sale_orders.billing_amount) as current_amount
                            FROM sale_orders
                            INNER JOIN sale_order_details ON sale_order_details.sale_order_id = sale_orders.id
                            INNER JOIN customers ON customers.id = sale_orders.customer_id
                            where sale_orders.created_at > now() - interval '30' day
                            GROUP BY sale_orders.id  ORDER BY sale_orders.created_at DESC;"));
        $total_sale_reports = DB::select(DB::raw("SELECT COUNT(sale_orders.id) as voucher_count, SUM(sale_orders.billing_amount) as total_bill, SUM(sale_orders.paid_amount) as total_paid,SUM(sale_orders.billing_amount - sale_orders.paid_amount) as total_due
                                    FROM sale_orders
                                    where sale_orders.created_at > now() - interval '30' day ORDER BY sale_orders.created_at DESC;"));

        $array_all_sales_due_data = DB::select(DB::raw("SELECT sale_orders.id, customers.name, COUNT(sale_order_details.id) as items, sale_orders.billing_amount,sale_orders.extra_charge, sale_orders.discount, IFNULL(sale_orders.paid_amount,0),
                                    ( sale_orders.billing_amount - IFNULL(sale_orders.paid_amount,0)) as current_amount,
                                    (SELECT SUM(CASE WHEN current_amount > 0 THEN current_amount ELSE 0 END) ) AS sum_total_due FROM sale_orders INNER JOIN sale_order_details ON sale_order_details.sale_order_id = sale_orders.id
                                    INNER JOIN customers ON customers.id = sale_orders.customer_id where sale_orders.created_at > now() - interval '30' day GROUP BY sale_orders.id ORDER BY sale_orders.created_at DESC"));

        $only_total_due_amount = array_sum(array_column($array_all_sales_due_data, 'sum_total_due'));

        return view('backend.report.sales_voucher_report.sales_voucher_report_index',compact('only_total_due_amount','table_data','total_sale_reports'));
    }

    public function sales_voucher_yearly_report(){

        $table_data = DB::select(DB::raw("SELECT sale_orders.id, customers.name, COUNT(sale_order_details.id) as items, sale_orders.billing_amount,sale_orders.extra_charge, sale_orders.discount, sale_orders.paid_amount,(sale_orders.paid_amount - sale_orders.billing_amount) as current_amount
                            FROM sale_orders
                            INNER JOIN sale_order_details ON sale_order_details.sale_order_id = sale_orders.id
                            INNER JOIN customers ON customers.id = sale_orders.customer_id
                            where sale_orders.created_at > now() - interval '365' day
                            GROUP BY sale_orders.id  ORDER BY sale_orders.created_at DESC;"));

        $total_sale_reports = DB::select(DB::raw("SELECT COUNT(sale_orders.id) as voucher_count, SUM(sale_orders.billing_amount) as total_bill, SUM(sale_orders.paid_amount) as total_paid,SUM(sale_orders.billing_amount - sale_orders.paid_amount) as total_due
                                    FROM sale_orders
                                    where sale_orders.created_at > now() - interval '365' day ORDER BY sale_orders.created_at DESC;"));

        $array_all_sales_due_data = DB::select(DB::raw("SELECT sale_orders.id, customers.name, COUNT(sale_order_details.id) as items, sale_orders.billing_amount,sale_orders.extra_charge, sale_orders.discount, IFNULL(sale_orders.paid_amount,0),
                                    ( sale_orders.billing_amount - IFNULL(sale_orders.paid_amount,0)) as current_amount,
                                    (SELECT SUM(CASE WHEN current_amount > 0 THEN current_amount ELSE 0 END) ) AS sum_total_due FROM sale_orders INNER JOIN sale_order_details ON sale_order_details.sale_order_id = sale_orders.id
                                    INNER JOIN customers ON customers.id = sale_orders.customer_id where sale_orders.created_at > now() - interval '365' day GROUP BY sale_orders.id ORDER BY sale_orders.created_at DESC"));

        $only_total_due_amount = array_sum(array_column($array_all_sales_due_data, 'sum_total_due'));

        return view('backend.report.sales_voucher_report.sales_voucher_report_index',compact('only_total_due_amount','table_data','total_sale_reports'));
    }
    public function gross_profit_index(Request $request) {
        if($request->has('start_date','end_date')) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;

            $total_gross_profit = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue
                                FROM (SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount FROM purchase_orders
                                UNION ALL
                                SELECT date(created_at), 0, billing_amount FROM sale_orders) AS combined_tables where date BETWEEN  '$start_date' AND '$end_date' "));
            $gross_table_data = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue
                                FROM (SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount FROM purchase_orders
                                UNION ALL
                                SELECT date(created_at), 0, billing_amount FROM sale_orders) AS combined_tables where date BETWEEN  '$start_date' AND '$end_date' group by date order by date DESC"));

            $chart_gross_profit_datewise = DB::select(DB::raw("SELECT date, (SUM(amount) - SUM(amount1))as gross_profit
            FROM (SELECT DATE_FORMAT(created_at,'%D %M') AS date, billing_amount AS amount1, 0 AS amount FROM purchase_orders where created_at BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59'
            UNION ALL
            SELECT DATE_FORMAT(created_at,'%D %M') as date, 0, billing_amount FROM sale_orders where created_at BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59') AS combined_tables group by date ORDER BY `combined_tables`.`date` ASC;"));
            $datewise_chart_dates = collect($chart_gross_profit_datewise)->pluck('date');
            $datewise_chart_value = collect($chart_gross_profit_datewise)->pluck('gross_profit');

            $chart_gross_profit_monthwise =DB::select(DB::raw("SELECT date, SUM(amount) - SUM(amount1)as gross_profit
            FROM (SELECT DATE_FORMAT(created_at,'%M') AS date, billing_amount AS amount1, 0 AS amount FROM purchase_orders where created_at BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59'
            UNION ALL
            SELECT DATE_FORMAT(created_at,'%M') as date, 0, billing_amount FROM sale_orders where created_at BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59') AS combined_tables group by date ORDER BY `combined_tables`.`date` ASC;"));
            $monthwise_chart_dates = collect($chart_gross_profit_monthwise)->pluck('date');
            $monthwise_chart_value = collect($chart_gross_profit_monthwise)->pluck('gross_profit');
        }else{
            $total_gross_profit = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue
                                FROM (SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount FROM purchase_orders
                                UNION ALL
                                SELECT date(created_at), 0, billing_amount FROM sale_orders) AS combined_tables"));
            $gross_table_data = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue
                                FROM (SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount FROM purchase_orders
                                UNION ALL
                                SELECT date(created_at), 0, billing_amount FROM sale_orders) AS combined_tables group by date order by date DESC"));

            $chart_gross_profit_datewise = DB::select(DB::raw("SELECT date, (SUM(amount) - SUM(amount1))as gross_profit
            FROM (SELECT DATE_FORMAT(created_at,'%D %M') AS date, billing_amount AS amount1, 0 AS amount FROM purchase_orders
            UNION ALL
            SELECT DATE_FORMAT(created_at,'%D %M') as date, 0, billing_amount FROM sale_orders ) AS combined_tables group by date ORDER BY `combined_tables`.`date` ASC;"));
            $datewise_chart_dates = collect($chart_gross_profit_datewise)->pluck('date');
            $datewise_chart_value = collect($chart_gross_profit_datewise)->pluck('gross_profit');

            $chart_gross_profit_monthwise =DB::select(DB::raw("SELECT date, SUM(amount) - SUM(amount1)as gross_profit
            FROM (SELECT DATE_FORMAT(created_at,'%M') AS date, billing_amount AS amount1, 0 AS amount FROM purchase_orders
            UNION ALL
            SELECT DATE_FORMAT(created_at,'%M') as date, 0, billing_amount FROM sale_orders) AS combined_tables group by date ORDER BY `combined_tables`.`date` ASC;"));
            $monthwise_chart_dates = collect($chart_gross_profit_monthwise)->pluck('date');
            $monthwise_chart_value = collect($chart_gross_profit_monthwise)->pluck('gross_profit');
        }

        return view('backend.report.gross_profit',compact('total_gross_profit','gross_table_data','datewise_chart_dates','datewise_chart_value','monthwise_chart_dates','monthwise_chart_value'));
    }

    public function gross_profit_daily() {
        $total_gross_profit = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue
                                FROM (SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount FROM purchase_orders
                                UNION ALL
                                SELECT date(created_at), 0, billing_amount FROM sale_orders) AS combined_tables where date = CURRENT_DATE"));
        $gross_table_data = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue
                                FROM (SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount FROM purchase_orders
                                UNION ALL
                                SELECT date(created_at), 0, billing_amount FROM sale_orders) AS combined_tables where date = CURRENT_DATE group by date order by date DESC"));

        $chart_gross_profit_datewise = DB::select(DB::raw("SELECT date, (SUM(amount) - SUM(amount1))as gross_profit
            FROM (SELECT DATE_FORMAT(created_at,'%D %M') AS date, billing_amount AS amount1, 0 AS amount FROM purchase_orders where created_at = CURRENT_DATE
            UNION ALL
            SELECT DATE_FORMAT(created_at,'%D %M') as date, 0, billing_amount FROM sale_orders where created_at = CURRENT_DATE) AS combined_tables group by date ORDER BY `combined_tables`.`date` ASC;"));
        $datewise_chart_dates = collect($chart_gross_profit_datewise)->pluck('date');
        $datewise_chart_value = collect($chart_gross_profit_datewise)->pluck('gross_profit');

        $chart_gross_profit_monthwise =DB::select(DB::raw("SELECT date, SUM(amount) - SUM(amount1)as gross_profit
            FROM (SELECT DATE_FORMAT(created_at,'%M') AS date, billing_amount AS amount1, 0 AS amount FROM purchase_orders where created_at = CURRENT_DATE
            UNION ALL
            SELECT DATE_FORMAT(created_at,'%M') as date, 0, billing_amount FROM sale_orders where created_at = CURRENT_DATE) AS combined_tables group by date ORDER BY `combined_tables`.`date` ASC;"));
        $monthwise_chart_dates = collect($chart_gross_profit_monthwise)->pluck('date');
        $monthwise_chart_value = collect($chart_gross_profit_monthwise)->pluck('gross_profit');
        return view('backend.report.gross_profit',compact('total_gross_profit','gross_table_data','datewise_chart_dates','datewise_chart_value','monthwise_chart_dates','monthwise_chart_value'));
    }

    public function gross_profit_weekly() {
        $total_gross_profit = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue
                                FROM (SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount FROM purchase_orders
                                UNION ALL
                                SELECT date(created_at), 0, billing_amount FROM sale_orders) AS combined_tables where date > now() - interval '7' day"));
        $gross_table_data = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue
                                FROM (SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount FROM purchase_orders
                                UNION ALL
                                SELECT date(created_at), 0, billing_amount FROM sale_orders) AS combined_tables where date > now() - interval '7' day group by date order by date DESC"));

        $chart_gross_profit_datewise = DB::select(DB::raw("SELECT date, (SUM(amount) - SUM(amount1))as gross_profit
            FROM (SELECT DATE_FORMAT(created_at,'%D %M') AS date, billing_amount AS amount1, 0 AS amount FROM purchase_orders where created_at > now() - interval '7' day
            UNION ALL
            SELECT DATE_FORMAT(created_at,'%D %M') as date, 0, billing_amount FROM sale_orders where created_at > now() - interval '7' day) AS combined_tables group by date ORDER BY `combined_tables`.`date` ASC;"));
        $datewise_chart_dates = collect($chart_gross_profit_datewise)->pluck('date');
        $datewise_chart_value = collect($chart_gross_profit_datewise)->pluck('gross_profit');

        $chart_gross_profit_monthwise =DB::select(DB::raw("SELECT date, SUM(amount) - SUM(amount1)as gross_profit
            FROM (SELECT DATE_FORMAT(created_at,'%M') AS date, billing_amount AS amount1, 0 AS amount FROM purchase_orders where created_at > now() - interval '7' day
            UNION ALL
            SELECT DATE_FORMAT(created_at,'%M') as date, 0, billing_amount FROM sale_orders where created_at > now() - interval '7' day) AS combined_tables  group by date ORDER BY `combined_tables`.`date` ASC;"));
        $monthwise_chart_dates = collect($chart_gross_profit_monthwise)->pluck('date');
        $monthwise_chart_value = collect($chart_gross_profit_monthwise)->pluck('gross_profit');
        return view('backend.report.gross_profit',compact('total_gross_profit','gross_table_data','datewise_chart_dates','datewise_chart_value','monthwise_chart_dates','monthwise_chart_value'));
    }

    public function gross_profit_monthly() {
        $total_gross_profit = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue
                                FROM (SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount FROM purchase_orders
                                UNION ALL
                                SELECT date(created_at), 0, billing_amount FROM sale_orders) AS combined_tables where date > now() - interval '30' day"));
        $gross_table_data = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue
                                FROM (SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount FROM purchase_orders
                                UNION ALL
                                SELECT date(created_at), 0, billing_amount FROM sale_orders) AS combined_tables where date > now() - interval '30' day group by date order by date DESC"));

        $chart_gross_profit_datewise = DB::select(DB::raw("SELECT date, (SUM(amount) - SUM(amount1))as gross_profit
            FROM (SELECT DATE_FORMAT(created_at,'%D %M') AS date, billing_amount AS amount1, 0 AS amount FROM purchase_orders where created_at > now() - interval '30' day
            UNION ALL
            SELECT DATE_FORMAT(created_at,'%D %M') as date, 0, billing_amount FROM sale_orders where created_at > now() - interval '30' day) AS combined_tables group by date ORDER BY `combined_tables`.`date` ASC;"));
        $datewise_chart_dates = collect($chart_gross_profit_datewise)->pluck('date');
        $datewise_chart_value = collect($chart_gross_profit_datewise)->pluck('gross_profit');

        $chart_gross_profit_monthwise =DB::select(DB::raw("SELECT date, SUM(amount) - SUM(amount1)as gross_profit
            FROM (SELECT DATE_FORMAT(created_at,'%M') AS date, billing_amount AS amount1, 0 AS amount FROM purchase_orders where created_at > now() - interval '30' day
            UNION ALL
            SELECT DATE_FORMAT(created_at,'%M') as date, 0, billing_amount FROM sale_orders where created_at > now() - interval '30' day) AS combined_tables group by date ORDER BY `combined_tables`.`date` ASC;"));
        $monthwise_chart_dates = collect($chart_gross_profit_monthwise)->pluck('date');
        $monthwise_chart_value = collect($chart_gross_profit_monthwise)->pluck('gross_profit');
        return view('backend.report.gross_profit',compact('total_gross_profit','gross_table_data','datewise_chart_dates','datewise_chart_value','monthwise_chart_dates','monthwise_chart_value'));
    }

    public function gross_profit_yearly() {
        $total_gross_profit = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue
                                FROM (SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount FROM purchase_orders
                                UNION ALL
                                SELECT date(created_at), 0, billing_amount FROM sale_orders) AS combined_tables where date > now() - interval '365' day"));
        $gross_table_data = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue
                                FROM (SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount FROM purchase_orders
                                UNION ALL
                                SELECT date(created_at), 0, billing_amount FROM sale_orders) AS combined_tables where date > now() - interval '365' day group by date order by date DESC"));

        $chart_gross_profit_datewise = DB::select(DB::raw("SELECT date, (SUM(amount) - SUM(amount1))as gross_profit
            FROM (SELECT DATE_FORMAT(created_at,'%D %M') AS date, billing_amount AS amount1, 0 AS amount FROM purchase_orders where created_at > now() - interval '365' day
            UNION ALL
            SELECT DATE_FORMAT(created_at,'%D %M') as date, 0, billing_amount FROM sale_orders  where created_at > now() - interval '365' day) AS combined_tables group by date ORDER BY `combined_tables`.`date` ASC;"));
        $datewise_chart_dates = collect($chart_gross_profit_datewise)->pluck('date');
        $datewise_chart_value = collect($chart_gross_profit_datewise)->pluck('gross_profit');

        $chart_gross_profit_monthwise =DB::select(DB::raw("SELECT date, SUM(amount) - SUM(amount1)as gross_profit
            FROM (SELECT DATE_FORMAT(created_at,'%M') AS date, billing_amount AS amount1, 0 AS amount FROM purchase_orders where created_at > now() - interval '365' day
            UNION ALL
            SELECT DATE_FORMAT(created_at,'%M') as date, 0, billing_amount FROM sale_orders where created_at > now() - interval '365' day) AS combined_tables  group by date ORDER BY `combined_tables`.`date` ASC;"));
        $monthwise_chart_dates = collect($chart_gross_profit_monthwise)->pluck('date');
        $monthwise_chart_value = collect($chart_gross_profit_monthwise)->pluck('gross_profit');
        return view('backend.report.gross_profit',compact('total_gross_profit','gross_table_data','datewise_chart_dates','datewise_chart_value','monthwise_chart_dates','monthwise_chart_value'));
    }

    public function net_profit_index(Request $request) {

        if($request->has('start_date','end_date')) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;

            $total_net_profit = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue,sum(expense) as expense
                                    FROM (
                                        SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount, 0 as expense
                                        FROM purchase_orders
                                        UNION ALL
                                        SELECT date(created_at),0, billing_amount,0 as expense
                                        FROM sale_orders
                                        UNION ALL
                                        SELECT date(created_at),0,0, amount as expense
                                        from expense_records
                                    ) AS combined_tables where date BETWEEN  '$start_date' AND '$end_date' "));
            $net_table_data = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue,sum(expense) as expense
                                    FROM (
                                        SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount, 0 as expense
                                        FROM purchase_orders
                                        UNION ALL
                                        SELECT date(created_at),0, billing_amount,0 as expense
                                        FROM sale_orders
                                        UNION ALL
                                        SELECT date(created_at),0,0, amount as expense
                                        from expense_records
                                    ) AS combined_tables where date BETWEEN  '$start_date' AND '$end_date' group by date order by date DESC"));


            $datewise_net_profit_chart = DB::select(DB::raw("SELECT date, (SUM(amount)- SUM(amount1))- SUM(expense) AS `net_profit`
                                        FROM (SELECT DATE_FORMAT(created_at,'%D %M') AS date, billing_amount AS amount1, 0 AS amount, 0 as expense
                                        FROM purchase_orders where created_at BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59'
                                        UNION ALL
                                        SELECT DATE_FORMAT(created_at,'%D %M') AS date,0, billing_amount,0 as expense
                                        FROM sale_orders where created_at BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59'
                                        UNION ALL
                                        SELECT DATE_FORMAT(created_at,'%D %M') AS date,0,0, amount as expense
                                        from expense_records where created_at BETWEEN    '$start_date' AND '$end_date') AS `combined_tables` GROUP BY date"));
            $datewise_net_profit_chart_date = collect($datewise_net_profit_chart)->pluck('date');
            $datewise_net_profit_chart_value = collect($datewise_net_profit_chart)->pluck('net_profit');

            $monthwise_net_profit_chart = DB::select(DB::raw("SELECT date, (SUM(amount)- SUM(amount1))- SUM(expense) AS `net_profit`
                                        FROM (SELECT DATE_FORMAT(created_at,'%M') AS date, billing_amount AS amount1, 0 AS amount, 0 as expense
                                        FROM purchase_orders where created_at BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59'
                                        UNION ALL
                                        SELECT DATE_FORMAT(created_at,'%M') AS date,0, billing_amount,0 as expense
                                        FROM sale_orders where created_at BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59'
                                        UNION ALL
                                        SELECT DATE_FORMAT(created_at,'%M') AS date,0,0, amount as expense
                                        from expense_records where created_at BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59') AS `combined_tables` GROUP BY date;"));
            $monthwise_net_profit_chart_date = collect($monthwise_net_profit_chart)->pluck('date');
            $monthwise_net_profit_chart_value = collect($monthwise_net_profit_chart)->pluck('net_profit');

        }else{
            $total_net_profit = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue,sum(expense) as expense
                                    FROM (
                                        SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount, 0 as expense
                                        FROM purchase_orders
                                        UNION ALL
                                        SELECT date(created_at),0, billing_amount,0 as expense
                                        FROM sale_orders
                                        UNION ALL
                                        SELECT date(created_at),0,0, amount as expense
                                        from expense_records
                                    ) AS combined_tables"));

            $net_table_data = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue,sum(expense) as expense
                                    FROM (
                                        SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount, 0 as expense
                                        FROM purchase_orders
                                        UNION ALL
                                        SELECT date(created_at),0, billing_amount,0 as expense
                                        FROM sale_orders
                                        UNION ALL
                                        SELECT date(created_at),0,0, amount as expense
                                        from expense_records
                                    ) AS combined_tables group by date order by date DESC"));

            $datewise_net_profit_chart = DB::select(DB::raw("SELECT date, (SUM(amount)- SUM(amount1))- SUM(expense) AS `net_profit`
                                        FROM (SELECT DATE_FORMAT(created_at,'%D %M') AS date, billing_amount AS amount1, 0 AS amount, 0 as expense
                                        FROM purchase_orders
                                        UNION ALL
                                        SELECT DATE_FORMAT(created_at,'%D %M') AS date,0, billing_amount,0 as expense
                                        FROM sale_orders
                                        UNION ALL
                                        SELECT DATE_FORMAT(created_at,'%D %M') AS date,0,0, amount as expense
                                        from expense_records) AS `combined_tables` GROUP BY date"));
            $datewise_net_profit_chart_date = collect($datewise_net_profit_chart)->pluck('date');
            $datewise_net_profit_chart_value = collect($datewise_net_profit_chart)->pluck('net_profit');

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
        }

        return view('backend.report.net_profit',compact('total_net_profit','net_table_data','datewise_net_profit_chart_date','datewise_net_profit_chart_value','monthwise_net_profit_chart_date','monthwise_net_profit_chart_value'));
    }

    public function net_profit_daily() {

        $total_net_profit = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue,sum(expense) as expense
                                    FROM (
                                        SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount, 0 as expense
                                        FROM purchase_orders
                                        UNION ALL
                                        SELECT date(created_at),0, billing_amount,0 as expense
                                        FROM sale_orders
                                        UNION ALL
                                        SELECT date(created_at),0,0, amount as expense
                                        from expense_records
                                    ) AS combined_tables where date = CURRENT_DATE"));
        $net_table_data = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue,sum(expense) as expense
                                    FROM (
                                        SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount, 0 as expense
                                        FROM purchase_orders
                                        UNION ALL
                                        SELECT date(created_at),0, billing_amount,0 as expense
                                        FROM sale_orders
                                        UNION ALL
                                        SELECT date(created_at),0,0, amount as expense
                                        from expense_records
                                    ) AS combined_tables where date = CURRENT_DATE group by date order by date DESC"));

        $datewise_net_profit_chart = DB::select(DB::raw("SELECT date, (SUM(amount)- SUM(amount1))- SUM(expense) AS `net_profit`
                                        FROM (SELECT DATE_FORMAT(created_at,'%D %M') AS date, billing_amount AS amount1, 0 AS amount, 0 as expense
                                        FROM purchase_orders where created_at = CURRENT_DATE
                                        UNION ALL
                                        SELECT DATE_FORMAT(created_at,'%D %M') AS date,0, billing_amount,0 as expense
                                        FROM sale_orders where created_at = CURRENT_DATE
                                        UNION ALL
                                        SELECT DATE_FORMAT(created_at,'%D %M') AS date,0,0, amount as expense
                                        from expense_records where created_at = CURRENT_DATE) AS `combined_tables` GROUP BY date"));
        $datewise_net_profit_chart_date = collect($datewise_net_profit_chart)->pluck('date');
        $datewise_net_profit_chart_value = collect($datewise_net_profit_chart)->pluck('net_profit');

        $monthwise_net_profit_chart = DB::select(DB::raw("SELECT date, (SUM(amount)- SUM(amount1))- SUM(expense) AS `net_profit`
                                        FROM (SELECT DATE_FORMAT(created_at,'%M') AS date, billing_amount AS amount1, 0 AS amount, 0 as expense
                                        FROM purchase_orders where created_at = CURRENT_DATE
                                        UNION ALL
                                        SELECT DATE_FORMAT(created_at,'%M') AS date,0, billing_amount,0 as expense
                                        FROM sale_orders where created_at = CURRENT_DATE
                                        UNION ALL
                                        SELECT DATE_FORMAT(created_at,'%M') AS date,0,0, amount as expense
                                        from expense_records where created_at = CURRENT_DATE) AS `combined_tables` GROUP BY date;"));
        $monthwise_net_profit_chart_date = collect($monthwise_net_profit_chart)->pluck('date');
        $monthwise_net_profit_chart_value = collect($monthwise_net_profit_chart)->pluck('net_profit');


        return view('backend.report.net_profit',compact('total_net_profit','net_table_data','datewise_net_profit_chart_date','datewise_net_profit_chart_value','monthwise_net_profit_chart_date','monthwise_net_profit_chart_value'));
    }

    public function net_profit_weekly() {

        $total_net_profit = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue,sum(expense) as expense
                                    FROM (
                                        SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount, 0 as expense
                                        FROM purchase_orders
                                        UNION ALL
                                        SELECT date(created_at),0, billing_amount,0 as expense
                                        FROM sale_orders
                                        UNION ALL
                                        SELECT date(created_at),0,0, amount as expense
                                        from expense_records
                                    ) AS combined_tables where date > now() - interval '7' day"));

        $net_table_data = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue,sum(expense) as expense
                                    FROM (
                                        SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount, 0 as expense
                                        FROM purchase_orders
                                        UNION ALL
                                        SELECT date(created_at),0, billing_amount,0 as expense
                                        FROM sale_orders
                                        UNION ALL
                                        SELECT date(created_at),0,0, amount as expense
                                        from expense_records
                                    ) AS combined_tables where date > now() - interval '7' day group by date order by date DESC"));

        $datewise_net_profit_chart = DB::select(DB::raw("SELECT date, (SUM(amount)- SUM(amount1))- SUM(expense) AS `net_profit`
                                        FROM (SELECT DATE_FORMAT(created_at,'%D %M') AS date, billing_amount AS amount1, 0 AS amount, 0 as expense
                                        FROM purchase_orders where created_at > now() - interval '7' day
                                        UNION ALL
                                        SELECT DATE_FORMAT(created_at,'%D %M') AS date,0, billing_amount,0 as expense
                                        FROM sale_orders where created_at > now() - interval '7' day
                                        UNION ALL
                                        SELECT DATE_FORMAT(created_at,'%D %M') AS date,0,0, amount as expense
                                        from expense_records where created_at > now() - interval '7' day) AS `combined_tables` GROUP BY date"));
        $datewise_net_profit_chart_date = collect($datewise_net_profit_chart)->pluck('date');
        $datewise_net_profit_chart_value = collect($datewise_net_profit_chart)->pluck('net_profit');

        $monthwise_net_profit_chart = DB::select(DB::raw("SELECT date, (SUM(amount)- SUM(amount1))- SUM(expense) AS `net_profit`
                                        FROM (SELECT DATE_FORMAT(created_at,'%M') AS date, billing_amount AS amount1, 0 AS amount, 0 as expense
                                        FROM purchase_orders where created_at > now() - interval '7' day
                                        UNION ALL
                                        SELECT DATE_FORMAT(created_at,'%M') AS date,0, billing_amount,0 as expense
                                        FROM sale_orders where created_at > now() - interval '7' day
                                        UNION ALL
                                        SELECT DATE_FORMAT(created_at,'%M') AS date,0,0, amount as expense
                                        from expense_records where created_at > now() - interval '7' day) AS `combined_tables` GROUP BY date;"));
        $monthwise_net_profit_chart_date = collect($monthwise_net_profit_chart)->pluck('date');
        $monthwise_net_profit_chart_value = collect($monthwise_net_profit_chart)->pluck('net_profit');



        return view('backend.report.net_profit',compact('total_net_profit','net_table_data','datewise_net_profit_chart_value','datewise_net_profit_chart_date','monthwise_net_profit_chart_date','monthwise_net_profit_chart_value'));
    }

    public function net_profit_monthly() {
        $total_net_profit = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue,sum(expense) as expense
                                    FROM (
                                        SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount, 0 as expense
                                        FROM purchase_orders
                                        UNION ALL
                                        SELECT date(created_at),0, billing_amount,0 as expense
                                        FROM sale_orders
                                        UNION ALL
                                        SELECT date(created_at),0,0, amount as expense
                                        from expense_records
                                    ) AS combined_tables where date > now() - interval '30' day"));
        $net_table_data = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue,sum(expense) as expense
                                    FROM (
                                        SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount, 0 as expense
                                        FROM purchase_orders
                                        UNION ALL
                                        SELECT date(created_at),0, billing_amount,0 as expense
                                        FROM sale_orders
                                        UNION ALL
                                        SELECT date(created_at),0,0, amount as expense
                                        from expense_records
                                    ) AS combined_tables where date > now() - interval '30' day group by date order by date DESC"));

        $datewise_net_profit_chart = DB::select(DB::raw("SELECT date, (SUM(amount)- SUM(amount1))- SUM(expense) AS `net_profit`
                                        FROM (SELECT DATE_FORMAT(created_at,'%D %M') AS date, billing_amount AS amount1, 0 AS amount, 0 as expense
                                        FROM purchase_orders where created_at > now() - interval '30' day
                                        UNION ALL
                                        SELECT DATE_FORMAT(created_at,'%D %M') AS date,0, billing_amount,0 as expense
                                        FROM sale_orders where created_at > now() - interval '30' day
                                        UNION ALL
                                        SELECT DATE_FORMAT(created_at,'%D %M') AS date,0,0, amount as expense
                                        from expense_records where created_at > now() - interval '30' day) AS `combined_tables` GROUP BY date"));
        $datewise_net_profit_chart_date = collect($datewise_net_profit_chart)->pluck('date');
        $datewise_net_profit_chart_value = collect($datewise_net_profit_chart)->pluck('net_profit');

        $monthwise_net_profit_chart = DB::select(DB::raw("SELECT date, (SUM(amount)- SUM(amount1))- SUM(expense) AS `net_profit`
                                        FROM (SELECT DATE_FORMAT(created_at,'%M') AS date, billing_amount AS amount1, 0 AS amount, 0 as expense
                                        FROM purchase_orders where created_at > now() - interval '30' day
                                        UNION ALL
                                        SELECT DATE_FORMAT(created_at,'%M') AS date,0, billing_amount,0 as expense
                                        FROM sale_orders where created_at > now() - interval '30' day
                                        UNION ALL
                                        SELECT DATE_FORMAT(created_at,'%M') AS date,0,0, amount as expense
                                        from expense_records where created_at > now() - interval '30' day) AS `combined_tables` GROUP BY date;"));
        $monthwise_net_profit_chart_date = collect($monthwise_net_profit_chart)->pluck('date');
        $monthwise_net_profit_chart_value = collect($monthwise_net_profit_chart)->pluck('net_profit');

        return view('backend.report.net_profit',compact('total_net_profit','net_table_data','datewise_net_profit_chart_date','datewise_net_profit_chart_value','monthwise_net_profit_chart_date','monthwise_net_profit_chart_value'));
    }

    public function net_profit_yearly() {
        $total_net_profit = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue,sum(expense) as expense
                                    FROM (
                                        SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount, 0 as expense
                                        FROM purchase_orders
                                        UNION ALL
                                        SELECT date(created_at),0, billing_amount,0 as expense
                                        FROM sale_orders
                                        UNION ALL
                                        SELECT date(created_at),0,0, amount as expense
                                        from expense_records
                                    ) AS combined_tables where date > now() - interval '365' day"));

        $net_table_data = DB::select(DB::raw("SELECT date, SUM(amount1) AS cost_sale, SUM(amount) AS revenue,sum(expense) as expense
                                    FROM (
                                        SELECT date(created_at) AS date, billing_amount AS amount1, 0 AS amount, 0 as expense
                                        FROM purchase_orders
                                        UNION ALL
                                        SELECT date(created_at),0, billing_amount,0 as expense
                                        FROM sale_orders
                                        UNION ALL
                                        SELECT date(created_at),0,0, amount as expense
                                        from expense_records
                                    ) AS combined_tables where date > now() - interval '365' day group by date order by date DESC"));

        $datewise_net_profit_chart = DB::select(DB::raw("SELECT date, (SUM(amount)- SUM(amount1))- SUM(expense) AS `net_profit`
                                        FROM (SELECT DATE_FORMAT(created_at,'%D %M') AS date, billing_amount AS amount1, 0 AS amount, 0 as expense
                                        FROM purchase_orders where created_at > now() - interval '365' day
                                        UNION ALL
                                        SELECT DATE_FORMAT(created_at,'%D %M') AS date,0, billing_amount,0 as expense
                                        FROM sale_orders where created_at > now() - interval '365' day
                                        UNION ALL
                                        SELECT DATE_FORMAT(created_at,'%D %M') AS date,0,0, amount as expense
                                        from expense_records where created_at > now() - interval '365' day) AS `combined_tables` GROUP BY date"));
        $datewise_net_profit_chart_date = collect($datewise_net_profit_chart)->pluck('date');
        $datewise_net_profit_chart_value = collect($datewise_net_profit_chart)->pluck('net_profit');

        $monthwise_net_profit_chart = DB::select(DB::raw("SELECT date, (SUM(amount)- SUM(amount1))- SUM(expense) AS `net_profit`
                                        FROM (SELECT DATE_FORMAT(created_at,'%M') AS date, billing_amount AS amount1, 0 AS amount, 0 as expense
                                        FROM purchase_orders where created_at > now() - interval '365' day
                                        UNION ALL
                                        SELECT DATE_FORMAT(created_at,'%M') AS date,0, billing_amount,0 as expense
                                        FROM sale_orders where created_at > now() - interval '365' day
                                        UNION ALL
                                        SELECT DATE_FORMAT(created_at,'%M') AS date,0,0, amount as expense
                                        from expense_records where created_at > now() - interval '365' day) AS `combined_tables` GROUP BY date;"));
        $monthwise_net_profit_chart_date = collect($monthwise_net_profit_chart)->pluck('date');
        $monthwise_net_profit_chart_value = collect($monthwise_net_profit_chart)->pluck('net_profit');

        return view('backend.report.net_profit',compact('total_net_profit','net_table_data','datewise_net_profit_chart_date','datewise_net_profit_chart_value','monthwise_net_profit_chart_date','monthwise_net_profit_chart_value'));

    }

    public function All_product_stock_reports(){

            $all_stock_reports = DB::select(DB::raw("
SELECT products.product_name,units.unit_name,sub_categories.subcategory_name,purchase_orders.created_at,products.product_description,suppliers.supplier_name,products.purchase_price,products.selling_price,products.quantity FROM products
                INNER JOIN purchase_order_details ON products.id = purchase_order_details.product_id
                INNER JOIN suppliers ON suppliers.id = purchase_order_details.supplier_id
                INNER JOIN units ON units.id = products.unit_id
                INNER JOIN sub_categories ON sub_categories.id = products.subcategory_id
                INNER JOIN purchase_orders ON purchase_orders.id = purchase_order_details.purchase_order_id ORDER BY purchase_orders.created_at DESC;"));
//            $all_stock_reports = DB::table('products')
//                ->join('purchase_order_details', 'products.id', '=', 'purchase_order_details.product_id')// joining the contacts table , where user_id and contact_user_id are same
//                ->select('products.*', 'purchase_order_details.supplier_id')
//                ->get();
            return view('backend.report.all_product_stock_reports',compact('all_stock_reports'));
    }

}
