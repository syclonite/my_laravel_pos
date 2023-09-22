<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseRecord;
use App\Models\ExpenseRecordDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::orderby('created_at','DESC')->withTrashed()->get();
        return view('backend.expense.index',compact('expenses'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.expense.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'expense_category_name' => 'required|min:3',
            'expense_remarks' => '',
            'status' => 'required',
        ]);

        if ($validated == true){
            $expense = new Expense([
                'expense_category_name' => $request->get('expense_category_name'),
                'remarks' => $request->get('expense_remarks'),
                'status' => $request->get('status')
            ]);
            $expense->save();
        }

        return redirect()->route('expenses.index')->with('success','Expense Category has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        return view('backend.expense.edit',compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'expense_category_name' => 'required|min:3',
            'status' => 'required',
        ]);
        if ($validated == true){
            $expense->expense_category_name = $request->get('expense_category_name');
            $expense->remarks = $request->get('expense_remarks');
            $expense->status = $request->get('status');
            $expense->save();
        }
        return redirect()->route('expenses.index')->with('success','Expense has been updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete(); // Easy right?
        return redirect()->route('expenses.index')->with('success','Expense Category Deleted');
    }

    public function expense_record_index(Request $request)
    {
        if($request->has('start_date','end_date')) {
            $start_date = Carbon::parse($request->input('start_date'))->startOfDay();
            $end_date = Carbon::parse($request->input('end_date'))->endOfDay();
            $expense_records = ExpenseRecord::whereDate('created_at', '>=', $start_date)
                ->whereDate('created_at', '<=', $end_date)->orderby('created_at','DESC')
                ->withTrashed()
                ->get();
            $total_expense_summary = DB::select(DB::raw("SELECT COUNT(expense_records.id) expense_count,SUM(expense_records.amount) as total_amount,expense_records.created_at FROM expense_records where expense_records.created_at BETWEEN  '$start_date 00:00:00' AND '$end_date 23:59:59'
                                     ORDER BY expense_records.created_at DESC;"));
            $chart_data_expense = DB::select(DB::raw("SELECT expenses.expense_category_name as name,SUM(expense_record_details.amount) as total_amount,DATE_FORMAT(expense_record_details.created_at,'%M')as month FROM expense_record_details JOIN expenses ON expenses.id = expense_record_details.expense_id  WHERE expense_record_details.deleted_at IS Null AND expense_record_details.created_at BETWEEN  '$start_date 00:00:00' AND '$end_date 23:59:59' GROUP By name "));
            $month = collect($chart_data_expense)->pluck('name');
            $total_amount = collect($chart_data_expense)->pluck('total_amount');
        }else{
            $expense_records = ExpenseRecord::orderby('created_at','DESC')->withTrashed()->get();
            $total_expense_summary = DB::select(DB::raw("SELECT COUNT(expense_records.id) expense_count,SUM(expense_records.amount) as total_amount,expense_records.created_at FROM expense_records
                                     ORDER BY expense_records.created_at DESC;"));
            $chart_data_expense = DB::select(DB::raw("SELECT expenses.expense_category_name as name,SUM(expense_record_details.amount) as total_amount,DATE_FORMAT(expense_record_details.created_at,'%M')as month FROM expense_record_details JOIN expenses ON expenses.id = expense_record_details.expense_id  WHERE expense_record_details.deleted_at IS Null GROUP By name;"));
            $month = collect($chart_data_expense)->pluck('name');
            $total_amount = collect($chart_data_expense)->pluck('total_amount');

        }
        return view('backend.expense.index_expense_record',compact('expense_records','total_expense_summary','month','total_amount'))->with('i');
    }

    public function expense_record_create()
    {
        $expense_category = Expense::where('status',1)->get();
        return view('backend.expense.create_expense_record',compact('expense_category'));

    }

    public function expense_record_store(Request $request)
    {
        $validator = Validator::make($request[ 'expense_record'], [
            'type' => 'required',
            'billing_amount' => 'required|min:1',
            ]);

        if ($validator->validated()){
            $expense_record = new ExpenseRecord([
                'type' => $request['expense_record']['type'],
                'status' => '1',
                'amount' => $request['expense_record']['billing_amount'],
                'remarks' => $request['expense_record']['remarks'],
                'user_id' => Auth::id(),
            ]);
            $expense_record->save();
            $expense_record_details = $request['expense_record_details'];
//          dd($expense_record_details);
            foreach( $expense_record_details as $expense_record_detail){
//            dd($sale_order_detail);
                ExpenseRecordDetail::create([
                    'expense_id' => $expense_record_detail['expense_category_id'],
                    'expense_record_id' => $expense_record->id,
                    'amount' => $expense_record_detail['amount'],
                    'status' => $expense_record_detail['status'],
                ]);
            }
        }


    }
    public function expense_record_edit($id){
        $expense_categories = Expense::get();
        $expense_record = ExpenseRecord::find($id);
        $expense_record_details = ExpenseRecordDetail::where('expense_record_id',$id)->get();
        return view('backend.expense.edit_expense_record', compact('expense_record','expense_record_details','expense_categories'))->with('i');
    }


    public function expense_record_update(Request $request, $id)
    {
        $validator = Validator::make($request[ 'expense_record'], [
            'type' => 'required',
            'billing_amount' => 'required|min:1',
        ]);

        if ($validator->validated()){
            $expense_record = ExpenseRecord::find($id);
            $expense_record->type = $request['expense_record']['type'];
            $expense_record->amount = $request['expense_record']['billing_amount'];
            $expense_record->remarks = $request['expense_record']['remarks'];
            $expense_record->status = $request['expense_record']['remarks'];
            $expense_record->user_id = Auth::id();
            $expense_record->save();
            $expense_record_details = $request['expense_record_details'];
//        dd($sale_order_details);
            ExpenseRecordDetail::where('expense_record_id',$id)->delete();
            foreach ($expense_record_details as $expense_record_detail) {
//            dd($purchase_order_detail['quantity']);
                ExpenseRecordDetail::create([
                    'expense_id' => $expense_record_detail['expense_category_id'],
                    'expense_record_id' => $id,
                    'amount' => $expense_record_detail['amount'],
                    'status' => $expense_record_detail['status'],
                ]);
            }
        }
    }

    public function expanse_record_destroy($id){
        $expense_record = ExpenseRecord::find($id);
        $expense_record->delete(); // Easy right?
        ExpenseRecordDetail::where('expense_record_id',$id)->delete();
        return redirect()->route('expense_record.index')->with('success','Bill Deleted.');
    }

    public function expense_restore($id)
    {
        Expense::where('id', $id)->withTrashed()->restore();
        return redirect()->route('expenses.index')->with('Expense Category restored successfully.');
    }

    public function expense_forceDelete($id)
    {
        Expense::where('id', $id)->withTrashed()->forceDelete();
        return redirect()->route('expenses.index')->with('Expense Category force deleted successfully.');
    }

    public function expense_record_restore($id)
    {
        ExpenseRecord::where('id', $id)->withTrashed()->restore();
        ExpenseRecordDetail::where('expense_record_id', $id)->withTrashed()->restore();
        return redirect()->route('expense_record.index')->with('Expense Record restored successfully.');
    }

    public function expense_record_forceDelete($id)
    {
        ExpenseRecord::where('id', $id)->withTrashed()->forceDelete();
        return redirect()->route('expense_record.index')->with('Expense Record force deleted successfully.');
    }

    public function expense_record_daily_report(){

        $expense_records = DB::select(DB::raw("SELECT * FROM expense_records WHERE date(expense_records.created_at) = current_date AND expense_records.deleted_at is null or expense_records.deleted_at is not null ORDER BY expense_records.created_at DESC"));
        $total_expense_summary = DB::select(DB::raw("SELECT COUNT(expense_records.id) expense_count,SUM(expense_records.amount) as total_amount FROM expense_records
                                 Where date(expense_records.created_at) = current_date
                                 ORDER BY expense_records.created_at DESC;"));
//        $chart_data_expense = DB::select(DB::raw("SELECT SUM(expense_records.amount) as total_amount,DATE_FORMAT(expense_records.created_at,'%D')as month FROM expense_records WHERE date(expense_records.created_at) = current_date AND expense_records.deleted_at is null or expense_records.deleted_at is not null
//                                 GROUP BY month ORDER BY expense_records.created_at DESC"));
        $chart_data_expense = DB::select(DB::raw("SELECT expenses.expense_category_name as name,SUM(expense_record_details.amount) as total_amount,DATE_FORMAT(expense_record_details.created_at,'%D')as month FROM expense_record_details JOIN expenses ON expenses.id = expense_record_details.expense_id  WHERE expense_record_details.deleted_at IS Null AND date(expense_record_details.created_at) = current_date GROUP By name ORDER BY expense_record_details.created_at DESC"));
        $month = collect($chart_data_expense)->pluck('name');
        $total_amount = collect($chart_data_expense)->pluck('total_amount');
        return view('backend.expense.index_expense_record',compact('expense_records','total_expense_summary','month','total_amount'))->with('i');
    }

    public function expense_record_weekly_report(){

        $expense_records = DB::select(DB::raw("SELECT * FROM expense_records WHERE expense_records.created_at > now() - interval '7' day AND expense_records.deleted_at is null or expense_records.deleted_at is not null ORDER BY expense_records.created_at DESC"));
        $total_expense_summary = DB::select(DB::raw("SELECT COUNT(expense_records.id) expense_count,SUM(expense_records.amount) as total_amount FROM expense_records
                                 where expense_records.created_at > now() - interval '7' day
                                 ORDER BY expense_records.created_at DESC;"));
//        $chart_data_expense = DB::select(DB::raw("SELECT SUM(expense_records.amount) as total_amount,DATE_FORMAT(expense_records.created_at,'%D')as month FROM expense_records
//                                where expense_records.created_at > now() - interval '7' day GROUP BY month ORDER BY expense_records.created_at DESC"));
        $chart_data_expense = DB::select(DB::raw("SELECT expenses.expense_category_name as name,SUM(expense_record_details.amount) as total_amount,DATE_FORMAT(expense_record_details.created_at,'%D')as month FROM expense_record_details JOIN expenses ON expenses.id = expense_record_details.expense_id
                                                      WHERE expense_record_details.deleted_at IS Null AND expense_record_details.created_at > now() - interval '7' day GROUP By name ORDER BY expense_record_details.created_at DESC"));
        $month = collect($chart_data_expense)->pluck('name');
        $total_amount = collect($chart_data_expense)->pluck('total_amount');
        return view('backend.expense.index_expense_record',compact('expense_records','total_expense_summary','month','total_amount'))->with('i');
    }

    public function expense_record_monthly_report(){

        $expense_records = DB::select(DB::raw("SELECT * FROM expense_records where expense_records.created_at > now() - interval '30' day AND expense_records.deleted_at is null or expense_records.deleted_at is not null ORDER BY expense_records.created_at DESC"));
        $total_expense_summary = DB::select(DB::raw("SELECT COUNT(expense_records.id) expense_count,SUM(expense_records.amount) as total_amount FROM expense_records
                                 where expense_records.created_at > now() - interval '30' day
                                 ORDER BY expense_records.created_at DESC;"));
//        $chart_data_expense = DB::select(DB::raw("SELECT SUM(expense_records.amount) as total_amount,DATE_FORMAT(expense_records.created_at,'%M')as month FROM expense_records where expense_records.created_at > now() - interval '30' day
//                                 GROUP BY month ORDER BY expense_records.created_at DESC"));

        $chart_data_expense = DB::select(DB::raw("SELECT expenses.expense_category_name as name,SUM(expense_record_details.amount) as total_amount,DATE_FORMAT(expense_record_details.created_at,'%M')as month FROM expense_record_details JOIN expenses ON expenses.id = expense_record_details.expense_id
                                                      WHERE expense_record_details.deleted_at IS Null AND expense_record_details.created_at > now() - interval '30' day GROUP By name ORDER BY expense_record_details.created_at DESC"));
        $month = collect($chart_data_expense)->pluck('name');
        $total_amount = collect($chart_data_expense)->pluck('total_amount');
        return view('backend.expense.index_expense_record',compact('expense_records','total_expense_summary','month','total_amount'))->with('i');
    }

    public function expense_record_yearly_report(){

        $expense_records = DB::select(DB::raw("SELECT * FROM expense_records where expense_records.created_at > now() - interval '365' day AND expense_records.deleted_at is null or expense_records.deleted_at is not null ORDER BY expense_records.created_at DESC"));
        $total_expense_summary = DB::select(DB::raw("SELECT COUNT(expense_records.id) expense_count,SUM(expense_records.amount) as total_amount FROM expense_records
                                 where expense_records.created_at > now() - interval '365' day
                                 ORDER BY expense_records.created_at DESC;"));
//        $chart_data_expense = DB::select(DB::raw("SELECT SUM(expense_records.amount) as total_amount,DATE_FORMAT(expense_records.created_at,'%M')as month FROM expense_records Where expense_records.created_at > now() - interval '365' day
//                                 GROUP BY month ORDER BY expense_records.created_at DESC"));

        $chart_data_expense = DB::select(DB::raw("SELECT expenses.expense_category_name as name,SUM(expense_record_details.amount) as total_amount,DATE_FORMAT(expense_record_details.created_at,'%M')as month FROM expense_record_details JOIN expenses ON expenses.id = expense_record_details.expense_id
                                                      WHERE expense_record_details.deleted_at IS Null AND expense_record_details.created_at > now() - interval '365' day GROUP By name ORDER BY expense_record_details.created_at DESC"));
        $month = collect($chart_data_expense)->pluck('name');
        $total_amount = collect($chart_data_expense)->pluck('total_amount');
        return view('backend.expense.index_expense_record',compact('expense_records','total_expense_summary','month','total_amount'))->with('i');
    }


}
