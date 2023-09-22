@extends('backend.layout')

@section('content')

    <div class="row">
        <div class="col-lg-6 margin-tb">
            <div class="pull-left">
                <h2>Update Expense Record</h2>
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
    {{--@dd($purchase_order->id)--}}
    {{--    <form action="{{route('purchase.store')}}" method="POST" enctype="multipart/form-data">--}}
    {{--        @csrf--}}
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{trans('dashboard.expense_management_bill_no')}}:</strong>
                <input type="text" name="" class="form-control" id="bill_no" value="{{$expense_record->id}}" readonly>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{trans('dashboard.expense_management_expense_amount')}}:</strong>
                <input id="expense_record_amount" class="form-control" type="number" name="amount" value="{{$expense_record->amount}}" required readonly>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{trans('dashboard.remarks')}}:</strong>
                <input class="form-control" type="text" name="remarks" id="remarks"  value="{{$expense_record->remarks}}">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{trans('dashboard.expense_management_expense_type')}}:</strong>
                <select name="type" id="type" class="form-control"  required>
                    <option value='0' {{ $expense_record->type == '0' ? 'selected':'' }}>Important</option>
                    <option value='1' {{ $expense_record->type == '1' ? 'selected':'' }}>General</option>
                </select>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{trans('dashboard.status')}}:</strong>
                <select name="status" id="status" class="form-control" required>
                    <option value='0' {{ $expense_record->status == '0' ? 'selected':'' }}>Disabled</option>
                    <option value='1' {{ $expense_record->status == '1' ? 'selected':'' }}>Enabled</option>
                </select>
            </div>
        </div>
    </div><br>
    <table id="myTable" class="table table-striped table-light table-bordered">
        <thead>
        <tr>
            <th>{{trans('dashboard.expense_management_no')}}.</th>
            <th>{{trans('dashboard.expense_management_expense_category_name')}}</th>
            <th>{{trans('dashboard.expense_management_expense_amount')}}</th>
            <th>{{trans('dashboard.status')}} </th>
        </tr>
        </thead>
        <tbody id="data">
        @foreach( $expense_record_details as $expense_record_detail)
            <tr>
                <td>{{++$i}}</td>
                <td>
                    <select name="expense_category_id" id="expense_category_id" class="form-control expense_category_id" required>
                        @foreach($expense_categories as $category)
                            <option value="{{ $category->id }}"{{ $category->id == $expense_record_detail->expense_id ? 'selected' : '' }}>{{ $category->expense_category_name}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input id="amount" class="form-control amount" type="number" name="amount" onchange="bill_calculation()"  value="{{$expense_record_detail->amount}}" required>
                </td>
                <td>
                    <select name="expense_record_status" id="expense_record_status" class="form-control expense_record_status" required>
                        <option value='1' {{ $expense_record_detail->status == '1' ? 'selected':'' }}>Enabled</option>
                        <option value='0' {{ $expense_record_detail->status == '0' ? 'selected':'' }}>Disabled</option>
                    </select>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <button type="button" class="btn tn-sm btn-primary col-2 col-md-2 col-sm-2 savebtn" id="submit" >Update</button>
    {{--    </form>--}}

    <script src="{{url('js/jquery.min.js')}}"></script>
    <script>

        $("button#submit").click(function() {
            var data = [];
            var expense_category_id,amount, status;
            // return alert(payment_status);
            //  $("tbody tr").each(function(index, tr) {
            //     expense_category_id = $(this).find('.expense_category_id').val();
            //     amount = $(this).find('.amount').val();
            //     status = $(this).find('.expense_record_status').val();
            //      data.push({
            //          expense_category_id,
            //          amount,
            //          status
            //      });
            //  });
            var tableData = $('#myTable tbody tr').map(function(row, tr) {
                var $row = $(tr);
                return {
                    // id: $row.find('td:eq(0)').text(),
                    expense_category_id: parseInt($row.find('td:eq(1) select').val()),
                    amount: $row.find('td:eq(2) input').val(),
                    status: parseInt($row.find('td:eq(3) select').val())
                }
            }).get();
            // data.push(tableData)
           var found = false;
           // return console.log(data);
            tableData.map((item, index) => {
                if (!item?.amount) {
                    console.log(`array index =>[${index}] is null or empty.`);
                    found = true;
                }
            });
            if (found == true) {
                alert("Try Again")
            } else {
                submit_expense_record(tableData)
            }
            // if(data == ""){
            //     alert("Please Add list then try again ")
            // }else{
            //     submit_expense_record(data)
            // }

        });

        function showmsg(){
            alert("Order Updated")
            window.location.reload();
        }

        function submit_expense_record(tableData){
            // return console.log(data);
            // return console.log("percentage status_value:"+value)
            $.ajax({
                url: "{{route('expense_record.update',$expense_record->id)}}",
                type: "POST",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                dataType: "json",
                {{--data:{"_token": "{{ csrf_token() }}","postal":data},--}}
                data: {
                    "_token": "{{ csrf_token() }}",
                    expense_record_details: tableData   ,
                    expense_record: {
                        type: $("#type").val(),
                        status: $("#status").val(),
                        billing_amount: $("#expense_record_amount").val(),
                        remarks: $("#remarks").val(),
                    },
                    success: function (data) {
                        console.log(data)
                        showmsg()
                    }
                }
            })
        }


        function bill_calculation(){
            var sum_expense_total = 0
            $("table > tbody  > tr ").each(function(index, tr) {
                var expense_amount = parseInt($(this).find('#amount').val()) || 0;
                sum_expense_total += expense_amount;
            })
            var total_bill = sum_expense_total;
            $("#expense_record_amount").val(total_bill);
        }

        // Get Products Routes
        // function get_product(){
        //     $.ajax({
        //         url: "http://localhost:3000/stock_orders/get_product",
        //         type: "GET",
        //         // contentType: "application/json",
        //         contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        //         dataType: "json",
        //         data: {
        //             category_id: $("#category_id").val()
        //         },
        //         success:function(result){
        //             console.log(result)
        //             $("#product_id").empty();
        //             $("#product_id").append('<option>Select Product</option>');
        //             for(var i = 0; i < result.length; i++) {
        //                 $("#product_id").append('<option value="' + result[i]["id"] + '">' + result[i]["product_name"] + '</option>');
        //             }
        //         }
        //     })
        // }
    </script>
@endsection
