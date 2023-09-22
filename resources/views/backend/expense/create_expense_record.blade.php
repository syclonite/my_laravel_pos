@extends('backend.layout')

@section('content')

    <div class="row">
        <div class="col-lg-6 margin-tb">
            <div class="pull-left">
                <h2> {{trans('dashboard.expense_management_add_new_expense')}}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{route('expense_record.index')}}"> {{trans('dashboard.back')}}</a>
            </div>
        </div>
    </div><br>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{--    <form action="{{route('purchase.store')}}" method="POST" enctype="multipart/form-data">--}}
    {{--        @csrf--}}

    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{trans('dashboard.expense_management_expense_category_name')}}</strong>
                <select name="expense_category_id" id="expense_category_id" class="form-control" required>
                    <option value=''>Please choose one...</option>
                    @foreach($expense_category as $value)
                        <option value="{{ $value->id }}">{{ $value->expense_category_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{trans('dashboard.expense_management_expense_amount')}}</strong>
                <input type="number" name="amount" class="form-control" placeholder="Amount" id="amount" required>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{trans('dashboard.remarks')}}</strong>
                <input type="text" name="remarks" class="form-control" placeholder="Remarks" id="remarks">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{trans('dashboard.expense_management_expense_type')}}</strong>
                <select name="type" id="type" class="form-control" required>
                    <option value="1">General</option>
                    <option value="0">Important</option>
                </select>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{trans('dashboard.status')}}</strong>
                <select name="type" id="status" class="form-control" required>
                    <option value="1">Enable</option>
                    <option value="0">Disable</option>
                </select>
            </div>
        </div>
        <div><br><button type="button" class="btn btn-sm btn-primary col-2 col-md-2 col-sm-2 savebtn" id="add_list" style="float:left">{{trans('dashboard.add_new')}}</button></div>
        <div class="container">
{{--            {{dd(\Illuminate\Support\Facades\Auth::id())}}--}}
            <br>
            <table id="myTable" class="table table-bordered">
                <thead>
                <tr>
                    {{--                            <th>Serial No</th>--}}
                    <th>{{trans('dashboard.expense_management_expense_categories')}}</th>
                    <th>{{trans('dashboard.expense_management_expense_amount')}}</th>
                    <th class="d-none">{{trans('dashboard.status')}}</th>
                    <th>{{trans('dashboard.action')}}</th>
                </tr>
                </thead>

                <tbody>
{{--                <tr>--}}
                    {{--                            <td></td>--}}
{{--                    <td></td>--}}
{{--                    <td></td>--}}
{{--                    <td></td>--}}
{{--                    <td></td>--}}
{{--                </tr>--}}
                </tbody>
            </table>
            <br>
            <div>
                <div class="row">
                    <div class="offset-sm-2 offset-md-8 col-4 ">
                        <div class="card">
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">{{trans('dashboard.supplier_management_total_bill')}}: <input class="form-control" type="number" id="total_bill" name="total_bill" disabled></li>
{{--                                    <li class="list-group-item">Paid Amount :<input class="form-control" type="number" id="paid_amount" onchange="bill_calculation()"></li>--}}
{{--                                    <li class="list-group-item">Return Amount :<span id="return_amount"></span></li>--}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <br>
                    <button type="button" class="btn btn-sm btn-primary col-2 col-md-2 col-sm-2 savebtn" id="submit" >{{trans('dashboard.submit')}}</button>
                </div>
            </div>
        </div>

        <br>
    </div>
    {{--    </form>--}}

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

        }

    </style>

    <script>
// add list to the table
document.getElementById('amount').onkeyup = function(){
    if(this.value.match(/^[a-z0-9_.,'"!?;:& ]+$/i)){
        console.log('English');
    }
    else{
        // console.log('Not English');
        alert('Please enter number in English')
       return $('#amount').val('');
    }
}
var item = 0;
var addedProductCodes = [];
$("button#add_list").click(function() {
    // alert('hello');
    item++;
           var expense_category_id = $("#expense_category_id").val();
           var expense_category_text = $("#expense_category_id option:selected").text();
           var amount = $("#amount").val();
           var status = $("#status").val();
    // return console.log(expiry_date);
    var index = $.inArray(expense_category_id, addedProductCodes);
    if (index >= 0) {
        alert("You already added this Expense category");
    }else if (expense_category_id < 0 || amount < 0 || amount == '') {
        alert("Please Fill all the fields");
        // $('#myTable tr:last').after("<tr><td>data[" + td_productCode + "]</td></tr>");
    }else{
        addedProductCodes.push(expense_category_id);
        var new_row = '<tr>' +
            '<td class="expense_category_id" style="display: none">' + expense_category_id + '</td>' +
            '<td class="expense_category_text">' + expense_category_text + '</td>' +
            '<td class="amount">' + amount + '</td>'+
            '<td class="status d-none">' + status + '</td>' +
            '<td><input type="button" value="Delete" onclick="remove_cell(this)"/></td></tr>';
        var btn = document.createElement('tr');
        btn.innerHTML = new_row;
        document.getElementById('myTable').appendChild(btn);
        bill_calculation();
    }

});

function remove_cell(value){
    $(value).parent().parent().remove()
    bill_calculation();
}

function bill_calculation(){
    var total =0;
    $('.amount').each(function(index, tr) {
        // debugger
        total =total+  parseInt($(this).text());
    });
    $('#total_bill').val(total);
}

$("button#submit").click(function() {
    var data = [];
    var expense_category_id,amount, status;
    // return alert(payment_status);
    $("#myTable >tr").each(function(index) {
        expense_category_id = $(this).find('.expense_category_id').text();
        amount = $(this).find('.amount').text();
        status = $(this).find('.status').text();
        data.push({
            expense_category_id,
            amount,status
        });
    });
    if(data == ""){
        alert("Please Add list then try again ")
    }else{

        submit_expense(data)
    }

});
        function showmsg(){
            alert("Expense Created")
            window.location.reload();
        }

        function submit_expense(data){
            // return console.log(data);
            // return console.log("percentage status_value:"+value)
            $.ajax({
                url: "{{route('expense_record.store')}}",
                type: "POST",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                dataType: "json",
                {{--data:{"_token": "{{ csrf_token() }}","postal":data},--}}
                data: {
                    "_token": "{{ csrf_token() }}",
                    expense_record_details: data,
                    expense_record: {
                        type: $("#type").val(),
                        billing_amount: $("#total_bill").val(),
                        remarks: $("#remarks").val(),
                    },
                    success: function (data) {
                        console.log(data)
                        showmsg()
                    }
                }
            })
        }


    </script>
@endsection
